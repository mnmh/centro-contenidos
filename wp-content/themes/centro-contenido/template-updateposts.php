<?php /* Template Name: Update */ acf_form_head(); ?>
<?php get_header(); ?>

<?php
$updateid = get_query_var('updateid');

if($updateid):
	$args = array(
		'include' => array($updateid),
        'numberposts' => 1,
        'post_status' => 'publish'
    );

    $preregistro = get_posts( $args );

    // print_r($preregistro);

    // echo strtotime('today');

    foreach ($preregistro as $item):

    	

    	// print_r($new_args);

		// error_log('message');

		$titulo = get_field('titulo', $item->ID);
		
		//if(get_the_title() == '') {
			$new_args = array(
				'ID' => $item->ID,
				'post_title' => $titulo,
				'post_status' => 'publish'
				// 'post_date_gmt' => gmdate( 'Y-m-d H:i:s', strtotime('today') )
			);
			wp_update_post($new_args);
		//}

		$archivos = get_field('archivos', $item->ID);

		// echo print_r($archivos);

		
		if($archivos){
			if(count($archivos) > 1){

				for($i = 0; $i < count($archivos); $i++){
					$args = array(
						'post_title' => $titulo,
						'post_status' => 'publish'
					);
					
					$newId = wp_insert_post($args);
					// $newId = 1;
					if($newId > 0){
						// Actualizar el campo de archivo
						$field = 'field_5da62ff32695b';
						$value = array(
							$archivos[$i]
						);

						update_field($field, $value, $newId);
						sleep(1);
						
						duplicarCampo('tipo_contenido_copy', $newId, $item->ID);
						duplicarCampo('imagen_destacada', $newId, $item->ID);
						duplicarCampo('titulo', $newId, $item->ID);
						duplicarCampo('enlace_externo', $newId, $item->ID);
						duplicarCampo('fecha', $newId, $item->ID);
						duplicarCampo('tipo_contenido', $newId, $item->ID);
						duplicarCampo('clase_contenido', $newId, $item->ID);
						duplicarCampo('pais', $newId, $item->ID);
						duplicarCampo('departamento', $newId, $item->ID);
						duplicarCampo('ciudad', $newId, $item->ID);
						duplicarCampo('corregimiento', $newId, $item->ID);
						duplicarCampo('iniciativa', $newId, $item->ID);
						duplicarCampo('tipo_vic', $newId, $item->ID);
						duplicarCampo('etiquetas', $newId, $item->ID);
						duplicarCampo('descripcion', $newId, $item->ID);
						duplicarCampo('autores', $newId, $item->ID);
						duplicarCampo('creditos', $newId, $item->ID);
						duplicarCampo('derechos', $newId, $item->ID);
						duplicarCampo('observaciones', $newId, $item->ID);
						duplicarCampo('denominacion', $newId, $item->ID);
						duplicarCampo('proyecto', $newId, $item->ID);
						duplicarCampo('procedencia', $newId, $item->ID);
						duplicarCampo('avaluo', $newId, $item->ID);
						duplicarCampo('moneda', $newId, $item->ID);
						duplicarCampo('licencias_uso', $newId, $item->ID);
						duplicarCampo('observaciones_registro', $newId, $item->ID);
					}
				}

				wp_delete_post($item->ID, true);

				echo 'Se crearon ' . count($archivos) . ' de la entrada ' . $titulo;
			}
		}
		


?>

<div class="elemento">
	<!-- <?php echo get_field('titulo', $item->ID) ?> -->
</div>

<?php

endforeach;
endif;

function duplicarCampo($campo, $newId, $oldId) {
	$field = acf_get_field( $campo, $oldId );
	$field_key = $field['key'];
	$value = get_field($campo, $oldId);
	if($value){
		update_field($field_key, $value, $newId);
		sleep(1);
	}
	// echo $field_key;
}

?>

<?php get_footer(); ?>
