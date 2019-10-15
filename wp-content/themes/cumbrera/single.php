<?php get_header(); $home_url = get_home_url(); ?>
<div id="container">     
    <section>
<?php
$post_type = get_post_type();
$id = get_the_ID();

//DETALLE PROYECTO
if($post_type == 'proyecto'){

//----- ENVIO CONTACTO ---- 
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$formulario = "proyecto";
	$emails = get_field('e-mail_sala_de_ventas');
	require_once("inc/contacto.php");
}
//----- ENVIO CONTACTO ---- 
$link = get_permalink();
$nombre = $post->post_title;
$fotos = get_field('fotos_del_proyecto');
$areas = get_field('areas_del_proyecto');
$ubicacion = get_field('ubicacion');
$estado = get_field('estado');
$ciudad = get_field('ciudad');
$relacionados = get_field('proyectos_relacionados');
?>
<div class="w-1000 c_detalle">
	<div class="miga antialias">
		<a href="javascript:void(0);">Home</a> / <a href="<?php echo $home_url; ?>/proyectos"><span>Proyectos</span></a> / <a href="<?php echo $$link; ?>"><span><?php echo $nombre; ?></span></a>
	</div>
  <div class="c_slide_principal">
    <img src="<?php echo get_field('logo_proyecto'); ?>" class="logo_landing">
    <div id="owl-detalle" class="owl-carousel owl-theme">
			<div class="item"><img src="<?php echo get_field('imagen_principal'); ?>" class="bg"></div>
		<?php if(count($fotos)>0){
			foreach($fotos as $f){ ?>
			<div class="item"><img src="<?php echo $f['imagen']; ?>" class="bg"></div>
		<?php }} ?>
    </div>
  </div>
  <div class="c1_detalle clearfix">
    <div class="left cont_1">
      <h3 class="antialias tit"><?php echo get_field('slogan'); ?></h3>
      <?php echo get_field('descripcion');?>
    </div>
    <div class="left cont_2">
      <img src="<?php echo get_field('imagen_descripcion'); ?>">
    </div>
  </div>
</div>

<div class="ventajas">
  <div class="w-1000">
    <h3 class="tit antialias">VENTAJAS</h3>
    <ul class="reset_list center">
      <li>
        <img src="<?php bloginfo('template_url'); ?>/images/i1.png" alt="">
        <h4>UBICACIÓN</h4>
        <?php echo get_field('descripcion_ubicacion'); ?>
      </li>
      <li>
        <img src="<?php bloginfo('template_url'); ?>/images/i2.png" alt="">
        <h4>ZONAS COMUNES</h4>
        <?php echo get_field('descripcion_zonas_comunes'); ?>
      </li>
      <li>
        <img src="<?php bloginfo('template_url'); ?>/images/i3.png" alt="">
        <h4>BENEFICIOS</h4>
        <?php echo get_field('descripcion_beneficios'); ?>
      </li>
    </ul>
  </div>
</div>
<?php if(!empty($areas)>0){?>
<div class="w-1000">
  <div class="c_medidas center">
    <div id="owl-medidas" class="owl-carousel">
      <?php foreach($areas as $a){ ?>
        <div class="item"><span><?php echo $a['descripcion_boton']; ?></span></div>
      <?php } ?>
    </div>
  </div>
  <div class="planos">
    <div id="owl-planos" class="owl-carousel">
		<?php foreach($areas as $a){ ?>
        <div class="item clearfix">
          <a href="<?php echo $a['imagen']; ?>" class="zoom_img swipebox" title="<?php echo $a['nombre']; ?>">
            <img src="<?php echo $a['imagen']; ?>" alt=""> <span><img src="<?php bloginfo('template_url'); ?>/images/ico_zoom.png" alt=""></span>
          </a>
        </div>
        <?php } ?>
    </div>
  </div>
</div>
<?php } ?>
<div class="mapa">
	<div id="map_canvas"></div>
	<div class="form">
		<div class="c_form">
		  <form action="<?php echo $link; ?>/#contacto" method="POST" id="form_contacto">
            <input type="hidden" name="selproy" value="<?php echo $nombre; ?>" />
			<h2 class="tit antialias">CONTÁCTENOS</h2>
			<div class="clearfix">
			<span class="anchor" id="contacto"></span>
			  <div class="left">
				<label for="">Nombre:</label>
				<input type="text" name="nombre" value="<?php echo $_POST['nombre']; ?>" required="required">
				<label for="">Apellido:</label>
				<input type="text"name="apellido" value="<?php echo $_POST['apellido']; ?>" required="required">
				<label for="">E-mail:</label>
				<input type="text" name="email" value="<?php echo $_POST['email']; ?>" required="required">
				<label for="">Teléfono:</label>
				<input type="text" name="telefono" value="<?php echo $_POST['telefono']; ?>" required="required">
				<div style="color:red;width: 245px;"><?php if(count($errores) > 0){ echo implode(",",$errores); }else{ echo $response_sent;} ?></div>
			</div>
			<div class="left in2">
				<label for="">Asunto:</label>
				<input type="text" name="asunto" value="<?php echo $_POST['asunto']; ?>" required="required">
				<label for="">Mensaje:</label>
				<textarea name="mensaje" required="required"><?php echo $_POST['mensaje']; ?></textarea>
				<input type="submit" value="Enviar" class="btn">
				<!--<a href="javascript:$('#form_contacto').submit();"class="btn">Enviar</a>-->
			</div>
			</div>
		  </form>
		</div>
	</div>
	<div class="miMail"></div>
	<div class="compartir">
		<div class="compartir_c">
			<a href="http://www.facebook.com/share.php?u=<?php echo "$link&title=$nombre"; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/facebook.png"></a>
			<a href="http://twitter.com/home?status=<?php echo "$nombre+$link"; ?>" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/twitter.png"></a>
		</div>
	</div>  
</div>

<ul class="reset_list links_detalle center">
  <li><a href="javascript:void(0);" class="btn" onclick="Contacto();">CONTÁCTENOS</a></li>
  <!--<li><a href="javascript:void(0);" class="btn" onclick="miMail();">ENVIAR A MI EMAIL</a></li>-->
  <li><a href="javascript:void(0);" class="btn" onclick="compartir();">COMPARTIR EN REDES</a></li>
</ul>
<?php 
if(!empty($relacionados)>0){ ?>
<div class="w-1000 relacionados">
  <h2 class="tit antialias">PROYECTOS <br> RELACIONADOS</h2>
  <ul class="list_proyectos reset_list">
    <?php
	foreach($relacionados as $r){
			$ciudad = get_field('ciudad', $r);
			$barrio = get_field('zona_o_barrio', $r);
			$tipo = get_field('tipo_inmueble', $r);
	?>
    <li>
      <a href="<?php echo get_permalink($r); ?>" >
        <img src="<?php echo get_field('imagen_principal', $r); ?>" class="img_listado">
        <img src="<?php echo get_field('logo_proyecto', $r); ?>" class="pos_logo">
        <h3 class="antialias"><span><?php echo get_the_title($r).'<br>'.$ciudad->post_title.' / '.$barrio->post_title.' <br>'.$tipo[0]; ?></span></h3>
      </a>
    </li>
    <?php }	?>
  </ul>
</div>
<?php } 

}

//LANDING
if($post_type ==  "landing"){

$id_proyecto = get_field('proyecto', $id);
$ciudad = get_field('ciudad',$id_proyecto[0]);
$barrio = get_field('zona_o_barrio',$id_proyecto[0]);
?>
<div class="w-1000">
	<div class="landing">
		<div>
			<div class="text">
				<div class="tabla">
				  <div class="celda">
					<h2 class="antialias"><?php echo get_field('slogan', $id_proyecto[0]).'<br><br>'.$ciudad->post_title.' / '.$barrio->post_title; ?></h2>
					<a href="<?php echo get_permalink($id_proyecto[0]); ?>" class="btn">Conoce más</a>
				  </div>
				</div>
			</div>
			<img src="<?php echo get_field('logo_proyecto',$id_proyecto[0]); ?>" class="logo_landing">
			<img src="<?php echo get_field('imagen_principal',$id_proyecto[0]); ?>" class="bg">
		</div>
	</div>
</div>
<?php } //Landing ?>

</section>
<?php get_footer(); 

if($post_type == 'proyecto'){ //el googlemaps solo va en el detalle del proyecto
?>
<script>
<?php if(!empty($_POST)){ ?>
$(document).ready(function(){ Contacto(); });
<?php } ?>
	$(window).bind("load resize", function() {
	  	try {
		    var miMapa = ClassMap("map_canvas");
		    agregarMarkerVentana("map_canvas", <?php echo $ubicacion['lat'].', '.$ubicacion['lng']; ?>, 'CUMBRERA', '<?php bloginfo('template_url'); ?>/images/marker.png', 'CUMBRERA');
		    irLatLng("map_canvas", <?php echo $ubicacion['lat'].', '.$ubicacion['lng']; ?>);
		}
		catch(err) { }
	});	  
	</script>
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyDO96nqsJsyEGZ0yQD_-BODenqQhU3TWgQ" type="text/javascript"></script>
<?php } ?>
</div>