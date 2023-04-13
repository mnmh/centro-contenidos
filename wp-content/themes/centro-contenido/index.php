<?php acf_form_head(); ?>
<?php get_header(); ?>

<?php if(is_user_logged_in()): ?>

<?php
	$usuario = wp_get_current_user();
?>

<!-- INFORMACION DEL USUARIO -->
<div id="userInfo">
    <h1><?php echo $usuario->user_nicename ?></h1>
</div>

<!-- LINKS PARA SUBIDA DE INFORMACIÓN -->
<div id="subidaBtns">
    <a href="#" class="item">
        <div class="img">
        <i class="fas fa-file-upload"></i>
        </div>
        <div class="txt">
            <h4>Subir a la bodega de contenido</h4>
            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur unde voluptas, quod, asperiores alias iusto, quam veritatis repellendus praesentium nulla repellat impedit facere porro adipisci. Labore dolores voluptatem officiis dolore.</h6>
        </div>
    </a>

    <a href="#" class="item">
        <div class="img">
        <i class="fas fa-file-upload"></i>
        </div>
        <div class="txt">
            <h4>Subir a la bodega de archivos</h4>
            <h6>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur unde voluptas, quod, asperiores alias iusto, quam veritatis repellendus praesentium nulla repellat impedit facere porro adipisci. Labore dolores voluptatem officiis dolore.</h6>
        </div>
    </a>
</div>

<?php
$listadoTipos = get_terms( 'tipo-de-contenido', array(
    'hide_empty' => false,
    'fields' =>  'names'
));

$tiposCount = array();
$newSize = count($listadoTipos);
$tiposCount = array_pad($tiposCount, $newSize, 0);

$user_id = get_current_user_id();
$user_info = get_userdata( $user_id );
$user_roles = implode(', ', $user_info->roles);

$args = array(
    'numberposts' => 10,
    'post_status' => array('draft', 'publish'),
    'author' => $user_id
);

if($user_roles == 'administrator' || $user_roles == 'registrador'):
    $args = array(
        'numberposts' => -1,
        'post_status' => array('draft', 'publish')
    );
endif;

$preregistro = get_posts( $args );
?>

<div class="acordeon" data-div="listadoElementos">
    <div class="name">Pre-registro</div>
    <!-- <div class="count"><?php echo count($preregistro) ?></div> -->
    <div class="icon">
        <i class="fas fa-sort-down"></i>
    </div>
</div>
<div id="listadoElementos">
<?php

foreach($preregistro as $item):

    $postID = $item->ID;
    $authorID = $item->post_author;

    if($postID != 73 && $postID != 30 && $postID != 20 && $postID != 17 && $postID != 15):
?>

<div class="elemento">
    <div class="left">
        <?php $terms = get_the_terms($postID, 'tipo-de-contenido'); ?>
        <?php $archivos = get_field('archivos', $postID); ?>
        <?php
            if($terms[0]->name == 'Gráfica' && count($archivos)):
        ?>
            <img src="<?php echo $archivos[0]['archivo']['sizes']['thumbnail'] ?>" alt="">
        <?php endif ?>
    </div>
    <div class="right">
    
        <div class="nombre">
            <?php echo get_field('titulo', $postID) ?>
        </div>

        <?php
           /* $archivos = get_field('archivos', $postID);*/
            if($archivos):
                $num = count($archivos);
            endif;
        ?>

        <div class="info">
            <div class="tipo">
                <?php
                    /*$terms = get_the_terms($postID, 'tipo-de-contenido');*/
                    if($terms):
                    foreach($terms as $term){
                        echo $term->name;

                        $index = array_search($term->name, $listadoTipos);
                        $tiposCount[$index]+=1;
                        // if($num > 1)
                        //     $tiposCount[$index]+=$num - 1;
                    }
                    endif; 
                ?>
            </div>
            <div class="clase">
                <?php
                    $terms = get_the_terms($postID, 'clase-de-contenido');
                    if($terms):
                    foreach($terms as $term){
                        echo $term->name;
                    }
                    endif; 
                ?>
            </div>
            <div class="archivos">
                <?php if($archivos):
                    if($num > 1):
                        echo $num . ' archivos';
                    else:
                        echo '1 archivo';
                    endif;

                else:
                    echo 'no hay archivos';

                endif; ?>
            </div>
            
            <div class="autor">
                <?php the_author_meta( 'user_nicename' , $authorID ); ?>
            </div>

            <div class="identificador">
                <?php echo $postID ?>
            </div>

            <a href="<?php echo get_blogInfo('url') ?>/?page_id=67&single_id=<?php echo $postID?>">
                <i class="fas fa-edit"></i>
            </a>

            <a href="#">
                <?php
                    $terms = get_the_terms($postID, 'tipo');
                    $resp = '';
                    if($terms):
                        // $resp .= $terms[0]->name;
                    endif;

                    $terms = get_the_terms($postID, 'tipo-de-contenido');
                    if($terms):
                        $l = '';
                        if($terms[0]->name == 'Gráfica') $l = 'G';
                        elseif($terms[0]->name == 'Interactivo') $l = 'N';
                        elseif($terms[0]->name == 'Audiovisual') $l = 'D';
                        elseif($terms[0]->name == 'Publicación') $l = 'P';
                        elseif($terms[0]->name == 'Sonoro') $l = 'S';
                        elseif($terms[0]->name == 'Audio') $l = 'A';
                        elseif($terms[0]->name == 'Video') $l = 'V';
                        elseif($terms[0]->name == 'Imagen') $l = 'I';
                        elseif($terms[0]->name == 'Sonoro') $l = 'S';
                        $resp .= $l;
                    endif;

                    $resp .= sprintf('%09d', $postID);

                    echo $resp;
                ?>
            </a>

            <?php if($archivos):
                if($num > 1):
            ?>
            <a href="<?php echo get_blogInfo('url') ?>/update?updateid=<?php echo $postID?>">
                Separar archivos
            </a>
            <?php endif;endif; ?>

            

            <!-- <a href="">
                <i class="fas fa-trash"></i>
            </a> -->
        </div>
    </div>
</div>
<?php
endif;endforeach;
?>
</div>

<div class="navTaxonomia">
    <?php $total = 0; ?>
    <?php for($i = 0; $i < count($listadoTipos); $i++): ?>
        <div class="taxo">
            <?php echo $listadoTipos[$i]; ?>
            <span>
                <?php echo $tiposCount[$i]; ?>
                <?php $total += $tiposCount[$i]; ?>
            </span>
        </div>
    <?php endfor; ?>

    <div class="taxo">
        TOTAL
        <span>
            <?php echo $total ?>
        </span>
    </div>
</div>

<div id="taxonomiasListado">
    <a href="" class="btn">Etiquetas</a>
</div>

<?php endif; ?>

<?php get_footer(); ?>
