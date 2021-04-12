<div class="mb-4">
    <?php echo view('../searchform', ['this2' => [] ]);?>
</div>

<div class="mb-4">
    <?php
    echo do_shortcode('[better_recent_comments number="10" date_format="M j Y, H:i"
        format="{avatar} {author} en {post}: “{comment}” {date}" avatar_size="25" 
        post_status="publish" excerpts="true"]'); 
    ?>
</div>

<div class="mb-4">
    <?php echo do_shortcode('[wpb_popular_tags]');?>
</div>

<div class="mb-4">
    <?php
    $args = array(
    'taxonomy' => 'genero',
    'hide_empty' => false
    );
    $terms = get_terms($args);
    if($terms){
        echo view('../partials/searchform-complete', array(
            'this2' => (object)[
            'terms' => $terms,
            'placeholder' => 'Busca libricos por temática, título, autor, ...'
            ])
        );
    }
    ?>
</div>