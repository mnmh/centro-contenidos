	<?php /* Template Name: Listado pre-registro */ acf_form_head(); ?>
<?php get_header(); ?>

<table>


<?php
$args = array(
    'numberposts' => -1,
    'post_status' => array('draft', 'publish')
);

$preregistro = get_posts( $args );

$numItem = 1;

foreach($preregistro as $item):

    $postID = $item->ID;
    $archivos = [];

    if($postID != 30 && $postID != 20 && $postID != 17 && $postID != 15):
?>

<?php
        $archivos = get_field('archivos', $postID);
        // print_r($archivos);

        if($archivos) $num = count($archivos);

        if(!$archivos) $num = 1;

        if($num == 0) $num = 1;

            for($i = 0; $i < $num; $i++): ?>

            	<tr>
            		<th>

						<?php echo $numItem; $numItem++; ?>

					</th>
					<th><?php echo get_field('titulo', $postID) ?></th>
					<th><?php
					    $terms = get_the_terms($postID, 'tipo-de-contenido');
					    if($terms):
					    foreach($terms as $term){
					        echo $term->name;

					        // $index = array_search($term->name, $listadoTipos);
					        // $tiposCount[$index]+=1;
					        // if($num > 1)
					        //     $tiposCount[$index]+=$num - 1;
					    }
					    endif; 
					?></th>
					<th>
						<?php
						    $terms = get_the_terms($postID, 'post_tag');
						    if($terms):
						    foreach($terms as $term){
						        echo $term->name . ', ';

						        // $index = array_search($term->name, $listadoTipos);
						        // $tiposCount[$index]+=1;
						        // if($num > 1)
						        //     $tiposCount[$index]+=$num - 1;
						    }
						    endif; 
						?>
					</th>
					<th>
						<?php echo $archivos[$i]['archivo']['subtype'] ?>
					</th>
					<th>
                                                http://www.museodememoria.gov.co/centro-de-contenido/?contenido=<?php echo $postID ?>
                                        </th>

					<th>
						<?php echo intval($archivos[$i]['archivo']['filesize'])/1000000 ?> Mb.
					</th>
				</tr>

            <?php endfor;
        // endif;
    ?>


<?php
endif;endforeach;
?>

</table>

<?php get_footer(); ?>
