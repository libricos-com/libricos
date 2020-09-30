!function(window, factory) {
    "function" == typeof define && define.amd ? define([ "jquery" ], function($) {
        return factory(window, $);
    }) : "object" == typeof module && "object" == typeof module.exports ? module.exports = factory(window, require("jquery")) : window.lity = factory(window, window.jQuery || window.Zepto);
}("undefined" != typeof window ? window : this, function(window, $) {
    "use strict";
    function transitionEnd(element) {
        var deferred = _deferred();
        return _transitionEndEvent && element.length ? (element.one(_transitionEndEvent, deferred.resolve), 
        setTimeout(deferred.resolve, 500)) : deferred.resolve(), deferred.promise();
    }
    function settings(currSettings, key, value) {
        if (1 === arguments.length) return $.extend({}, currSettings);
        if ("string" == typeof key) {
            if ("undefined" == typeof value) return "undefined" == typeof currSettings[key] ? null : currSettings[key];
            currSettings[key] = value;
        } else $.extend(currSettings, key);
        return this;
    }
    function parseQueryParams(params) {
        for (var p, pairs = decodeURI(params.split("#")[0]).split("&"), obj = {}, i = 0, n = pairs.length; i < n; i++) pairs[i] && (p = pairs[i].split("="), 
        obj[p[0]] = p[1]);
        return obj;
    }
    function appendQueryParams(url, params) {
        return url + (url.indexOf("?") > -1 ? "&" : "?") + $.param(params);
    }
    function transferHash(originalUrl, newUrl) {
        var pos = originalUrl.indexOf("#");
        return -1 === pos ? newUrl : (pos > 0 && (originalUrl = originalUrl.substr(pos)), 
        newUrl + originalUrl);
    }
    function error(msg) {
        return $('<span class="lity-error"></span>').append(msg);
    }
    function imageHandler(target, instance) {
        var desc = instance.opener() && instance.opener().data("lity-desc") || "Image with no description", img = $('<img src="' + target + '" alt="' + desc + '"/>'), deferred = _deferred(), failed = function() {
            deferred.reject(error("Failed loading image"));
        };
        return img.on("load", function() {
            return 0 === this.naturalWidth ? failed() : void deferred.resolve(img);
        }).on("error", failed), deferred.promise();
    }
    function inlineHandler(target, instance) {
        var el, placeholder, hasHideClass;
        try {
            el = $(target);
        } catch (e) {
            return !1;
        }
        return !!el.length && (placeholder = $('<i style="display:none !important"></i>'), 
        hasHideClass = el.hasClass("lity-hide"), instance.element().one("lity:remove", function() {
            placeholder.before(el).remove(), hasHideClass && !el.closest(".lity-content").length && el.addClass("lity-hide");
        }), el.removeClass("lity-hide").after(placeholder));
    }
    function youtubeHandler(target) {
        var matches = _youtubeRegex.exec(target);
        return !!matches && iframeHandler(transferHash(target, appendQueryParams("https://www.youtube" + (matches[2] || "") + ".com/embed/" + matches[4], $.extend({
            autoplay: 1
        }, parseQueryParams(matches[5] || "")))));
    }
    function vimeoHandler(target) {
        var matches = _vimeoRegex.exec(target);
        return !!matches && iframeHandler(transferHash(target, appendQueryParams("https://player.vimeo.com/video/" + matches[3], $.extend({
            autoplay: 1
        }, parseQueryParams(matches[4] || "")))));
    }
    function facebookvideoHandler(target) {
        var matches = _facebookvideoRegex.exec(target);
        return !!matches && (0 !== target.indexOf("http") && (target = "https:" + target), 
        iframeHandler(transferHash(target, appendQueryParams("https://www.facebook.com/plugins/video.php?href=" + target, $.extend({
            autoplay: 1
        }, parseQueryParams(matches[4] || ""))))));
    }
    function googlemapsHandler(target) {
        var matches = _googlemapsRegex.exec(target);
        return !!matches && iframeHandler(transferHash(target, appendQueryParams("https://www.google." + matches[3] + "/maps?" + matches[6], {
            output: matches[6].indexOf("layer=c") > 0 ? "svembed" : "embed"
        })));
    }
    function iframeHandler(target) {
        return '<div class="lity-iframe-container"><iframe frameborder="0" allowfullscreen allow="autoplay; fullscreen" src="' + target + '"/></div>';
    }
    function winHeight() {
        return document.documentElement.clientHeight ? document.documentElement.clientHeight : Math.round(_win.height());
    }
    function keydown(e) {
        var current = currentInstance();
        current && (27 === e.keyCode && current.options("esc") && current.close(), 9 === e.keyCode && handleTabKey(e, current));
    }
    function handleTabKey(e, instance) {
        var focusableElements = instance.element().find(_focusableElementsSelector), focusedIndex = focusableElements.index(document.activeElement);
        e.shiftKey && focusedIndex <= 0 ? (focusableElements.get(focusableElements.length - 1).focus(), 
        e.preventDefault()) : e.shiftKey || focusedIndex !== focusableElements.length - 1 || (focusableElements.get(0).focus(), 
        e.preventDefault());
    }
    function resize() {
        $.each(_instances, function(i, instance) {
            instance.resize();
        });
    }
    function registerInstance(instanceToRegister) {
        1 === _instances.unshift(instanceToRegister) && (_html.addClass("lity-active"), 
        _win.on({
            resize: resize,
            keydown: keydown
        })), $("body > *").not(instanceToRegister.element()).addClass("lity-hidden").each(function() {
            var el = $(this);
            void 0 === el.data(_dataAriaHidden) && el.data(_dataAriaHidden, el.attr(_attrAriaHidden) || null);
        }).attr(_attrAriaHidden, "true");
    }
    function removeInstance(instanceToRemove) {
        var show;
        instanceToRemove.element().attr(_attrAriaHidden, "true"), 1 === _instances.length && (_html.removeClass("lity-active"), 
        _win.off({
            resize: resize,
            keydown: keydown
        })), _instances = $.grep(_instances, function(instance) {
            return instanceToRemove !== instance;
        }), show = _instances.length ? _instances[0].element() : $(".lity-hidden"), show.removeClass("lity-hidden").each(function() {
            var el = $(this), oldAttr = el.data(_dataAriaHidden);
            oldAttr ? el.attr(_attrAriaHidden, oldAttr) : el.removeAttr(_attrAriaHidden), el.removeData(_dataAriaHidden);
        });
    }
    function currentInstance() {
        return 0 === _instances.length ? null : _instances[0];
    }
    function factory(target, instance, handlers, preferredHandler) {
        var content, handler = "inline", currentHandlers = $.extend({}, handlers);
        return preferredHandler && currentHandlers[preferredHandler] ? (content = currentHandlers[preferredHandler](target, instance), 
        handler = preferredHandler) : ($.each([ "inline", "iframe" ], function(i, name) {
            delete currentHandlers[name], currentHandlers[name] = handlers[name];
        }), $.each(currentHandlers, function(name, currentHandler) {
            return !currentHandler || (!(!currentHandler.test || currentHandler.test(target, instance)) || (content = currentHandler(target, instance), 
            !1 !== content ? (handler = name, !1) : void 0));
        })), {
            handler: handler,
            content: content || ""
        };
    }
    function Lity(target, options, opener, activeElement) {
        function ready(result) {
            content = $(result).css("max-height", winHeight() + "px"), element.find(".lity-loader").each(function() {
                var loader = $(this);
                transitionEnd(loader).always(function() {
                    loader.remove();
                });
            }), element.removeClass("lity-loading").find(".lity-content").empty().append(content), 
            isReady = !0, content.trigger("lity:ready", [ self ]);
        }
        var result, element, content, self = this, isReady = !1, isClosed = !1;
        options = $.extend({}, _defaultOptions, options), element = $(options.template), 
        self.element = function() {
            return element;
        }, self.opener = function() {
            return opener;
        }, self.options = $.proxy(settings, self, options), self.handlers = $.proxy(settings, self, options.handlers), 
        self.resize = function() {
            isReady && !isClosed && content.css("max-height", winHeight() + "px").trigger("lity:resize", [ self ]);
        }, self.close = function() {
            if (isReady && !isClosed) {
                isClosed = !0, removeInstance(self);
                var deferred = _deferred();
                if (activeElement && (document.activeElement === element[0] || $.contains(element[0], document.activeElement))) try {
                    activeElement.focus();
                } catch (e) {}
                return content.trigger("lity:close", [ self ]), element.removeClass("lity-opened").addClass("lity-closed"), 
                transitionEnd(content.add(element)).always(function() {
                    content.trigger("lity:remove", [ self ]), element.remove(), element = void 0, deferred.resolve();
                }), deferred.promise();
            }
        }, result = factory(target, self, options.handlers, options.handler), element.attr(_attrAriaHidden, "false").addClass("lity-loading lity-opened lity-" + result.handler).appendTo("body").focus().on("click", "[data-lity-close]", function(e) {
            $(e.target).is("[data-lity-close]") && self.close();
        }).trigger("lity:open", [ self ]), registerInstance(self), $.when(result.content).always(ready);
    }
    function lity(target, options, opener) {
        target.preventDefault ? (target.preventDefault(), opener = $(this), target = opener.data("lity-target") || opener.attr("href") || opener.attr("src")) : opener = $(opener);
        var instance = new Lity(target, $.extend({}, opener.data("lity-options") || opener.data("lity"), options), opener, document.activeElement);
        if (!target.preventDefault) return instance;
    }
    var document = window.document, _win = $(window), _deferred = $.Deferred, _html = $("html"), _instances = [], _attrAriaHidden = "aria-hidden", _dataAriaHidden = "lity-" + _attrAriaHidden, _focusableElementsSelector = 'a[href],area[href],input:not([disabled]),select:not([disabled]),textarea:not([disabled]),button:not([disabled]),iframe,object,embed,[contenteditable],[tabindex]:not([tabindex^="-"])', _defaultOptions = {
        esc: !0,
        handler: null,
        handlers: {
            image: imageHandler,
            inline: inlineHandler,
            youtube: youtubeHandler,
            vimeo: vimeoHandler,
            googlemaps: googlemapsHandler,
            facebookvideo: facebookvideoHandler,
            iframe: iframeHandler
        },
        template: '<div class="lity" role="dialog" aria-label="Dialog Window (Press escape to close)" tabindex="-1"><div class="lity-wrap" data-lity-close role="document"><div class="lity-loader" aria-hidden="true">Loading...</div><div class="lity-container"><div class="lity-content"></div><button class="lity-close" type="button" aria-label="Close (Press escape to close)" data-lity-close>&times;</button></div></div></div>'
    }, _imageRegexp = /(^data:image\/)|(\.(png|jpe?g|gif|svg|webp|bmp|ico|tiff?)(\?\S*)?$)/i, _youtubeRegex = /(youtube(-nocookie)?\.com|youtu\.be)\/(watch\?v=|v\/|u\/|embed\/?)?([\w-]{11})(.*)?/i, _vimeoRegex = /(vimeo(pro)?.com)\/(?:[^\d]+)?(\d+)\??(.*)?$/, _googlemapsRegex = /((maps|www)\.)?google\.([^\/\?]+)\/?((maps\/?)?\?)(.*)/i, _facebookvideoRegex = /(facebook\.com)\/([a-z0-9_-]*)\/videos\/([0-9]*)(.*)?$/i, _transitionEndEvent = function() {
        var el = document.createElement("div"), transEndEventNames = {
            WebkitTransition: "webkitTransitionEnd",
            MozTransition: "transitionend",
            OTransition: "oTransitionEnd otransitionend",
            transition: "transitionend"
        };
        for (var name in transEndEventNames) if (void 0 !== el.style[name]) return transEndEventNames[name];
        return !1;
    }();
    return imageHandler.test = function(target) {
        return _imageRegexp.test(target);
    }, lity.version = "@VERSION", lity.options = $.proxy(settings, lity, _defaultOptions), 
    lity.handlers = $.proxy(settings, lity, _defaultOptions.handlers), lity.current = currentInstance, 
    $(document).on("click.lity", "[data-lity]", lity), lity;
}), jQuery(document).ready(function($) {
    $("*[data-aawp-api-country-selector]").change(function() {
        var option = $(this).find("option:selected").val(), target = $("*[data-aawp-api-country-preview] .aawp-icon-flag"), flagClass = option.replace("co.", "").replace("com.", "").replace("com", "us");
        target.attr("class", "aawp-icon-flag aawp-icon-flag--" + flagClass);
    }), $("*[data-aawp-star-rating-update-preview]").change(function() {
        var target = $("*[data-aawp-star-rating-preview]"), notes = $("#aawp-star-rating-notes"), sizer = $("#aawp_star_rating_size"), styler = $("#aawp_star_rating_style"), classes = "aawp-star-rating";
        if (sizer) {
            var size = sizer.find("option:selected").val();
            classes = classes + " aawp-star-rating--" + size;
        }
        if (styler) {
            var style = styler.find("option:selected").val();
            classes = classes + " aawp-star-rating--" + style, notes.attr("class", style);
        }
        target.attr("class", classes);
    }), $("*[data-aawp-range-slider]").change(function() {
        var value = $(this).val(), target = $(this).data("aawp-range-slider");
        $("#" + target).html(value);
    }), $("*[data-aawp-toggle-on-change]").change(function() {
        var target = $(this).data("aawp-toggle-on-change");
        $("#" + target).fadeToggle();
    });
    $("#aawp-button-preview");
    $("*[data-aawp-button-preview-style]").change(function() {
        var preview = $(this).data("aawp-button-preview-style"), option = $(this).find("option:selected").val(), target = $("#" + preview), current = target.data("aawp-button-style");
        target.data("aawp-button-style", option), target.removeClass("aawp-button--" + current), 
        target.addClass("aawp-button--" + option);
    }), $("#aawp_button_icon").change(function() {
        var option = $(this).find("option:selected").val(), target = $("#aawp-button-preview");
        target.removeClass("aawp-button--icon-black aawp-button--icon-white aawp-button--icon-amazon-black aawp-button--icon-amazon-white"), 
        target.addClass("aawp-button--icon-" + option);
    }), $("*[data-aawp-button-icon-hide-preview]").change(function() {
        var preview = $(this).data("aawp-button-icon-hide-preview"), target = $("#" + preview);
        target.toggleClass("aawp-button--icon");
    }), $("*[data-aawp-button-preview-text]").keyup(function() {
        var preview = $(this).data("aawp-button-preview-text"), text = $(this).val(), target = $("#" + preview + " span");
        target.text(text);
    }), $("*[data-aawp-button-preview-rounded]").change(function() {
        var preview = $(this).data("aawp-button-preview-rounded"), target = $("#" + preview);
        target.toggleClass("rounded");
    }), $("*[data-aawp-button-preview-shadow]").change(function() {
        var preview = $(this).data("aawp-button-preview-shadow"), target = $("#" + preview);
        target.toggleClass("shadow");
    }), jQuery(document).on("click", "#aawp-reschedule-events-submit", function(event) {
        jQuery("#aawp_support_reschedule_events").val("1");
    }), jQuery(document).on("click", "#aawp-reset-log-submit", function(event) {
        jQuery("#aawp_support_reset_log").val("1");
    }), jQuery(document).on("click", "#aawp-download-log-submit", function(e) {
        var logTextarea = $("#aawp-debug-log");
        if (!logTextarea) return !1;
        var logContent = logTextarea.val(), logContentEncoded = logContent.toString();
        this.href = "data:text/plain;charset=UTF-8," + encodeURIComponent(logContentEncoded);
    }), jQuery(document).on("click", "#aawp-download-sysinfo-submit", function(e) {
        var sysinfoTextarea = $("#aawp-sysinfo");
        if (!sysinfoTextarea) return !1;
        var sysinfoContent = sysinfoTextarea.val(), sysinfoContentEncoded = sysinfoContent.toString();
        this.href = "data:text/plain;charset=UTF-8," + encodeURIComponent(sysinfoContentEncoded);
    }), $(function() {
        $(".aawp-input-colorpicker").wpColorPicker();
    });
}), jQuery(document).ready(function($) {
    $("#aawp_link_icon").change(function() {
        var option = $(this).find("option:selected").val(), icon = $("#aawp_link_icon_preview"), container = $("#aawp_link_icon_preview_container");
        icon.removeClass("amazon").removeClass("amazon-logo").removeClass("cart"), "amazon" == option ? (icon.addClass("amazon"), 
        container.css("display", "inline-block")) : "amazon-logo" == option ? (icon.addClass("amazon-logo"), 
        container.css("display", "inline-block")) : "cart" == option ? (icon.addClass("cart"), 
        container.css("display", "inline-block")) : container.css("display", "none");
    });
}), jQuery(document).ready(function($) {
    jQuery(document).on("click", "#aawp_api_multiple_stores", function(event) {
        jQuery("#aawp-settings-stores-tracking-ids").toggle();
    });
}), jQuery(document).ready(function($) {
    $("*[data-aawp-custom-template-selector]").change(function() {
        var option = $(this).find("option:selected").val(), target = $(this).data("aawp-custom-template-selector"), wrapper = $('*[data-aawp-custom-template-wrapper="' + target + '"]');
        "custom" == option ? wrapper.fadeIn() : wrapper.fadeOut();
    });
}), jQuery(document).ready(function($) {
    function replace_widget_title_icon(el) {
        var widget_title = el.html();
        widget_title = widget_title.replace("AAWP - ", '<span class="aawp-widget-logo-icon"></span>'), 
        el.html(widget_title);
    }
    $(".widget-title h3:contains('AAWP - ')").each(function() {
        replace_widget_title_icon($(this));
    });
}), jQuery(document).ready(function($) {
    var countrySelectItems = $(".aawp-pp-countries__list-item"), countrySelectList = $(".aawp-pp-countries__list--select"), contentContainers = $(".aawp-pp-content");
    jQuery(document).on("click", "[data-aawp-pp-switch-country]", function(e) {
        countrySelectList.toggleClass("open");
    }), jQuery(document).on("click", "[data-aawp-pp-select-country]", function(e) {
        var selectedCountry = $(this).data("aawp-pp-select-country");
        countrySelectList.removeClass("open"), countrySelectItems.removeClass("active"), 
        $(".aawp-pp-countries__list-item--" + selectedCountry).addClass("active"), contentContainers.removeClass("active"), 
        $(".aawp-pp-content--" + selectedCountry).addClass("active");
    }), jQuery(document).on("click", "[data-aawp-pp-content-toggle-hidden]", function(e) {
        e.preventDefault();
        var hiddenContainer = $(this).data("aawp-pp-content-toggle-hidden");
        $("#" + hiddenContainer).toggle();
    }), jQuery(document).on("click", "[data-aawp-pp-select-image]", function(e) {
        var selected = $(this), imagesWrapper = selected.closest(".aawp-pp-images"), defaultImageClass = "aawp-pp-image", selectedImageClass = defaultImageClass + "--selected", postId = $("#aawp-post-id").val(), selectedImage = selected.data("aawp-pp-select-image"), store = selected.data("aawp-pp-store");
        return imagesWrapper.find("." + defaultImageClass).attr("class", defaultImageClass), 
        selected.addClass(selectedImageClass), !(!postId || !store) && void jQuery.ajax({
            url: aawp_post.ajax_url,
            type: "post",
            data: {
                action: "aawp_admin_ajax_select_product_image_action",
                post_id: postId,
                image: selectedImage,
                store: store
            },
            success: function(response) {}
        });
    }), jQuery(document).on("click", "[data-aawp-pp-debug-info-toggle]", function(e) {
        $("#aawp-pp-debug-info").toggle();
    });
}), jQuery(document).ready(function($) {
    jQuery(document).on("click", "[data-aawp-admin-renew-post]", function(e) {
        function actionLoading() {
            container.addClass("aawp-admin-renew-post-action--loading"), button.attr("disabled", "disabled");
        }
        function actionLoaded() {
            container.removeClass("aawp-admin-renew-post-action--loading"), button.removeAttr("disabled");
        }
        function lastUpdateSuccess() {
            lastUpdateContainer.removeClass("aawp-admin-renew-post-last-update--error"), lastUpdateContainer.addClass("aawp-admin-renew-post-last-update--success");
        }
        function lastUpdateError() {
            lastUpdateContainer.removeClass("aawp-admin-renew-post-last-update--success"), lastUpdateContainer.addClass("aawp-admin-renew-post-last-update--error");
        }
        e.preventDefault();
        var button = $(this), container = $(this).parent(".aawp-admin-renew-post-action"), postId = button.data("aawp-admin-renew-post");
        if (!postId) return !1;
        var reloadAfterSuccess = button.data("aawp-admin-renew-post-success-reload"), lastUpdateContainer = $("#aawp-admin-renew-post-last-update-" + postId);
        return !!lastUpdateContainer && (lastUpdateContainer.addClass("blub"), actionLoading(), 
        void jQuery.ajax({
            url: aawp_post.ajax_url,
            type: "post",
            data: {
                action: "aawp_admin_ajax_renew_post_action",
                post_id: postId
            },
            success: function(response) {
                response ? (lastUpdateSuccess(), lastUpdateContainer.html(response), reloadAfterSuccess && location.reload()) : lastUpdateError(), 
                actionLoaded();
            }
        }));
    });
}), jQuery(document).ready(function($) {
    var modal;
    jQuery(document).on("click", "[data-aawp-modal]", lity), jQuery(document).on("lity:open", function(event, instance) {
        modal = instance;
    }), jQuery(document).on("click", "[data-aawp-close-modal]", function(e) {
        modal.close().then(function() {});
    });
}), jQuery(document).ready(function($) {
    function handle_table_no_rows_notice() {
        0 === numRows ? $("#aawp-table-no-rows").show() : $("#aawp-table-no-rows").hide();
    }
    function handleAddNewProductByAsin() {
        $("#aawp-table-add-product-notices p").hide();
        var input = $("[data-aawp-table-add-product-by-asin]"), asin = input.val();
        return asin ? asin.length < 10 ? (input.focus(), $("#aawp-table-add-product-notice-asin-length").show(), 
        !1) : (addNewProduct(asin), void input.val("")) : (input.focus(), !1);
    }
    function addNewProduct(asin) {
        if (!asin) return !1;
        var productId = nextProductId;
        nextProductId += 1, $("#aawp-table-product-status-" + productId).prop("checked", !0), 
        $("#aawp-table-product-asin-field-" + productId).val(asin), $("#aawp-table-product-" + productId).show(), 
        numProducts++, handle_table_no_products_notice();
    }
    function handle_table_no_products_notice() {
        0 === numProducts ? $("#aawp-table-no-products").show() : $("#aawp-table-no-products").hide();
    }
    var tableRows = $("#aawp-table-rows"), numRows = tableRows.children("div:visible").length, nextRowId = numRows;
    jQuery(document).on("click", "[data-aawp-table-add-row]", function(e) {
        var rowId = nextRowId;
        return nextRowId += 1, $("#aawp-table-row-status-" + rowId).prop("checked", !0), 
        $("#aawp-table-row-item-" + rowId).show(), $('*[data-aawp-table-product-row="' + rowId + '"]').show(), 
        numRows++, handle_table_no_rows_notice(), !1;
    }), jQuery(document).on("click", "[data-aawp-table-delete-row]", function(e) {
        var rowId = $(this).data("aawp-table-delete-row");
        $("#aawp-table-row-item-" + rowId).remove(), $('*[data-aawp-table-product-row="' + rowId + '"]').remove(), 
        numRows--, handle_table_no_rows_notice();
    }), jQuery(document).on("keyup", "[data-aawp-table-rows-input]", function(e) {
        var rowId = $(this).data("aawp-table-rows-input"), value = $(this).val();
        $('*[data-aawp-table-product-label-field="' + rowId + '"]').text(value);
    }), $("*[data-aawp-table-row-type]").change(function() {
        var rowId = $(this).data("aawp-table-row-type"), rowType = $(this).val();
        return !!rowType && void $('[data-aawp-table-product-row="' + rowId + '"]').each(function(index, e) {
            var productRow = $(e), productRowTypeSelector = (productRow.closest(".aawp-table-product").prop("id"), 
            productRow.find("[data-aawp-table-product-row-type]")), productRowType = productRowTypeSelector.val();
            if (productRowType) return !1;
            var productRowValue = productRow.find("[data-aawp-table-product-row-value]");
            productRowValue.attr("class", "aawp-table-product__value aawp-table-product__value--" + rowType);
        });
    });
    var tableProducts = $("#aawp-table-products"), numProducts = tableProducts.children("div:visible").length, nextProductId = numProducts;
    jQuery(document).on("click", "[data-aawp-table-add-product-by-asin-submit]", function(e) {
        return handleAddNewProductByAsin(), !1;
    }), $("[data-aawp-table-add-product-by-asin]").keypress(function(e) {
        if (13 == e.which) return handleAddNewProductByAsin(), !1;
    }), jQuery(document).on("click", "[data-aawp-table-add-products-search]", function(e) {
        $("#aawp-ajax-search-results").attr("data-aawp-ajax-search-items-select", "9");
    }), jQuery(document).on("click", "[data-aawp-table-delete-product]", function(e) {
        var productId = $(this).data("aawp-table-delete-product");
        $("#aawp-table-product-" + productId).remove(), numProducts--, handle_table_no_products_notice();
    }), $("*[data-aawp-table-product-row-type]").change(function() {
        var productRow = $(this).parents("[data-aawp-table-product-row]"), rowId = productRow.data("aawp-table-product-row"), productRowType = $(this).val(), productValue = productRow.find("[data-aawp-table-product-row-value]");
        if (!productRowType) {
            var rowTypeSelector = $('[data-aawp-table-row-type="' + rowId + '"]'), rowType = rowTypeSelector.val();
            rowType && (productRowType = rowType);
        }
        productRowType ? productValue.attr("class", "aawp-table-product__value aawp-table-product__value--" + productRowType) : productValue.attr("class", "aawp-table-product__value");
    }), jQuery(document).on("click", "[data-aawp-table-product-footer-toggle]", function(e) {
        e.preventDefault();
        var productId = $(this).data("aawp-table-product-footer-toggle");
        return $("#aawp-table-product-footer-" + productId).toggle(), !1;
    });
    var activeProductSearchContainer = $("#aawp-table-active-product-search");
    jQuery(document).on("click", "[data-aawp-table-search-product]", function(e) {
        $("#aawp-ajax-search-results").attr("data-aawp-ajax-search-items-select", "1");
        var productId = $(this).data("aawp-table-search-product");
        activeProductSearchContainer.val(productId);
    }), jQuery(document).on("click", "[data-aawp-table-product-search-select]", function(e) {
        var input = $("#aawp-ajax-search-items-selected");
        if (!input) return !1;
        var itemsCollection = input.val();
        if (!itemsCollection) return !1;
        var activeProductSearch = activeProductSearchContainer.val();
        if (activeProductSearch) $("#aawp-table-product-asin-field-" + activeProductSearch).val(itemsCollection), 
        activeProductSearchContainer.val(""); else {
            var itemsArray = [];
            itemsCollection && itemsCollection.indexOf(",") !== -1 ? itemsArray = itemsCollection.split(",") : itemsCollection && itemsArray.push(itemsCollection);
            for (var i = 0; i < itemsArray.length; i++) addNewProduct(itemsArray[i]);
        }
        $(".aawp-ajax-search-item--active").removeClass("aawp-ajax-search-item--active"), 
        input.val(""), $(".aawp-modal__close").trigger("click");
    }), jQuery(document).on("click", "[data-aawp-table-delete-row]", function(e) {
        var rowId = $(this).data("aawp-table-delete-row");
        $("#aawp-table-row-item-" + rowId).remove(), $('*[data-aawp-table-product-row="' + rowId + '"]').remove(), 
        numRows--, handle_table_no_rows_notice();
    });
    var sortableTableRows = $("*[data-aawp-table-sortable-rows]");
    sortableTableRows.length && sortableTableRows.sortable({
        start: function(event, ui) {
            $(this).data("elPos", ui.item.index());
        },
        update: function(event, ui) {
            var origPos = $(this).data("elPos");
            sortableTableRows.not($(this)).each(function(i, e) {
                origPos > ui.item.index() ? $(this).children("div:eq(" + origPos + ")").insertBefore($(this).children("div:eq(" + ui.item.index() + ")")) : $(this).children("div:eq(" + origPos + ")").insertAfter($(this).children("div:eq(" + ui.item.index() + ")"));
            });
        }
    }).disableSelection();
    var sortableTableProducts = $("*[data-aawp-table-sortable-products]");
    sortableTableProducts.length && sortableTableProducts.sortable();
}), jQuery(document).ready(function($) {
    function handleAjaxSearch() {
        itemsCollectionContainer.val("");
        var keywords = $("#aawp-ajax-search-input").val();
        return keywords ? (loadingStart(), jQuery.ajax({
            url: aawp_post.ajax_url,
            type: "post",
            data: {
                action: "aawp_admin_ajax_search_action",
                type: "search",
                keywords: keywords
            },
            success: function(response) {
                showResults(response);
            }
        }), void languageGerman()) : (showNoticeInputMissing(), !1);
    }
    function updateSelectedItemsCollection(item) {
        var itemAsin = item.data("aawp-ajax-search-item");
        if (!itemAsin) return !1;
        if (!itemsCollectionContainer) return !1;
        var itemsArray = [], itemsCollection = itemsCollectionContainer.val();
        itemsCollection && itemsCollection.indexOf(",") !== -1 ? itemsArray = itemsCollection.split(",") : itemsCollection && itemsArray.push(itemsCollection);
        var itemIndex = itemsArray.indexOf(itemAsin);
        itemIndex > -1 ? itemsArray.splice(itemIndex, 1) : itemsArray.push(itemAsin), itemsCollection = itemsArray.join(","), 
        itemsCollectionContainer.val(itemsCollection);
    }
    function updateMetaContainer() {
        if (!metaContainer) return !1;
        var itemsSelected = $(".aawp-ajax-search-item--active").length;
        itemsSelected > 0 ? metaContainer.addClass("aawp-ajax-search-meta--selected") : metaContainer.removeClass("aawp-ajax-search-meta--selected"), 
        itemsSelected === itemsSelectMax ? metaContainer.addClass("aawp-ajax-search-meta--selected-max") : metaContainer.removeClass("aawp-ajax-search-meta--selected-max");
    }
    function loadingStart() {
        if (!resultsContainer) return !1;
        var html = "<p>";
        html += '<span class="aawp-spinner"><span class="aawp-spinner__bounce-1"></span><span class="aawp-spinner__bounce-2"></span></span>', 
        html += '<span class="aawp-spinner-label">', html += languageGerman() ? "Daten werden von der Amazon API abgerufen" : "Fetching data from Amazon API", 
        html += "</span>", html += "</p>", resultsContainer.html(html);
    }
    function showNoticeInputMissing() {
        if (!resultsContainer) return !1;
        var text = languageGerman() ? "Bitte ASIN oder Suchbegriff eingeben." : "Please enter ASIN or search term.";
        showNotice(text, "warning");
    }
    function showNotice(text, type) {
        if (!resultsContainer) return !1;
        if (!text) return !1;
        var html = '<p class="aawp-notice aawp-notice--' + type + '">' + text + "</p>";
        resultsContainer.html(html);
    }
    function showResults(results) {
        return !!resultsContainer && (!1 === results ? resultsContainer.html("Error!") : resultsContainer.html(results), 
        void (resultsContainer && "undefined" != typeof resultsContainer.data("aawp-ajax-search-items-select") && (itemsSelectMax = resultsContainer.data("aawp-ajax-search-items-select"))));
    }
    function languageGerman() {
        var adminLang = "undefined" != typeof aawp_admin_lang ? aawp_admin_lang : "en";
        return "de" == adminLang;
    }
    var resultsContainer = $("#aawp-ajax-search-results"), metaContainer = $("#aawp-ajax-search-meta"), itemsCollectionContainer = $("#aawp-ajax-search-items-selected"), itemsSelectMax = 99;
    jQuery(document).on("click", "[data-aawp-ajax-search]", function(e) {
        return handleAjaxSearch(), !1;
    }), $("#aawp-ajax-search-input").keypress(function(e) {
        if (13 == e.which) return handleAjaxSearch(), !1;
    }), jQuery(document).on("click", ".aawp-ajax-search-item", function(e) {
        var activeClass = "aawp-ajax-search-item--active", itemsSelected = $(".aawp-ajax-search-item--active").length;
        $(this).hasClass(activeClass) ? $(this).removeClass(activeClass) : 1 === itemsSelectMax ? ($(".aawp-ajax-search-item").removeClass(activeClass), 
        $(this).addClass(activeClass)) : itemsSelected < itemsSelectMax && $(this).addClass(activeClass), 
        updateSelectedItemsCollection($(this)), updateMetaContainer();
    });
});