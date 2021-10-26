<?php
/**
 * @package default
 * @author mattias@konst-teknik.se
 */
class SKFCptActivities
{
	public function __construct()
	{
		add_action( 'init', array( $this, 'register' ) );
		add_action( 'init', array( $this, 'register_taxonomy' ) );
	}

	/**
	 * Registrerar CPTn
	 */
	public function register()
	{
		register_post_type( 'activities', array(
			'label'  => "Aktiteter",
			'labels' => array(
				'name'               => "Aktiviteter",
				'singular_name'      => "Aktivitet",
				'add_new'            => "Ny aktivitet",
				'all_items'          => "Alla aktiviteter",
				'add_new_item'       => "Lägg till aktivitet",
				'edit_item'          => "Redigigera aktivitet",
				'new_item'           => "Ny aktivitet",
				'view_item'          => "Visa aktivitet",
				'search_items'       => "Sök aktivitet",
				'not_found'          => "Ingen aktivitet hittad",
				'not_found_in_trash' => "Ingen aktivitet i papperskorgen",
				'menu_name'          => "Aktiviteter"
			),
			'description' => "Represents a Activity Post",
			'public' => true,
			'exclude_from_search' => false,
			'menu_icon' => 'dashicons-format-chat',
			'menu_position' => 5,
			'has_archive' => true,
			'rewrite' =>array( 'slug' => 'aktiviteter', 'with_front' => false ),
			'publicly_queryable' => true,
			'supports' => array(
				'title',
				'revisions',
				'thumbnail',
				'author'
			),
		)
		);
	}

	public function register_taxonomy()
	{
		register_taxonomy( 'activities-category', 'activities', array(
			'label' => 'Kategorier',
			'hierarchical' => true
		));
		register_taxonomy_for_object_type( 'activities-category', 'activities' );
	}
}

new SKFCptActivities();
