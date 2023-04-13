<?php /* Template Name: Formulario */ acf_form_head(); ?>
<?php get_header(); ?>

<?php if(is_user_logged_in()): ?>

<a href="<?php echo get_blogInfo('url') ?>" class="btn">Inicio</a>

<?php
	$user_id = get_current_user_id();
    $user_info = get_userdata( $user_id );
    $user_roles = implode(', ', $user_info->roles);
    // print_r($user_roles);

    $fields_role = array(5);

    if($user_roles == 'administrator' || $user_roles == 'registrador'):
    	$fields_role = array(5,130,417);
    endif;
?>

<?php
	$elemento = get_query_var('single_id');

	if($elemento):
		acf_form(array(
			'id' => 'registro',
			'post_id'		=> $elemento,
			'field_groups' => $fields_role,
			'submit_value'		=> 'Actualizar'
		));
	else:
		acf_form(array(
			'id' => 'nuevo_elemento',
			'post_id'		=> 'new_post',
			'field_groups' => array(5),
			'new_post'		=> array(
				'post_type'		=> 'post',
				'post_status'		=> 'publish'
			),
			'submit_value'		=> 'Guardar'
		));
	endif;
?>

<?php endif; ?>

<?php get_footer(); ?>