<?php /* Template Name: Taxonomia listado */ acf_form_head(); ?>
<?php get_header(); ?>
<?php
	$taxo = get_query_var('taxonomy');

    if($taxo):
        $terms = get_terms(array(
            'taxonomy' => $taxo,
            'hide_empty' => false
        ));
        foreach($terms as $term): ?>

        <a href="<?php echo get_blogInfo('url') ?>/wp-admin/term.php?taxonomy=<?php echo $taxo ?>&tag_ID=<?php echo $term->term_id ?>" class="btn">
            <?php echo $term->name; ?>
            <div class="edit">
                <i class="fas fa-edit"></i>
            </div>
        </a>

    <?php endforeach;
	endif;
?>

<?php get_footer(); ?>
