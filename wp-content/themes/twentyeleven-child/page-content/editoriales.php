<h1>Editoriales</h1>
<?php
$args = array(
    'post_type' => 'editorial',
    'post_status' => 'publish',
    'posts_per_page' => -1
);

global $wp_query;
query_posts($args);
if ( have_posts() ) { 
    twentyeleven_content_nav( 'nav-above' );
    ?>
    <ul>
        <?php
        $i = 0;
        while(have_posts()){
            the_post(); 
            // the_content();
            // get_template_part( 'content', get_post_format() ); 
            $id = get_the_ID();
            $titulo = get_the_title();
            $url = esc_url( get_permalink( $id ) );
            // $pod = pods( 'editorial', $id );
            ?>
                <li>
                    <a href="<?php echo $url;?>"><?php echo $titulo;?></a>
                </li>
            <?php
            $i++;
        }
        ?>    
    </ul>
    <?php
    twentyeleven_content_nav( 'nav-below' );
}
wp_reset_query();
