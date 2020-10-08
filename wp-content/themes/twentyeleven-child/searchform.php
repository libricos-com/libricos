<?php
/**
 * Template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<form class="jeisearchbox input-group" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group-prepend">
        <div for="s" class="input-group-text"><i class="fa fa-search"></i></div>
    </div>

    <input name="s" class="form-control py-2 border-right-0 border" type="search" placeholder="<?php esc_attr_e( 'Search', 'twentyeleven' );?>" onfocus="this.placeholder=''" onblur="this.placeholder='<?php esc_attr_e( 'Search', 'twentyeleven' );?>'">
    
    <span class="input-group-append">
        <button class="btn btn-outline-secondary border-left-0 border input-group-text" type="submit" name="submit" id="searchsubmit"><?php esc_attr_e( 'Search', 'twentyeleven' ); ?></button>
    </span>
</form>


