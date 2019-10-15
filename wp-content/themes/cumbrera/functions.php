<?php
//================================================
//		PROTOTYPE.com.co
//================================================

/*
Posiciones para el menu de admin
2-dashboard
4-separator
5-posts
10-media
15-links
20-pages
25-comments
59-separator
60-apperance
65-plugins
70-users
75-tools
80-settings
99-separator
*/

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => false,
    'prev_text'       => __('Anterior'),
    'next_text'       => __('Siguiente'),
    'type'            => 'array',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
	//echo '<a href="'.get_previous_posts_link().'" class="atras paginador">Anterior</a>';
	//echo '<a href="'.get_next_posts_link().'" class="siguiente paginador">Siguiente</a>';
    echo "<ul class='paginador_list'>";
	foreach($paginate_links as $link){
      echo "<li>$link</li>";
	}
    echo "</ul>";
  }
  //print_r($paginate_links);

}

$wp->add_query_var( 'e' );
$wp->add_query_var( 't' );
add_action( 'init', 'wpse12065_init' );
function wpse12065_init()
{
    add_rewrite_rule(
        'proyectos(/([^/]+))?(/([^/]+))?/?',
        'index.php?pagename=proyectos&t=$matches[2]&e=$matches[4]',
        'top'
    );
}
/*
$wp->add_query_var( 'l' );
add_action( 'init', 'wpse12066_init' );
function wpse12066_init()
{
    add_rewrite_rule(
        'landing(/([^/]+))?/?',
        'index.php?pagename=landing&l=$matches[2]',
        'top'
    );
}
*/

function my_acf_google_map_api( $api ){	
	$api['key'] = 'AIzaSyDO96nqsJsyEGZ0yQD_-BODenqQhU3TWgQ';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

//================================================
//		Pagina de administracion secciones
//================================================

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Configuraci&oacute;n Secciones',
		'menu_title'	=> 'Configuraci&oacute;n Secciones',
		'menu_slug' 	=> 'Home',
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-editor-ul',
		'position'		=> '25',
		'redirect'		=> false
	));
}
//================================================
//		Formulario pregutnas frecuentes
//================================================

function faq_post_type(){
	//arreglo de etiquetas (labels, nombres)
	$labels = array(
		'name' => 'Preguntas frecuentes',
		'singular_name' => 'Pregunta',
		'add_new' => 'Agregar pregunta',
		'all_items' => 'Todas las preguntas',
		'add_new_item' => 'Agregar pregunta',
		'edit_item' => 'Editar pregunta',
		'new_item' => 'Nuevo pregunta',
		'view_item' => 'Previsualizar pregunta',
		'search_item' => 'Buscar pregunta',
		'not_found' => 'No se encontraron preguntas',
		'not_found_in_trash' => 'No se encontraron preguntas en la papelera',
		'parent_item_colon' => 'Parent item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title'),
		'menu_icon' => 'dashicons-editor-ul',
		'exclude_from_search' => true
	);
	register_post_type('Pregunta',$args);
}

add_action('init', 'faq_post_type');
//================================================
//		Formulario proyectos
//================================================

function proyectos_post_type(){
	//arreglo de etiquetas (labels, nombres)
	$labels = array(
		'name' => 'Proyectos',
		'singular_name' => 'Proyecto',
		'add_new' => 'Agregar proyecto',
		'all_items' => 'Todos los proyectos',
		'add_new_item' => 'Agregar proyecto',
		'edit_item' => 'Editar proyecto',
		'new_item' => 'Nuevo proyecto',
		'view_item' => 'Previsualizar proyecto',
		'search_item' => 'Buscar proyecto',
		'not_found' => 'No se encontraron proyectos',
		'not_found_in_trash' => 'No se encontraron proyectos en la papelera',
		'parent_item_colon' => 'Parent item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title'),
		'menu_icon' => 'dashicons-editor-ul',
		'exclude_from_search' => true
	);
	register_post_type('Proyecto',$args);
}

add_action('init', 'proyectos_post_type');
//================================================
//		Formulario barrios
//================================================

function barrios_inm_post_type(){
	//arreglo de etiquetas (labels, nombres)
	$labels = array(
		'name' => 'Barrios',
		'singular_name' => 'Barrio',
		'add_new' => 'Agregar Barrio',
		'all_items' => 'Todos los barrios',
		'add_new_item' => 'Agregar barrio',
		'edit_item' => 'Editar barrio',
		'new_item' => 'Nuevo barrio',
		'view_item' => 'Previsualizar barrio',
		'search_item' => 'Buscar barrio',
		'not_found' => 'No se encontraron barrios',
		'not_found_in_trash' => 'No se encontraron barrios en la papelera',
		'parent_item_colon' => 'Parent item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title'),
		'menu_icon' => 'dashicons-editor-ul',
		'exclude_from_search' => true
	);
	register_post_type('Barrio',$args);
}

add_action('init', 'barrios_inm_post_type');
//================================================
//		Formulario landing
//================================================

function landing_post_type(){
	//arreglo de etiquetas (labels, nombres)
	$labels = array(
		'name' => 'Landing proyecto',
		'singular_name' => 'Landing',
		'add_new' => 'Agregar landing',
		'all_items' => 'Todos los landings',
		'add_new_item' => 'Agregar landing',
		'edit_item' => 'Editar landing',
		'new_item' => 'Nueva landing',
		'view_item' => 'Previsualizar landing',
		'search_item' => 'Buscar landing',
		'not_found' => 'No se encontraron landings',
		'not_found_in_trash' => 'No se encontraron landings en la papelera',
		'parent_item_colon' => 'Parent item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title'),
		'menu_icon' => 'dashicons-editor-ul',
		'exclude_from_search' => true
	);
	register_post_type('Landing',$args);
}

add_action('init', 'landing_post_type');
/*
//================================================
//		Formulario caracteristicas del inmueble
//================================================

function caracteristicas_inm_post_type(){
	//arreglo de etiquetas (labels, nombres)
	$labels = array(
		'name' => 'Caracteristicas Inmuebles',
		'singular_name' => 'Caracteristica',
		'add_new' => 'Agregar caracteristica',
		'all_items' => 'Todas las caracteristicas',
		'add_new_item' => 'Agregar caracteristica',
		'edit_item' => 'Editar caracteristica',
		'new_item' => 'Nueva caracteristica',
		'view_item' => 'Previsualizar caracteristica',
		'search_item' => 'Buscar caracteristica',
		'not_found' => 'No se encontraron caracteristicas',
		'not_found_in_trash' => 'No se encontraron caracteristicas en la papelera',
		'parent_item_colon' => 'Parent item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title'),
		'menu_icon' => 'dashicons-editor-ul',
		'exclude_from_search' => true
	);
	register_post_type('Caracteristica',$args);
}

add_action('init', 'caracteristicas_inm_post_type');
*/
//================================================
//		Formulario Ciudades
//================================================

function ciudades_post_type(){
	//arreglo de etiquetas (labels, nombres)
	$labels = array(
		'name' => 'Ciudades',
		'singular_name' => 'Ciudad',
		'add_new' => 'Agregar ciudad',
		'all_items' => 'Todas las ciudades',
		'add_new_item' => 'Agregar ciudad',
		'edit_item' => 'Editar ciudad',
		'new_item' => 'Nuevo ciudad',
		'view_item' => 'Previsualizar ciudad',
		'search_item' => 'Buscar ciudad',
		'not_found' => 'No se encontraron ciudades',
		'not_found_in_trash' => 'No se encontraron ciudades en la papelera',
		'parent_item_colon' => 'Parent item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title'),
		'menu_icon' => 'dashicons-editor-ul',
		'exclude_from_search' => true
	);
	register_post_type('Ciudad',$args);
}

add_action('init', 'ciudades_post_type');