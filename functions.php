<?php

add_action( 'wp_enqueue_scripts', 'elegant_enqueue_css' );

function elegant_enqueue_css() {
	$css_cache_buster = date("YmdHi", filemtime( get_stylesheet_directory() . '/child-theme.css'));

	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'child-theme-style', get_stylesheet_directory_uri() . '/child-theme.css', array(), $css_cache_buster, 'all' );

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


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
        'page_title'    => 'Website General Settings',
        'menu_title'    => 'Site Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false,
		'position' => '2.69',
		'icon_url' => get_stylesheet_directory_uri() . '/assets/icons/settings-icon.png'

    ));

    acf_add_options_sub_page(array(
        'page_title'    => 'Reviews Title and Stars',
        'menu_title'    => 'Reviews',
        'parent_slug'   => 'edit.php?post_type=product',
    ));

	acf_add_options_sub_page(array(
        'page_title'    => 'Call To Action',
        'menu_title'    => 'Call To Action',
        'parent_slug'   => 'theme-general-settings',
    ));

	acf_add_options_sub_page(array(
        'page_title'    => 'Wine Club Bottles',
        'menu_title'    => 'Wine Club',
        'parent_slug'   => 'theme-general-settings',
    ));

}


function wine_club_cta_shortcode() {
	ob_start();
	get_template_part('template-parts/cta');
	return ob_get_clean();
}

add_shortcode('wine_club_cta', 'wine_club_cta_shortcode');


function wine_club_bottles_shortcode() {
	ob_start();
	get_template_part('template-parts/bottles');
	return ob_get_clean();
}

add_shortcode('wine_club_bottles', 'wine_club_bottles_shortcode');
