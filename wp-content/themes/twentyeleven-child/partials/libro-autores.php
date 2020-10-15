<?php
if(!empty($this2->autores)){
?>    
    <div class="book-authors">
        By 
        <ul class="list-inline-pipe">
        <?php
        foreach($this2->autores as $autor){
            ?>
            <li class="list-inline-item">
                <a href="<?php echo esc_url( get_permalink( $autor['ID'] ) );?>" alt=""><?php echo $autor['post_title'];?></a>
            </li>
            <?php
        }
        ?>
        </ul>
    </div>
<?php
}
?>