<?php
function the_dramatist_return_post_id() 
{
    global $post;
    $postType = get_post_type();

    return do_shortcode('[pods name="'.$postType.'" id="'.$post->ID.'" template="Blog Intro '.$postType.'"]') ?? '';
}

function get_kkstarring() 
{
    return do_shortcode('[kkstarratings force="false" valign="bottom" align="left"]');
}

/*
0 | Por leer
1 | Siguiente
2 | Leído
3 | Leyendo
4 | Cerrado
5 | Pausado
6 | No interesado
7 | Cuarentena
*/
function get_amazon_grid_shortcode_beta($estado = 2) 
{
    return do_shortcode('[pods name="libro" limit="99" where="estado.meta_value='.$estado.'" orderby="post_date DESC" template="Libros Amazon Grid"]');
}

function get_grid_reviews_shortcode() 
{
    return do_shortcode('[pods name="review" limit="99" orderby="post_date DESC" template="Reviews Grid Template"]');
}



