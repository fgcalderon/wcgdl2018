<?php 

add_action('init', 'register_custom_taxonomies');

	function register_custom_taxonomies() {

		//TAXONOMY
		// Add new taxonomy, make it hierarchical (like categories)
		$labels_autor = array(
			'name'              => _x( 'Autores', 'taxonomy general name' ),
			'singular_name'     => _x( 'Autor', 'taxonomy singular name' ),
			'search_items'      => __( 'Buscar autor' ),
			'all_items'         => __( 'Todos los autores' ),
			'edit_item'         => __( 'Editar autor' ),
			'update_item'       => __( 'Actualizar autor' ),
			'add_new_item'      => __( 'Añadir nuevo autor' ),
			'new_item_name'     => __( 'Nuevo autor' ),
			'menu_name'         => __( 'Autor' ),
		);

		$args_autor = array(
			'hierarchical'      => true,
			'labels'            => $labels_autor,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_nav_menus'	=> true,
			'rewrite'           => array( 'slug' => 'autores' ),
		);

		$labels_idioma = array(
			'name'              => _x( 'Idiomas', 'taxonomy general name' ),
			'singular_name'     => _x( 'Idioma', 'taxonomy singular name' ),
			'search_items'      => __( 'Buscar idioma' ),
			'all_items'         => __( 'Todos los idiomaes' ),
			'edit_item'         => __( 'Editar idioma' ),
			'update_item'       => __( 'Actualizar idioma' ),
			'add_new_item'      => __( 'Añadir nuevo idioma' ),
			'new_item_name'     => __( 'Nuevo idioma' ),
			'menu_name'         => __( 'Idioma' ),
		);

		$args_idioma = array(
			'hierarchical'      => true,
			'labels'            => $labels_idioma,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'show_in_nav_menus'	=> true,
			'rewrite'           => array( 'slug' => 'idiomas' ),
		);


		
		register_taxonomy( 'autor', array( 'libro' ), $args_autor  );
		register_taxonomy( 'idioma', array( 'libro' ), $args_idioma);

	}
?>