<?php /* Template Name: Taxonomia edit */ acf_form_head(); ?>
<?php get_header(); ?>
<?php
	$tag = get_query_var('tag_id');

	if($tag):
		acf_form(array(
			'post_id'		=> 'term_' . $tag,
			'field_groups' => array(43),
			'submit_value'		=> 'Guardar'
		));
	endif;
?>

<?php get_footer(); ?>
