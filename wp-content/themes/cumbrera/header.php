<?php
// Arrancar buffer de salida
ob_start();

	$args = array(
		'post_type' => 'proyecto',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'name',
		'order' => 'ASC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'proyecto_terminado', // name of custom field
				'value' => "No",
				'compare' => 'LIKE'
			)
		)
	);
	$query = new WP_Query($args);
	
	$menuPry = array();		
	while($query->have_posts()){
		$query->the_post();
		$id = get_the_ID();
		$tipos = get_field('tipo_inmueble', $id);
		foreach($tipos as $tipo){
		if(strtolower($tipo) == "vivienda"){
			$menuPry['vivienda'][] = array('nombre'=>get_the_title(),'link'=>get_permalink($id));
		}elseif(strtolower($tipo) == "comercio y oficinas"){
			$menuPry['comercio'][] = array('nombre'=>get_the_title(),'link'=>get_permalink($id));
		}elseif(strtolower($tipo) == "industria"){
			$menuPry['industria'][] = array('nombre'=>get_the_title(),'link'=>get_permalink($id));
		}
		}
	}
	wp_reset_postdata();
$home_url = get_home_url();
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="ie ie6 no-js" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" lang="en"><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head>
  <meta charset="utf-8">  

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  
  <title><?php if (is_home () ) { echo bloginfo('name'); echo ' | '; bloginfo('description'); }
 elseif ( is_category() ) { single_cat_title(); echo ' | ' ; echo bloginfo('name'); }
 elseif (is_single() || is_page()) { single_post_title(); echo ' | ' ; echo bloginfo('name'); }
 else { wp_title(' | ',true); } ?></title>
  <meta name="title" content="<?php if (is_home () ) { echo bloginfo('name'); echo ' | '; bloginfo('description'); }
 elseif ( is_category() ) { single_cat_title(); echo ' | ' ; echo bloginfo('name'); }
 elseif (is_single() || is_page()) { single_post_title(); echo ' | ' ; echo bloginfo('name'); }
 else { wp_title(' | ',true); } ?>">
  <meta name="description" content="CUMBRERA, diseño, gerencia, construcción y comercialización de proyectos inmobiliarios. Proyectos para la venta en Bogotá, Tenjo, Cajicá, Tocancipá, Pereira y Montería.">  
  <meta name="google-site-verification" content=""> 
  <meta name="Copyright" content="Copyright 2016. All Rights Reserved.">
  <meta name="DC.title" content="">
  <meta name="DC.subject" content="What you're about.">
  <meta name="DC.creator" content=""> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/ico"/>
  <!-- html5.js for IE less than 9 -->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- css3-mediaqueries.js for IE less than 9 -->
  <!--[if lt IE 9]>
  <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->

  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
  <script src="<?php bloginfo('template_url'); ?>/scripts/modernizr-1.7.min.js" type="text/javascript" ></script>
  <!--<script src="http://maps.google.com/maps/api/js?key=AIzaSyDO96nqsJsyEGZ0yQD_-BODenqQhU3TWgQ" type="text/javascript">
  </script>-->
 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52674627-1', 'auto');
  ga('send', 'pageview');

</script>


<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1663864476971135'); // Insert your pixel ID here.
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1663864476971135&ev=PageView&noscript=1"
/></noscript>
<!-- DO NOT MODIFY -->
<!-- End Facebook Pixel Code -->

</head>
<body>
  <!--Inicio loader -->
  <div id="loader"></div>    
  <!--Fin loader -->
	<header class="clearfix">
	  <div class="w-1000">
		<h1 class="left"><a href="<?php echo $home_url; ?>"><img src="<?php bloginfo('template_url'); ?>/images/logo.png" alt="CHROMA STUDIO"></a></h1>
		<a href="javascript:void(0);" class="ico_menu right"></a>
		<nav class="right">
		  <ul>
			<li><a href="<?php echo $home_url; ?>">Inicio</a></li><!--class="active"-->
			<li>
			  <a href="<?php echo $home_url; ?>/proyectos">Proyectos</a>
			  <ul class="sub_nav">
				<li>
					<a href="javascript:void(0);">Vivienda</a>
					<ul class="sub_sub_nav">
						<?php 
							$menu = $menuPry['vivienda'];
							if(count($menu)>0){ 
								foreach($menu as $m){ 
						?>
						<li><a href="<?php echo $m['link']; ?>"><?php echo $m['nombre']; ?></a></li>
						<?php } } ?>
					</ul>
				</li>
				<li><a href="javascript:void(0);">Industria</a>
					<ul class="sub_sub_nav">
						<?php 
							$menu = $menuPry['industria'];
							if(count($menu)>0){
								foreach($menu as $m){ ?>
						<li><a href="<?php echo $m['link']; ?>"><?php echo $m['nombre']; ?></a></li>
						<?php } }?>
					</ul>
				</li>
				<li><a href="javascript:void(0);">Comercio y oficinas</a>
					<ul class="sub_sub_nav">
						<?php 
							$menu = $menuPry['comercio']; 
							if(count($menu)>0){
								foreach($menu as $m){ ?>
						<li><a href="<?php echo $m['link']; ?>"><?php echo $m['nombre']; ?></a></li>
						<?php } }?>
					</ul>
				</li>
				<li><a href="<?php echo $home_url; ?>/realizados">Proyectos realizados</a></li>
			  </ul>
			</li>
			<li>
				<a href="<?php echo $home_url; ?>/sobre-cumbrera">Sobre Cumbrera</a>
				<ul class="sub_nav">
					<li><a href="<?php echo $home_url; ?>/sobre-cumbrera/#quienes">Quiénes somos</a></li>
					<li><a href="<?php echo $home_url; ?>/sobre-cumbrera/#aliados">Nuestros aliados</a></li>
					<li><a href="<?php echo $home_url; ?>/sobre-cumbrera/#certificaciones">Certificaciones</a></li>
					<li><a href="<?php echo $home_url; ?>/sobre-cumbrera/#trabaje">Trabaje con nosotros</a></li>
					<li><a href="<?php echo $home_url; ?>/sobre-cumbrera/#politicas">Políticas de datos</a></li>
				  </ul>
			</li>
			<li><a href="<?php echo $home_url; ?>/preguntas-frecuentes">Preguntas Frecuentes</a></li>
			<li><a href="<?php echo $home_url; ?>/contactenos">Contáctenos</a></li>
		  </ul>
		</nav>
	  </div>
	</header>