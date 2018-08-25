<?php 

add_action('init', 'register_custom_types');

function register_custom_types() {
	//Libros
	$labels_libro = array(
		'name' => _x('Libros', 'post type general name'),
		'singular_name' => _x('Libro', 'post type singular name'),
		'all_items' => __('Todos los Libros'),
		'add_new' => _x('Añadir nuevo', 'libro'),
		'add_new_item' => __('Añadir nuevo libro'),
		'edit_item' => __('Editar libro'),
		'new_item' => __('Nuevo libro'),
		'view_item' => __('Ver libro'),
		'search_items' => __('Buscar libro'),
		'not_found' =>  __('No se ha encontrado nada'),
		'not_found_in_trash' => __('No se ha encontrado nada en la papelera'),
		'parent_item_colon' => ''
	);
	
	$args_libro = array(
		'labels'             => $labels_libro,
		'description'        => 'Libros',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'menu_icon'          => null,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,	
		//'taxonomies' 		 => array('category'),
		'rewrite'            => array( 'slug' => 'libros'), 
		'supports'           => array('title','thumbnail','editor', 'custom-fields','author','revisions'),
		'has_archive'        => true
	  ); 	


	//Pedidos
	$labels_pedidos = array(
		'name' => _x('Pedidos', 'post type general name'),
		'singular_name' => _x('Pedido', 'post type singular name'),
		'all_items' => __('Todas las Pedidos'),
		'add_new' => _x('Añadir nueva', 'cotizacion'),
		'add_new_item' => __('Añadir nuevo pedido'),
		'edit_item' => __('Editar pedido'),
		'new_item' => __('Nuevo pedido'),
		'view_item' => __('Ver pedido'),
		'search_items' => __('Buscar pedido'),
		'not_found' =>  __('No se ha encontrado nada'),
		'not_found_in_trash' => __('No se ha encontrado nada en la papelera'),
		'parent_item_colon' => ''
	);

	$args_pedidos = array(
		'labels'             => $labels_pedidos,
		'description'        => 'Pedidos',
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'query_var'          => true,
		'menu_icon'          => null,
		'capability_type'    => 'post',
		'hierarchical'       => false,
		'menu_position'      => null,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => true,	
		'rewrite'            => array( 'slug' => 'pedidos'), 
		'supports'           => array('title','editor','thumbnail', 'custom-fields'),
		'has_archive'        => true
	  ); 	

	register_post_type( 'libro' , $args_libro );	
	register_post_type( 'pedido' , $args_pedidos );
}

?>