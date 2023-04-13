<?php /* Template Name: Listado pre-registro */ acf_form_head(); ?>
<?php get_header(); ?>

<table>


<?php
$args = array(
    'numberposts' => -1,
    'post_status' => 'draft'
);

$preregistro = get_posts( $args );

foreach($preregistro as $item):

    $postID = $item->ID;

    if($postID != 30 && $postID != 20 && $postID != 17 && $postID != 15):
?>

<tr>
<th><?php echo get_field('titulo', $postID) ?></th>
<th><a href="<?php echo get_blogInfo('url') ?>/?single_id=<?php echo $postID?>">Editar</a></th>
</tr>
<?php
endif;endforeach;
?>

</table>

<?php get_footer(); ?>
