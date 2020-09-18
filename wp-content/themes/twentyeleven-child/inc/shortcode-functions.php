<?php
function the_dramatist_return_post_id() 
{
    global $post;
    $postType = get_post_type();

    return do_shortcode('[pods name="'.$postType.'" id="'.$post->ID.'" template="Blog Intro '.$postType.'"]') ?? '';
}