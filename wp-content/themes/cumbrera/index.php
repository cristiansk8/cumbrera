<?php get_header(); 
$home_url = get_home_url(); 
$slides = get_field('slides', 'option');
?>

  <div id="container">     
    <section>
		<div id="slider" class="royalSlider clearfix">
			<?php  foreach($slides as $s){ ?>
			<div class="rsContent pos1" onclick="javascript:location.href='<?php echo $s['link']; ?>'" style="cursor:pointer;">
				<img src="<?php echo $s['imagen']; ?>" class="">
				<?php if($s['descripcion_y_titulo'] == "Si"){ ?>
				<div class="t1">				
					<div class="rsABlock" data-move-effect="left" data-move-offset="500" data-speed="300" data-delay="300">
						<div class="c_slide">						
							<div class="clearfix">
								<h2 class="right"><?php echo $s['titulo'] ?></h2>
							</div>
							<div class="cont_2 clearfix">
								<h4 class="right"><?php echo $s['descripcion']; ?></h4>
							</div>
							<div class="boton">
								<a href="<?php echo $s['link']; ?>" class="tabla">
									<span class="celda">Conozca más</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<?php } //cierre si tiene descripcion y titulo ?>
			</div>
		<?php } ?>
		</div>

		<div class="w-1000">
			<div class="clearfix c_buscador">
				<span class="ico_buscar display_object"></span>
				<div class="display_object">
					<h3 class="antialias">FILTRE SU<br>BÚSQUEDA</h3>
					<p>Seleccione uno o varios filtros para iniciar su búsqueda</p>
				</div>
			</div>
			<div class="clearfix filter st_filter">
				<a href="javascript:void(0);" onclick="Filter('.vivienda');">VIVIENDA</a>
				<a href="javascript:void(0);" onclick="Filter('.industria');">INDUSTRIA</a>
				<a href="javascript:void(0);" onclick="Filter('.comercio');">COMERCIO Y OFICINAS</a>
			</div>
			<div class="res_filter st_filter clearfix vivienda">
				<a href="<?php echo $home_url; ?>/proyectos/vivienda/sobre-planos">SOBRE PLANOS</a>
				<a href="<?php echo $home_url; ?>/proyectos/vivienda/listo-para-estrenar">LISTO PARA ESTRENAR</a>
			</div>
			<div class="res_filter st_filter clearfix comercio">
				<a href="<?php echo $home_url; ?>/proyectos/comercio-y-oficinas/sobre-planos">SOBRE PLANOS</a>
				<a href="<?php echo $home_url; ?>/proyectos/comercio-y-oficinas/listo-para-estrenar">LISTO PARA ESTRENAR</a>
			</div>
			<div class="res_filter st_filter clearfix industria">
				<a href="<?php echo $home_url; ?>/proyectos/industria/sobre-planos">SOBRE PLANOS</a>
				<a href="<?php echo $home_url; ?>/proyectos/industria/listo-para-estrenar">LISTO PARA ESTRENAR</a>
			</div>

			<div class="pro_home clearfix">
				<div class="col-3 left">
				  <h2 class="ult_proy antialias"><span>ÚLTIMOS<br>PROYECTOS</span></h2>
				</div>
				<div class='col-7 left padding-left'>
					<ul class="list_proy">
					<?php  while(has_sub_field('proyectos', 'option')): ?>
					<li>
						<a href="<?php the_sub_field('link'); ?>" class="src_return">
							<img src="<?php the_sub_field('imagen'); ?>" class="return_parent">
							<span>
								<!--<img src="<?php bloginfo('template_url'); ?>/images/img_proy.jpg" height="89" width="87" alt="">-->
							</span>
							<p><?php the_sub_field('descripcion'); ?></p>
							<div class="boton">
								<p class="tabla">
									<span class="celda">Conozca más</span>
								</p>
							</div>
						</a>
					</li>
					<?php  endwhile; ?>
				  </ul>
				</div>
			</div>
		</div>

		<div class="c_info_cumbrera src_return">
			<img src="<?php bloginfo('template_url'); ?>/images/bg2.jpg" class="return_parent">
			<div class="w-1000 clearfix">
				<div class="col-5 right tabla">
					<span class="celda center"><img src="<?php bloginfo('template_url'); ?>/images/logo2.png"></span>
				</div>
				<div class="col-5 tabla text">
					<div class="celda">
						<p><?php echo get_field('sobre_cumbrera_home', 'option'); ?></p>
					</div>
				</div>
			</div>
		</div>

    </section>

    <?php get_footer(); ?>