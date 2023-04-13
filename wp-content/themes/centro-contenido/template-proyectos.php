<?php /* Template Name: Proyecto edit */ acf_form_head(); ?>
<?php get_header(); ?>
<?php
	$tag = get_query_var('pro_id');

	if($tag):
		acf_form(array(
			'post_id'		=> 'term_' . $tag,
			'field_groups' => array(409),
			'submit_value'		=> 'Guardar'
		));

	else:

	$terms = get_terms('proyecto', array(
    'hide_empty' => false,
) );
?>

<div id="taxonomiasListado">
    
<?php foreach ($terms as $term): ?>

<a class="btn" href="<?php echo get_bloginfo('url')?>/proyectos?pro_id=<?php echo $term->term_id ?>"><?php echo $term->name ?></a>

<?php endforeach; ?>

</div>
	<?php endif; ?>

<?php get_footer(); ?>
