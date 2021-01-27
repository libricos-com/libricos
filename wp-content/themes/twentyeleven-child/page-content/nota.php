<?php 
    global $post;
    $postType = get_post_type();
    $id = get_the_id();

    $titulo = get_post_meta( $id, 'titulo', true );
    $post_title = get_the_title();
    $url = esc_url( get_permalink( $id ) );

    $texto = get_post_meta($id,'contenido')[0];
  
    //get Pods object for current post
    $pod = pods( 'nota', $id );

    $libro = $pod->field( 'libro' );
    $asin = get_post_meta($libro['ID'],'asin')[0];
    $portada = get_post_meta($libro['ID'],'portada');
    
    $src = get_the_post_thumbnail_url( $id, 'post_thumbnail'  );

    $fecha = get_the_date('d F Y');

    $libro_link = get_permalink($libro['ID']);
    $libro_title = get_the_title($libro['ID']);
    $titulo_a_secas = get_post_meta($libro['ID'],'titulo')[0];

    $keywords = $titulo_a_secas;
    // TODO: notas, pasar keywords a bbdd? 
    // Apuntes los 4 amores
    if($id== 8734){
        $keywords = 'amor psicología';
    }elseif($id==5042){ // 'benedicto 16'
        $keywords = 'benedicto 16';
    }elseif($id==5046){ // 'bautismo'
        $keywords = 'bautismo cristo';
    }elseif($id==5027){ // 'tentaciones'
        $keywords = 'tentaciones cristo';
    }elseif($id==5049){ // 'bienaventuranzas'
        $keywords = 'bienaventuranzas';
    }elseif($id==5875){ // 'imagenes evangelio juan'
        $keywords = 'san juan';
    }elseif($id==5995){ // 'confesión san pedro'
        $keywords = 'san pedro';
    }elseif($id==6161){ // 'nombres jesús'
        $keywords = 'jesucristo';
    }elseif($id==6070){ // 'transfiguración'
        $keywords = 'transfiguración cristo';
    }elseif($id==6293){ // 'discípulos'
        $keywords = 'apostoles cristo';
    }elseif($id==6319){ // 'torá'
        $keywords = 'cristo judaismo';
    }elseif($id==6573){ // 'domingo ramos'
        $keywords = 'cristo pascua';
    }elseif($id==6658){ // 'última cena'
        $keywords = 'última cena cristo';
    }elseif($id==6747){ // 'getsemaní'
        $keywords = 'jerusalen';
    }elseif($id==7173){ // 'ascensión'
        $keywords = 'ascensión cristo';
    }elseif($id==7089){ // 'resurrección'
        $keywords = 'resurrección cristo';
    }elseif($id==6941){ // 'crucifixión y sepultura'
        $keywords = 'pasión cristo';
    }elseif($id==6883){ // 'juicio a cristo'
        $keywords = 'libros cuaresma';
    }
?>
<div class="lbc-file">
    <h1 class="lbc-h1"><?php echo $post_title;?></h1>

    <?php echo view('../partials/publish-info', ['this2' => $post]);?>

    <div class="mt-3">
        <?php echo do_shortcode("[addthis tool='addthis_inline_share_toolbox_qzzu']");?>
    </div>

    <hr />

    <div>
        <div class="d-flex justify-content-end float-right col-sm-6 col-md-4">
            <?php echo do_shortcode(' [amazon box="'.$asin.'" template="vertical" style="dark" value="thumb" image_size="large"] ');?>
        </div>
        <div class="lbc-contenido">
            <?php echo $texto;?>
        </div>  
    </div>
    
</div>


<hr />
<div class="text-center p-2">
    <?php echo do_shortcode('[amazon box="'.$asin.'"]');?>
</div>
<hr />

<h2>Libros similares</h2>
<div class="text-center p-2">
    <?php 
    echo do_shortcode('[amazon bestseller="'.$keywords.'" template="vertical" grid="3" items="12"]');
    ?>
</div>



