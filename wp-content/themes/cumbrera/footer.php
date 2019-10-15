<?php $home_url = get_home_url(); ?>
	<footer>
	  <div class="w-1000 clearfix ">
		<div class="left">
		  <ul class="list_footer">
			<li>
			  <h3><a href="<?php echo $home_url; ?>/proyectos">PROYECTOS</a></h3>
			  <ul>
				<li><a href="<?php echo $home_url; ?>/proyectos/vivienda/" title="Vivienda">Vivienda</a></li>
				<li><a href="<?php echo $home_url; ?>/proyectos/comercio-y-oficinas/" title="Comercio y oficinas">Comercio y oficinas</a></li>
				<li><a href="<?php echo $home_url; ?>/proyectos/industria/" title="Industria">Industria</a></li>				
				<li><a href="<?php echo $home_url; ?>/proyectos/proyectos-realizados/" title="Proyectos realizados">Proyectos realizados</a></li>
			  </ul>
			</li>
			<li>
          <h3><a href="<?php echo $home_url; ?>/sobre-cumbrera">SOBRE CUMBRERA</a></h3>
          <ul>
            <li><a href="<?php echo $home_url; ?>/sobre-cumbrera" title="">Quiénes somos</a></li>
            <li><a href="<?php echo $home_url; ?>/sobre-cumbrera" title="">Nuestros aliados</a></li>
            <li><a href="<?php echo $home_url; ?>/sobre-cumbrera" title="">Certificaciones</a></li>
            <li><a href="<?php echo $home_url; ?>/sobre-cumbrera" title="">Trabaje con nosotros</a></li>
            <li><a href="<?php echo $home_url; ?>/sobre-cumbrera" title="">Pólíticas de datos</a></li>
          </ul>
        </li>
        <li>
          <h3><a href="<?php echo $home_url; ?>/preguntas-frecuentes">PREGUNTAS FRECUENTES</a></h3>
        </li>
        <li>
          <h3><a href="<?php echo $home_url; ?>/contactenos">CONTÁCTENOS</a></h3>
        </li>
		  </ul>
		</div>
		<div class="right social_network">
		  <p class="text-right">Cra 11A # 98 - 50 – Of. 204<br>  Bogotá- Colombia<br>Tel: 742 7202 <br>​​​​​​​<a href="mailto:contacto@cumbrera.com">contacto@cumbrera.com.co</a></p>
		  <!-- <ul>
			<li><a href="javascript:void(0);" class="icon-facebook"></a></li>
			<li><a href="javascript:void(0);" class="icon-tumblr"></a></li>
			<li><a href="javascript:void(0);" class="icon-pinterest"></a></li>
			<li><a href="javascript:void(0);" class="icon-twitter"></a></li>
		  </ul> -->
		</div>
	  </div>
	</footer>
</div>
<?php include('scripts.php'); ?>
</body>
</html>

<?php
flush();
ob_flush();
ob_end_clean();
?>
  