<div class="mb-4">
    <?php echo view('../searchform', ['this2' => [] ]);?>
</div>

<div class="mb-4">
    <h4>Últimos comentarios</h4>
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
    <?php require_once('sidebar/reading-now.php');?>
</div>

<div class="mb-4">
    <?php require_once('sidebar/reading-next.php');?>
</div>