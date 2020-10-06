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

// jdump($term);

while ( have_posts() ) : the_post();
    /*
    * Include the Post-Format-specific template for the content.
    * If you want to overload this in a child theme then include a file
    * called content-___.php (where ___ is the Post Format name) and that
    * will be used instead.
    */
    $post = get_post();
    $post_type = $post->post_type;
    switch ($post_type) {
        case 'libro':
            $id = $post->ID;
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
            // llamada por defecto de wordpress: como un artículo en el timeline de wordpress
            // get_template_part( 'content', get_post_format() );
            break;
    }
    $asins .= $asin.',';
    $ids .= $id.',';
endwhile; 
?>

<?php get_header();?>

<section id="primary">
    <div id="content" role="main">

    <?php if ( have_posts() ) : ?>

        <header class="page-header">
            <h1 class="page-title">
                <?php
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
                ?>
            </h1>
        </header>

        <?php twentyeleven_content_nav( 'nav-above' ); ?>

        <h2>Libros sobre <?php echo $term->name;?></h2>
        <?php
        // Remove duplicate ids
        $asins = implode(',', array_unique(explode(',', $asins)));
        $ids = implode(',', array_unique(explode(',', $ids)));
        echo do_shortcode('[amazon box="'.rtrim($asins,',').'" tpl_ids="'.rtrim($ids,',').'" grid="3"]');
        ?>

        <h2>Timeline</h2>
        <?php
        // Start the Loop.
        while ( have_posts() ) : the_post();
            // llamada por defecto de wordpress: como un artículo en el timeline de wordpress
            get_template_part( 'content', get_post_format() );
        endwhile;
        ?>

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
