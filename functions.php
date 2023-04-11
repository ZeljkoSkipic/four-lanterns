<?php

add_action( 'wp_enqueue_scripts', 'elegant_enqueue_css' );

function elegant_enqueue_css() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	if(is_singular('product'))
	{
		wp_enqueue_script( 'flickity', get_stylesheet_directory_uri() . '/js/vendor/flickity.js',array('jquery'), '2.3.0' ,true);
		wp_enqueue_script( 'slider', get_stylesheet_directory_uri() . '/js/slider.js',array('jquery'),'2.3.0',true);
	}


}



add_filter('acf/settings/save_json', 'my_acf_json_save_point');

function my_acf_json_save_point( $path ) {

    // update path
    $path = get_stylesheet_directory() . '/acf-json';


    // return
    return $path;

}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {

    // remove original path (optional)
    unset($paths[0]);


    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';


    // return
    return $paths;

}


/**
 *	This will hide the Divi "Project" post type.
 *	Thanks to georgiee (https://gist.github.com/EngageWP/062edef103469b1177bc#gistcomment-1801080) for his improved solution.
 */
add_filter( 'et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1 );
function mytheme_et_project_posttype_args( $args ) {
	return array_merge( $args, array(
		'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
	));
}


register_post_type( 'product', array(
	'labels' => array(
		'name' => 'Products',
		'singular_name' => 'Product',
		'menu_name' => 'Products',
		'all_items' => 'All Products',
		'edit_item' => 'Edit Product',
		'view_item' => 'View Product',
		'view_items' => 'View Products',
		'add_new_item' => 'Add New Product',
		'new_item' => 'New Product',
		'parent_item_colon' => 'Parent Product:',
		'search_items' => 'Search Products',
		'not_found' => 'No products found',
		'not_found_in_trash' => 'No products found in Trash',
		'archives' => 'Product Archives',
		'attributes' => 'Product Attributes',
		'insert_into_item' => 'Insert into product',
		'uploaded_to_this_item' => 'Uploaded to this product',
		'filter_items_list' => 'Filter products list',
		'filter_by_date' => 'Filter products by date',
		'items_list_navigation' => 'Products list navigation',
		'items_list' => 'Products list',
		'item_published' => 'Product published',
		'item_published_privately' => 'Product published privately.',
		'item_reverted_to_draft' => 'Product reverted to draft.',
		'item_scheduled' => 'Product scheduled.',
		'item_updated' => 'Product updated.',
		'item_link' => 'Product Link',
		'item_link_description' => 'A link to a product.',
	),
	'public' => true,
	'exclude_from_search' => false,
	'show_in_rest' => true,
	'menu_icon' => 'dashicons-cart',
	'supports' => array(
		0 => 'title',
		1 => 'excerpt',
		2 => 'revisions',
		3 => 'thumbnail',
	),
	'delete_with_user' => false,
) );
