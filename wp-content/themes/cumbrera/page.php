<?php get_header(); $home_url = get_home_url(); ?>
<div id="container">     
    <section>
<?php
$id_seccion = $post->ID;

//PROYECTOS
if($id_seccion == 124){
//aplican para las otras dos consultas excepto la que tiene viene del post
$estado = strtolower(filter_var(get_query_var( 'e' ), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
$tipo = strtolower(filter_var(get_query_var( 't' ), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));

//si vienen las variables del post
if(!empty($_POST)){
	$estado = strtolower(filter_var($_POST['e'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
	$tipo = strtolower(filter_var($_POST['t'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
	$ciudad = mb_strtolower(filter_var($_POST['c'], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_LOW), 'UTF-8');
	
	$args = array(
		'post_type' => 'ciudad',
		'post_status' => 'publish',
		'posts_per_page' => 1,
		's'	=> $ciudad,
	);
	$query = new WP_Query($args);
	//$tags = array();
	while($query->have_posts()){
		$query->the_post();
		$id_ciudad = get_the_ID();
	}
	wp_reset_postdata();
	
	$args = array(
		'post_type' => 'proyecto',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'name',
		'order' => 'ASC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'estado', // name of custom field
				'value' => $estado,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'tipo_inmueble', // name of custom field
				'value' => $tipo,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'ciudad', // name of custom field
				'value' => $id_ciudad,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'proyecto_terminado', // name of custom field
				'value' => "No",
				'compare' => 'LIKE'
			)
		)
	);
	$query = new WP_Query($args);
	//$tags = array();
	while($query->have_posts()){
		$query->the_post();
		$id = get_the_ID();
		$proyectos[] = array(
			'link'		=>	get_permalink($id),
			'titulo'	=>	get_the_title(),
			'imagen'	=>	get_field('imagen_principal', $id),
			'ciudad'	=>	get_field('ciudad', $id),
			'barrio'	=>	get_field('zona_o_barrio', $id),
			'tipo'		=>	get_field('tipo_inmueble', $id),
			'logo'		=>	get_field('logo_proyecto', $id)
		);	
	}
	wp_reset_postdata();
}elseif(empty($_POST) AND empty($estado)){ //entrando a la seccion proyectos normal
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
	//$tags = array();
	while($query->have_posts()){
		$query->the_post();
		$id = get_the_ID();
		$proyectos[] = array(
			'link'		=>	get_permalink($id),
			'titulo'	=>	get_the_title(),
			'imagen'	=>	get_field('imagen_principal', $id),
			'ciudad'	=>	get_field('ciudad', $id),
			'barrio'	=>	get_field('zona_o_barrio', $id),
			'tipo'		=>	get_field('tipo_inmueble', $id),
			'logo'		=>	get_field('logo_proyecto', $id)
		);	
	}
	wp_reset_postdata();
}else{ //si viene referenciado por el home
	//quitamos los guiones que vienen del link para hacer la consulta
	$estado = str_replace("-", " ", $estado);
	$tipo = str_replace("-", " ", $tipo);
	$args = array(
		'post_type' => 'proyecto',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'name',
		'order' => 'ASC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'estado', // name of custom field
				'value' => $estado,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'tipo_inmueble', // name of custom field
				'value' => $tipo,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'proyecto_terminado', // name of custom field
				'value' => "No",
				'compare' => 'LIKE'
			)
		)
	);
	$query = new WP_Query($args);
	while($query->have_posts()){
		$query->the_post();
		$id = get_the_ID();
		$proyectos[] = array(
			'link'		=>	get_permalink($id),
			'titulo'	=>	get_the_title(),
			'imagen'	=>	get_field('imagen_principal', $id),
			'ciudad'	=>	get_field('ciudad', $id),
			'barrio'	=>	get_field('zona_o_barrio', $id),
			'tipo'		=>	get_field('tipo_inmueble', $id),
			'logo'		=>	get_field('logo_proyecto', $id)
		);	
	}
	wp_reset_postdata();
}
?>
<div class="w-1000">
	<div class="miga antialias">
		<a href="javascript:void(0);">Home</a> / <a href="<?php echo $home_url; ?>/proyectos"><span>Proyectos</span></a>
	</div>
	<h2 class="tit antialias">PROYECTOS</h2>
	<div class="filtrador center">
	<form id="filtrar" method="POST" action="<?php echo $home_url; ?>/proyectos/">
		<select name="t">
			<option <?php if($tipo == "vivienda" OR $tipo == "vivienda"){ echo 'selected'; }?>>VIVIENDA</option>
			<option <?php if($tipo == "industria" OR $tipo == "industria"){ echo 'selected'; }?>>INDUSTRIA</option>
			<option <?php if($tipo == "comercio-y-oficinas" OR $tipo == "comercio y oficinas"){ echo 'selected'; }?>>COMERCIO Y OFICINAS</option>
		</select>
		<select name="e">
			<option <?php if($estado == "sobre-planos" OR $estado == "sobre planos"){ echo 'selected'; }?>>SOBRE PLANOS</option>
			<option <?php if($estado == "listo-para-estrenar" OR $estado == "listo para estrenar"){ echo 'selected'; }?>>LISTO PARA ESTRENAR</option>
		</select>
		<select name="c">
			
			<?php
				$args = array(
					'post_type' => 'ciudad',
					'post_status' => 'publish',
					'posts_per_page' => -1,
					'orderby' => 'name',
					'order' => 'ASC'
				);
				$query = new WP_Query($args);
				echo "<option>CIUDAD</option>";
				while($query->have_posts()){
					$query->the_post();
					$titulo = get_the_title();
					if(!empty($ciudad) AND $ciudad == mb_strtolower($titulo, 'UTF-8')){ $selected = "selected"; }else{ $selected=""; }
					echo '<option '.$selected.'>'.mb_strtoupper($titulo, 'UTF-8').'</option>';	
				}
				wp_reset_postdata();
			?>
		</select>
		<a href="javascript:void(0);" onclick="$('#filtrar').submit();" class="btn">FILTRAR</a>
	</form>
	</div>
	<ul class="list_proyectos reset_list">
		<?php 
			$n = 1;
			$pag = 1;
			if(count($proyectos)>0){
				foreach($proyectos as $p){ 
				$class="pg p$pag";
				if($n % 6 == 0 ){ $pag++;}
		?>
		<li class="<?php echo $class; ?>">
		  <a href="<?php echo $p['link']; ?>" >
			<img src="<?php echo $p['imagen']; ?>" class="img_listado" width="464px" height="257px">
			<img src="<?php echo $p['logo']; ?>" class="pos_logo">
			<h3 class="antialias"><span><?php echo $p['titulo'].'<br>'.$p['ciudad']->post_title.' / '.$p['barrio']->post_title.'<br>'.$p['tipo'][0]; ?></span></h3>
		  </a>
		</li>
		<?php $n++;} }?>
	</ul>
	
	<div class="paginacion clearfix">
		<a href="javascript:anterior();"> < Anterior</a>
		<ul class="reset_list"></ul>
		<a href="javascript:siguiente();">Siguiente ></a>
	</div>
</div>

<?php } //Proyectos 

// PROYECTOS REALIZADOS
if($id_seccion == 387){

//si vienen las variables del post
if(!empty($_POST)){
	$tipo = strtolower(filter_var($_POST['t'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH));
	
	$args = array(
		'post_type' => 'proyecto',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'name',
		'order' => 'ASC',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'tipo_inmueble', // name of custom field
				'value' => $tipo,
				'compare' => 'LIKE'
			),
			array(
				'key' => 'proyecto_terminado', // name of custom field
				'value' => "Si",
				'compare' => 'LIKE'
			)
		)
	);
	$query = new WP_Query($args);
	//$tags = array();
	while($query->have_posts()){
		$query->the_post();
		$id = get_the_ID();
		$proyectos[] = array(
			'titulo'	=>	get_the_title(),
			'imagen'	=>	get_field('imagen_principal', $id),
			'descripcion'	=>	get_field('descripcion', $id),
			'logo'		=>	get_field('logo_proyecto', $id)
		);	
	}
	wp_reset_postdata();
	
}else{ //carga normal de la pagina
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
				'value' => 'Si',
				'compare' => 'LIKE'
			)
		)
	);
	$query = new WP_Query($args);
	//$tags = array();
	while($query->have_posts()){
		$query->the_post();
		$id = get_the_ID();
		$proyectos[] = array(
			'titulo'	=>	get_the_title(),
			'imagen'	=>	get_field('imagen_principal', $id),
			'descripcion'	=>	get_field('descripcion', $id),
			'logo'		=>	get_field('logo_proyecto', $id)
		);	
	}
}
?>
<div class="w-1000">
	<div class="miga antialias">
		<a href="javascript:void(0);">Home</a> / <a href="<?php echo $home_url; ?>/proyectos-realizados"><span>Proyectos terminados</span></a>
	</div>
	<h2 class="tit antialias">PROYECTOS REALIZADOS</h2>
	<div class="filtrador center">
	<form id="filtrar" method="POST" action="<?php echo $home_url; ?>/realizados/">
		<select name="t">
			<option <?php if($tipo == "vivienda" OR $tipo == "vivienda"){ echo 'selected'; }?>>VIVIENDA</option>
			<option <?php if($tipo == "industria" OR $tipo == "industria"){ echo 'selected'; }?>>INDUSTRIA</option>
			<option <?php if($tipo == "comercio-y-oficinas" OR $tipo == "comercio y oficinas"){ echo 'selected'; }?>>COMERCIO Y OFICINAS</option>
		</select>
		<a href="javascript:void(0);" onclick="$('#filtrar').submit();" class="btn">FILTRAR</a>
	</form>
	</div>
	<ul class="list_proyectos reset_list">
		<?php 
			$n = 1;
			$pag = 1;
			if(count($proyectos)>0){
				foreach($proyectos as $p){ 
				$class="pg p$pag";
				if($n % 6 == 0 ){ $pag++;}
		?>
		<li class="<?php echo $class; ?>">
			<a href="javascript:void(0);" style="font-size: 18px;line-height: 18px;cursor:default;">
		  <img src="<?php echo $p['imagen']; ?>" class="img_listado" width="464px" height="257px">
			<img src="<?php echo $p['logo']; ?>" class="pos_logo">
			<h3 class="antialias"><span><?php echo $p['titulo'].'<br>'.$p['descripcion']; ?></span></h3>
			</a>
		</li>
		<?php $n++;} }?>
	</ul>
	
	<div class="paginacion clearfix">
		<a href="javascript:anterior();"> < Anterior</a>
		<ul class="reset_list"></ul>
		<a href="javascript:siguiente();">Siguiente ></a>
	</div>
</div>

<?php } //Proyectos terminados 

//CONTACTACTANOS
if($id_seccion == 118){
$formulario = "contacto";	
require_once("inc/contacto.php");

$arreglo_proyectos = array();
$args = array(
		'post_type' => 'proyecto',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'name',
		'order' => 'ASC',
);
$query = new WP_Query($args);
	//$tags = array();
while($query->have_posts()){
	$query->the_post();
	$id = get_the_ID();
	$arreglo_proyectos[] = array(
		'titulo'	=>	get_the_title(),
	);	
}


	
?>
<div class="w-1000">
	<div class="miga antialias">
		<a href="javascript:void(0);">Home</a> / <a href="<?php echo $home_url; ?>/contactenos"><span>Contáctenos</span></a>
	</div>
</div>
<div class="c_banner_contact src_return">
  <img src="<?php echo get_field('fondo_seccion', 'option'); ?>" class="return_parent">
  <div class="tabla w-1000">
    <div class="celda">
      <h2 class="tit antialias">CONTÁCTENOS</h2>
    </div>
  </div>
</div>
<div class="c_map_contact">
  <div class="text_map">
    <div class="tabla">
      <div class="celda">
        <h3 class="antialias tit">DIRECCIÓN</h3>
        <span>Cra 11A # 98 - 50 – Of. 204 / <br>  Bogotá- Colombia</span>
        <h3 class="antialias tit">TELÉFONO</h3>
        <span>742 7202 </span>
        <h3 class="antialias tit">E-MAIL</h3>
        <span><a href="mailto:Contacto@cumbrera.com.co">contacto@cumbrera.com.co</a></span>
      </div>
    </div>
  </div>
  <div id="map_canvas"></div>
</div>
<div class="form_contact src_return bg_contact">
  <img src="<?php echo get_field('fondo_escribanos', 'option'); ?>" class="return_parent">
  <div class="w-1000">
    <div class="c_form">
      <form id="form_contacto" name="form_contacto" autocomplete="off" method="post" action="<?php echo $home_url; ?>/contactenos/#contacto">
        <h2 class="tit antialias">ESCRÍBANOS</h2>
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
			</div>
			<div class="left in2">
				<label for="">Proyecto:</label>
				<select name="selproy" style="height: 30px; margin-top: 5px; width: 245px; border: 1px solid #6e6f72;
display: block; background: none;">
                    <option value="No aplica">No aplica</option>
					<?php
					for($x=0;$x<count($arreglo_proyectos);$x++){
					?>	
                    <option value="<?php echo $arreglo_proyectos[$x]['titulo']; ?>" ><?php echo $arreglo_proyectos[$x]['titulo']; ?></option>
                	<?php
					}
					?>
                </select>
                <label for="">Asunto:</label>
				<input type="text" name="asunto" value="<?php echo $_POST['asunto']; ?>" required="required">
				<label for="">Mensaje:</label>
				<textarea name="mensaje" required="required"><?php echo $_POST['mensaje']; ?></textarea>
				<input type="submit" value="Enviar" class="btn">
				<!--<a href="javascript:$('#form_contacto').submit();"class="btn">Enviar</a>-->
			</div>
			<div style="color:red;width: 245px;"><?php if(count($errores) > 0){ echo implode(",",$errores); }else{ echo $response_sent;} ?></div>
		</div>
      </form>
    </div>
  </div>
</div>
	
<?php
} //fin contactanos
//SOBRE CUMBRERA
if($id_seccion == 56){
$formulario = "sobreC";	
require_once("inc/contacto.php");
?>

	<div class="w-1000 c_detalle">
		<div class="miga antialias">
			<a href="javascript:void(0);">Home</a> / <a href="<?php echo $home_url; ?>/sobre-cumbrera"><span>Sobre Cumbrera</span></a>
		</div>
	 
	  <div class="c1_detalle clearfix">
		<span class="anchor" id="quienes"></span>
		<div class="right dist_sobre_1">
		  <h3 class="antialias tit">QUIÉNES SOMOS</h3>
		  <p><?php echo get_field('quienes_somos', 'option'); ?></p>
		  <a href="<?php echo $home_url; ?>/contactenos" class="btn">Contáctenos</a>
		</div>
		<div class="left cont_2">
		  <img src="<?php echo get_field('imagen_quienes_somos', 'option'); ?>">
		</div>
	  </div>
	  <div class="c1_detalle clearfix">
		<span class="anchor" id="aliados"></span>
		<div class="left cont_1 box_red">
		  <h3 class="antialias tit">NUESTROS ALIADOS</h3>
		  <p><?php echo get_field('nuestros_aliados', 'option'); ?></p>
		</div>
		<div class="left cont_2">
		  <img src="<?php echo get_field('imagen_nuestros_aliados', 'option'); ?>">
		</div>
	  </div>
	  <div class="c1_detalle clearfix text_certificaciones">
		<span class="anchor" id="certificaciones"></span>
		<h3 class="antialias tit">CERTIFICACIONES</h3>
		<div class="right dist_sobre_1">
		  <p><?php echo get_field('certificaciones', 'option'); ?></p>
		</div>
		<div class="left cont_2">
		  <img src="<?php echo get_field('imagen_certificaciones', 'option'); ?>">
		</div>
	  </div>
	</div>

	<div class="form_contact src_return bg_servicio">
		<span class="anchor" id="trabaje"></span>
		<img src="<?php echo get_field('fondo_contacto', 'option'); ?>" class="return_parent">
		<div class="w-1000">
		  <div class="c_form">
			<form name="form_contacto" autocomplete="off" method="post" action="<?php echo $home_url; ?>/sobre-cumbrera/#trabaje" enctype="multipart/form-data">
			  <h2 class="tit antialias">TRABAJE<br>CON NOSOTROS</h2>
			  <div class="clearfix">
				<div class="left">
					<label for="">Nombre:</label>
					<input type="text" name="nombre" value="<?php echo $_POST['nombre']; ?>" required="required">
					<label for="">Apellido:</label>
					<input type="text"name="apellido" value="<?php echo $_POST['apellido']; ?>" required="required">
					<label for="">E-mail:</label>
					<input type="text" name="email" value="<?php echo $_POST['email']; ?>" required="required">
					<label for="">Teléfono:</label>
					<input type="text" name="telefono" value="<?php echo $_POST['telefono']; ?>" required="required">
				</div>
				<div class="left in2">
				  <label for="">Cargo:</label>
				  <input type="text" name="cargo" value="<?php echo $_POST['cargo']; ?>" required="required">
				  <label for="">Hoja de vida:</label>
				  <input type="file" name="file" value="SUBIR HOJA DE VIDA">
				  <input type="submit" value="Enviar" class="btn">
				</div>
				<div style="color:#fff;width: 245px;"><?php if(count($errores) > 0){ echo implode(",",$errores); }else{ echo $response_sent;} ?></div>
			  </div>
			</form>
		  </div>
		</div>
	</div>

	<div class="w-1000">
		<span class="anchor" id="politicas"></span>
		<h3 class="antialias tit">POLÍTICAS<br>DE DATOS</h3>
		<div class="c1_detalle clearfix">
		  <div class="right cont_1 box_red">
			<div class="tabla">
			  <div class="celda center">
				<a href="<?php echo get_field('politicas_de_cambios', 'option'); ?>" class="text_descargar" download>Descargar<br>documento</a>
			  </div>
			</div>
		  </div>
		  <div class="left cont_2">
			<img src="<?php echo get_field('imagen_politicas_de_cambios', 'option'); ?>">
		  </div>
		</div>
	</div>
  
<?php } 
//PREGUNTAS FRECUENTES
if($id_seccion == 116){
$args = array(
		'post_type' => 'pregunta',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_key' => 'orden',
		'orderby' => 'meta_value_num',
		'order'	=> 'ASC'
	);
	$query = new WP_Query($args);
	while($query->have_posts()){
		$query->the_post();
		$id = get_the_ID();
		$preguntas[] = array(
			'pregunta'	=>	get_the_title(),
			'respuesta'	=>	get_field('respuesta', $id),
		);	
	}
	wp_reset_postdata();
?>

<div class="w-1000">
	<div class="miga antialias">
		<a href="javascript:void(0);">Home</a> / <a href="<?php echo $home_url; ?>/preguntas-frecuentes"><span>Preguntas frecuentes</span></a>
	</div>
</div>
<div class="servicio">
  <div class="w-1000">
	
	<div class="c1_detalle clearfix">
      <div class="right dist_sobre_1">
        <h3 class="antialias tit">PREGUNTAS<br> FRECUENTES</h3>
      </div>
      <div class="left cont_2">
        <img src="<?php bloginfo('template_url'); ?>/images/preguntas_frecuentes.jpg">
      </div>
    </div>	    
    <div class="acordeon">
      <ul class="reset_list">
		<?php $n = 1; foreach($preguntas as $p){ 
		?>
        <li>
          <h5><a href="javascript:void(0);"><?php echo $n.'. '.$p['pregunta']; ?></a></h5>
          <div>
            <?php echo $p['respuesta']; ?>
          </div>
        </li>
        <?php $n++; } ?>
      </ul>
    </div>
  </div>
</div>
<?php } ?>

</section>
<?php get_footer(); ?>
</div>
<?php //Esto solo aplica para el buscador de proyectos y proyectos realizados
if($id_seccion == 124 OR $id_seccion == 387){
?>
<script type="text/javascript">
$(document).ready(function(){
	paginas = Math.ceil($('.list_proyectos li').length / 6);
	pgActual = 1;
	paginador(paginas);
	pagina(1);
	if(Math.ceil($('.list_proyectos li').length < 6)){$('.paginacion').css('display','none');}
});
	function paginador(paginas){
		for(n=1; n <= paginas; n = n+1){
			$('.paginacion ul').append('<li><a href="javascript:pagina('+n+');">'+n+'</a></li>');
		}
	}
	function pagina(n){
		$('.pg').fadeOut('fast');
		$('.p'+n).fadeIn('fast');
	}
	function siguiente(){
		if(pgActual < paginas){
			pgActual = pgActual + 1;
		}
		pagina(pgActual);
	}
	function anterior(){
		if(pgActual > 1){
			pgActual = pgActual -1;
		}
		pagina(pgActual);
	}
</script>

<?php 
}
//Esto solo aplica para el contacto
if($post->ID == 118){

?>
<script>
	$(window).bind("load resize", function() {
		
	  	try {
		    var miMapa = ClassMap("map_canvas");
		    agregarMarkerVentana("map_canvas", 4.6818672, -74.0445137, 'CUMBRERA', '<?php bloginfo('template_url'); ?>/images/marker.png', 'CUMBRERA');
		    irLatLng("map_canvas", 4.6818672, -74.0445137);
		   }
		   catch(err) { }
		 	
	  });	  
</script>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyDO96nqsJsyEGZ0yQD_-BODenqQhU3TWgQ" type="text/javascript"></script>
<?php } ?>