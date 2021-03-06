<?php
/**
 * Template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$term = get_queried_object(); // object "clásicos"
$asins = $ids = '';
$args = array(
    'posts_per_page' => -1,
    // 'orderby' => 'rand',
    'tax_query' => array (
        array (
        'taxonomy' => $term->taxonomy,
        'field' => 'id',
        'terms' => $term->term_id,
    //    using a slug is also possible
    //    'field' => 'slug', 
    //    'terms' => $qobj->name
        )
    )
);

$query = new WP_Query( $args );
if ($query->have_posts()) {
    while ( $query->have_posts() ) : $query->the_post();
        /*
        * Include the Post-Format-specific template for the content.
        * If you want to overload this in a child theme then include a file
        * called content-___.php (where ___ is the Post Format name) and that
        * will be used instead.
        */
        $post = get_post();
        $post_type = $post->post_type;
        $id = $post->ID;
        switch ($post_type) {
            case 'libro':
                $asin = get_post_meta( $id, 'asin', true );
                break;
            case 'review':
                $libro = get_post_meta( $id, 'libro', true );
                $id = $libro['ID'];
                $asin = get_post_meta( $id, 'asin', true );
                break;
            case 'nota':
                $libro = get_post_meta( $id, 'libro', true );
                $id = $libro['ID'];
                $asin = get_post_meta( $id, 'asin', true );
                break;
            default:
                
                break;
        }
        $asins .= $asin.',';
        $ids .= $id.',';
    endwhile; 

    // Remove duplicate ids
    $asins = implode(',', array_unique(explode(',', $asins)));
    $ids = implode(',', array_unique(explode(',', $ids)));
}
?>

<?php get_header();?>

<section id="primary">
    <div id="content" role="main">

    <?php if ( have_posts() ) : ?>

        <header class="entry-header">
            <h1 class="entry-title">
                <?php
                if(empty($asins)){ 
                    if ( is_day() ) {
                        /* translators: %s: Date. */
                        printf( __( 'Daily Archives: %s', 'twentyeleven' ), '<span>' . get_the_date() . '</span>' );
                    } elseif ( is_month() ) {
                        /* translators: %s: Date. */
                        printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyeleven' ) ) . '</span>' );
                    } elseif ( is_year() ) {
                        /* translators: %s: Date. */
                        printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentyeleven' ) ) . '</span>' );
                    } else {
                        _e( 'Blog Archives', 'twentyeleven' );
                    }   
                }else{
                    echo 'Libros de '.$term->name;
                }
                ?>
            </h1>
        </header>

        <?php twentyeleven_content_nav( 'nav-above' ); ?>

        <?php
        if(!empty($asins)){ 
            echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3" template="my-vertical"]');
        }
        ?>

        <?php if(empty($asins)){?>
            <h2>Timeline</h2>
            <?php
            while ( have_posts() ) : the_post();
                // llamada por defecto de wordpress: como un artículo en el timeline de wordpress
                get_template_part( 'content', get_post_format() );
            endwhile;
        }
        ?>

        <h1>Otros libros de <?php echo $term->name;?></h1>
        <?php echo do_shortcode('[amazon template="vertical" grid="3" items="12" bestseller="%'.$term->name.'%"]'); ?>


        <?php twentyeleven_content_nav( 'nav-below' ); ?>

    <?php else : ?>

        <article id="post-0" class="post no-results not-found">
            <header class="entry-header">
                <h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
                <?php get_search_form(); ?>
            </div><!-- .entry-content -->
        </article><!-- #post-0 -->

    <?php endif; ?>

    </div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
