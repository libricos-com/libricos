<?php
if(!empty($this2->autores)){
?>    
    <div class="book-authors">
        Por 
        <ul class="list-inline-pipe">
        <?php
        foreach($this2->autores as $autor){
            $img = get_the_post_thumbnail_url($autor['ID'],'thumbnail');
            $pod = pods("autor", $autor['ID']);
            $portada = $pod->field( 'portada' );
            $img = wp_get_attachment_image_src($portada['ID'], 200)[0];
        ?>
            <li class="list-inline-item">
                <div class="chip align-bottom">
                    <a href="<?php echo esc_url( get_permalink( $autor['ID'] ) );?>" target="blank" title="Autor <?php echo $autor['post_title'];?>">
                        <img src="<?php echo $img;?>" alt="<?php echo $autor['post_title'];?>" title="Autor <?php echo $autor['post_title'];?>">
                    </a> 
                </div>
                <a href="<?php echo esc_url( get_permalink( $autor['ID'] ) );?>" title="Autor"><?php echo $autor['post_title'];?></a>
            </li>

            <?php
        }
        ?>
        </ul>
    </div>
<?php
}
?>