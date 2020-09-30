!function(factory) {
    var registeredInModuleLoader;
    if ("function" == typeof define && define.amd && (define(factory), registeredInModuleLoader = !0), 
    "object" == typeof exports && (module.exports = factory(), registeredInModuleLoader = !0), 
    !registeredInModuleLoader) {
        var OldCookies = window.Cookies, api = window.Cookies = factory();
        api.noConflict = function() {
            return window.Cookies = OldCookies, api;
        };
    }
}(function() {
    function extend() {
        for (var i = 0, result = {}; i < arguments.length; i++) {
            var attributes = arguments[i];
            for (var key in attributes) result[key] = attributes[key];
        }
        return result;
    }
    function decode(s) {
        return s.replace(/(%[0-9A-Z]{2})+/g, decodeURIComponent);
    }
    function init(converter) {
        function api() {}
        function set(key, value, attributes) {
            if ("undefined" != typeof document) {
                attributes = extend({
                    path: "/"
                }, api.defaults, attributes), "number" == typeof attributes.expires && (attributes.expires = new Date(1 * new Date() + 864e5 * attributes.expires)), 
                attributes.expires = attributes.expires ? attributes.expires.toUTCString() : "";
                try {
                    var result = JSON.stringify(value);
                    /^[\{\[]/.test(result) && (value = result);
                } catch (e) {}
                value = converter.write ? converter.write(value, key) : encodeURIComponent(String(value)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g, decodeURIComponent), 
                key = encodeURIComponent(String(key)).replace(/%(23|24|26|2B|5E|60|7C)/g, decodeURIComponent).replace(/[\(\)]/g, escape);
                var stringifiedAttributes = "";
                for (var attributeName in attributes) attributes[attributeName] && (stringifiedAttributes += "; " + attributeName, 
                attributes[attributeName] !== !0 && (stringifiedAttributes += "=" + attributes[attributeName].split(";")[0]));
                return document.cookie = key + "=" + value + stringifiedAttributes;
            }
        }
        function get(key, json) {
            if ("undefined" != typeof document) {
                for (var jar = {}, cookies = document.cookie ? document.cookie.split("; ") : [], i = 0; i < cookies.length; i++) {
                    var parts = cookies[i].split("="), cookie = parts.slice(1).join("=");
                    json || '"' !== cookie.charAt(0) || (cookie = cookie.slice(1, -1));
                    try {
                        var name = decode(parts[0]);
                        if (cookie = (converter.read || converter)(cookie, name) || decode(cookie), json) try {
                            cookie = JSON.parse(cookie);
                        } catch (e) {}
                        if (jar[name] = cookie, key === name) break;
                    } catch (e) {}
                }
                return key ? jar[key] : jar;
            }
        }
        return api.set = set, api.get = function(key) {
            return get(key, !1);
        }, api.getJSON = function(key) {
            return get(key, !0);
        }, api.remove = function(key, attributes) {
            set(key, "", extend(attributes, {
                expires: -1
            }));
        }, api.defaults = {}, api.withConverter = init, api;
    }
    return init(function() {});
}), jQuery(document).ready(function($) {}), jQuery(document).ready(function($) {
    $('[data-aawp-click-tracking="true"] a, a[data-aawp-click-tracking="true"]').on("click", function(e) {
        var link = $(this);
        if ("undefined" == typeof link.data("aawp-prevent-click-tracking")) {
            var container = $(this).attr("data-aawp-click-tracking") ? $(this) : $(this).closest('[data-aawp-click-tracking="true"]'), label = !1;
            if ("undefined" != typeof container.data("aawp-product-id") && (label = container.data("aawp-product-id")), 
            "undefined" != typeof container.data("aawp-product-title") && (label = container.data("aawp-product-title")), 
            label) {
                var category = "amazon-link", action = "click";
                "function" == typeof gtag ? gtag("event", action, {
                    event_category: category,
                    event_label: label
                }) : "undefined" != typeof ga ? ga("send", "event", category, action, label) : "undefined" != typeof _gaq ? _gaq.push([ "_trackEvent", category, action, label ]) : "undefined" != typeof __gaTracker ? __gaTracker("send", "event", category, action, label) : "undefined" != typeof _paq ? _paq.push([ "trackEvent", category, action, label ]) : "undefined" != typeof dataLayer && dataLayer.push({
                    event: "amazon-affiliate-link-click",
                    category: category,
                    action: action,
                    label: label
                });
            }
        }
    });
}), jQuery(document).ready(function($) {
    function handleGeotargeting() {
        userCountry = userCountry.toLowerCase(), localizedStores.hasOwnProperty(userCountry) && (storeTarget = localizedStores[userCountry], 
        storeTarget === storeCountry && debugMode === !1 || trackingIds.hasOwnProperty(storeTarget) && (localTrackingId = trackingIds[storeTarget], 
        update_amazon_links(storeCountry, storeTarget, localTrackingId)));
    }
    function getCountry() {
        "geoip-db" === api ? getCountryFromApiGeoipdb() : "ipinfo" === api ? getCountryFromApiIpinfo() : "dbip" === api ? getCountryFromApiDbIp() : getCountryFromApiGeoipdb();
    }
    function getCountryFromApiGeoipdb() {
        var requestUrl = "https://geolocation-db.com/jsonp/";
        devIP && (requestUrl = "https://geolocation-db.com/jsonp/" + devIP), jQuery.ajax({
            url: requestUrl,
            jsonpCallback: "callback",
            dataType: "jsonp",
            success: function(response) {
                "undefined" != typeof response.IPv4 && "undefined" != typeof response.country_code && (userCountry = response.country_code, 
                setGeotargetingCookie(userCountry)), handleGeotargeting();
            }
        });
    }
    function getCountryFromApiIpinfo() {
        var requestUrl = "https://ipinfo.io/json/";
        devIP && (requestUrl = "https://ipinfo.io/" + devIP + "/json/"), jQuery.ajax({
            url: requestUrl,
            jsonpCallback: "callback",
            dataType: "jsonp",
            success: function(response) {
                "undefined" != typeof response.ip && "undefined" != typeof response.country && (userCountry = response.country, 
                setGeotargetingCookie(userCountry)), handleGeotargeting();
            }
        });
    }
    function getCountryFromApiDbIp() {
        var requestUrl = "https://api.db-ip.com/v2/free/self/";
        devIP && (requestUrl = "https://api.db-ip.com/v2/free/" + devIP + "/"), jQuery.ajax({
            url: requestUrl,
            dataType: "json",
            crossDomain: !0,
            success: function(response) {
                "undefined" != typeof response.ipAddress && "undefined" != typeof response.countryCode && (userCountry = response.countryCode, 
                setGeotargetingCookie(userCountry)), handleGeotargeting();
            }
        });
    }
    function update_amazon_links(storeOld, storeNew, trackingId) {
        null !== trackingId && $("a[href*='/amazon'], a[href*='/www.amazon'], a[href*='/amzn'], a[href*='/www.amzn']").each(function(el) {
            var linkHasGeoDataAttribute = $(this).data("aawp-geotargeting");
            if (!linkHasGeoDataAttribute) {
                var containerHasGeoDataAttribute = $(this).closest("*[data-aawp-product-id]").data("aawp-geotargeting");
                if (!containerHasGeoDataAttribute) return;
            }
            var url = $(this).attr("href");
            "asin" === urlMode || url.indexOf("prime") != -1 ? url = get_url_mode_asin(url, storeOld, storeNew) : "title" === urlMode && (url = get_url_mode_title($(this), url, storeOld, storeNew)), 
            void 0 !== url && (url = replaceUrlParam(url, "tag", trackingId), $(this).attr("href", url));
        });
    }
    function get_url_mode_title(linkElement, url, storeOld, storeNew) {
        var productTitle = linkElement.data("aawp-product-title");
        return productTitle || (productTitle = linkElement.parents().filter(function() {
            return $(this).data("aawp-product-title");
        }).eq(0).data("aawp-product-title")), productTitle && (productTitle = getWords(productTitle, 5), 
        url = "https://www.amazon." + storeNew + "/s/?field-keywords=" + encodeURIComponent(productTitle)), 
        url;
    }
    function get_url_mode_asin(url, storeOld, storeNew) {
        var urlTypeShort = !1, urlTypeLong = !1;
        if (url.indexOf("amzn." + storeCountry) != -1 && (urlTypeShort = !0), url.indexOf("amazon." + storeCountry) != -1 && (urlTypeLong = !0), 
        (urlTypeShort || urlTypeLong) && url.indexOf("tag=") != -1) return url = "com" == storeOld && urlTypeShort ? url.replace("amzn." + storeOld, "amazon." + storeNew + "/dp") : "com" == storeNew ? url.replace("amazon." + storeOld, "amzn." + storeNew) : url.replace("amazon." + storeOld, "amazon." + storeNew);
    }
    function replaceUrlParam(url, paramName, paramValue) {
        null == paramValue && (paramValue = "");
        var pattern = new RegExp("\\b(" + paramName + "=).*?(&|$)");
        return url.search(pattern) >= 0 ? url.replace(pattern, "$1" + paramValue + "$2") : url + (url.indexOf("?") > 0 ? "&" : "?") + paramName + "=" + paramValue;
    }
    function getWords(str, max) {
        return str.split(/\s+/).slice(0, max).join(" ");
    }
    function setGeotargetingCookie(countryCode) {
        debugMode || countryCode && AAWPCookies.set("aawp-geotargeting", countryCode);
    }
    function isGeotargetingDebugMode() {
        var vars = {};
        return window.location.href.replace(location.hash, "").replace(/[?&]+([^=&]+)=?([^&]*)?/gi, function(m, key, value) {
            vars[key] = void 0 !== value ? value : "";
        }), !!vars.aawp_debug_geotargeting;
    }
    function getGeotargetingDebugIP() {
        var vars = {};
        return window.location.href.replace(location.hash, "").replace(/[?&]+([^=&]+)=?([^&]*)?/gi, function(m, key, value) {
            vars[key] = void 0 !== value ? value : "";
        }), vars.aawp_debug_geotargeting_ip ? vars.aawp_debug_geotargeting_ip : "";
    }
    if ("undefined" != typeof aawp_geotargeting_settings && "undefined" != typeof aawp_geotargeting_localized_stores && "undefined" != typeof aawp_geotargeting_tracking_ids) {
        var devIP = getGeotargetingDebugIP(), debugMode = isGeotargetingDebugMode(), api = "undefined" != typeof aawp_geotargeting_api ? aawp_geotargeting_api : "", settings = aawp_geotargeting_settings, localizedStores = aawp_geotargeting_localized_stores, trackingIds = aawp_geotargeting_tracking_ids;
        if (!settings.hasOwnProperty("store")) return;
        var urlMode = settings.hasOwnProperty("mode") ? settings.mode : "mode", storeCountry = settings.store, storeTarget = "", userCountry = "", localTrackingId = "", AAWPCookies = Cookies.noConflict(), geotargetingCookie = AAWPCookies.get("aawp-geotargeting");
        void 0 !== geotargetingCookie && debugMode === !1 ? (userCountry = geotargetingCookie, 
        handleGeotargeting()) : getCountry();
    }
});