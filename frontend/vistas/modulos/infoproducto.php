<?php

$servidor = Ruta::ctrRutaServidor();
$url = Ruta::ctrRuta();

?>

<!--=====================================
BREADCRUMB INFOPRODUCTOS
======================================-->
<div class="container-fluid well well-sm">
	
	<div class="container">
		
		<div class="row">
			
			<ul class="breadcrumb fondoBreadcrumb text-uppercase">
				
				<li><a href="<?php echo $url;  ?>">INICIO</a></li>
				<li class="active pagActiva"><?php echo $rutas[0] ?></li>

			</ul>

		</div>

	</div>

</div>

<!--=====================================
INFOPRODUCTOS
======================================-->
<div class="container-fluid infoproducto">
	
	<div class="container">
		
		<div class="row">

			<?php

				$item =  "ruta";
				$valor = $rutas[0];
				$infoproducto = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

				$multimedia = json_decode($infoproducto["multimedia"],true);


				/*=============================================
				VISOR DE IMÁGENES
				=============================================*/

				if($infoproducto["tipo"] == "fisico"){

					echo '<div class="col-md-5 col-sm-6 col-xs-12 visorImg">
						
							<figure class="visor">';

							if($multimedia != null){

								for($i = 0; $i < count($multimedia); $i ++){

									echo '<img id="lupa'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'">';

								}								

								echo '</figure>

								<div class="flexslider">
								  
								  <ul class="slides">';

								for($i = 0; $i < count($multimedia); $i ++){

									echo '<li>
								     	<img value="'.($i+1).'" class="img-thumbnail" src="'.$servidor.$multimedia[$i]["foto"].'" alt="'.$infoproducto["titulo"].'">
								    </li>';

								}

							}		
							    						 
							  echo '</ul>

							</div>

						</div>';			

				}else{

					

				}			

			?>

			<!--=====================================
			PRODUCTO
			======================================-->

			<?php

				
					echo '<div class="col-md-7 col-sm-6 col-xs-12">';

			?>

				<!--=====================================
				REGRESAR A LA TIENDA
				======================================-->

				<div class="col-xs-6">
					
					<h6>
						
						<a href="javascript:history.back()" class="text-muted">
							
							<i class="fa fa-reply"></i> Continuar Comprando

						</a>

					</h6>

				</div>

				<!--=====================================
				COMPARTIR EN REDES SOCIALES
				======================================-->

				<div class="col-xs-6">
					
					

				</div>

				<div class="clearfix"></div>

				<!--=====================================
				ESPACIO PARA EL PRODUCTO
				======================================-->

				<?php

					echo '<div class="comprarAhora" style="display:none">


						<button class="btn btn-default backColor quitarItemCarrito" idProducto="'.$infoproducto["id"].'" peso="'.$infoproducto["peso"].'"></button>

						<p class="tituloCarritoCompra text-left">'.$infoproducto["titulo"].'</p>';


						if($infoproducto["oferta"] == 0){

							echo'<input class="cantidadItem" value="1" tipo="'.$infoproducto["tipo"].'" precio="'.$infoproducto["precio"].'" idProducto="'.$infoproducto["id"].'">

							<p class="subTotal'.$infoproducto["id"].' subtotales">
						
								<strong>USD $<span>'.$infoproducto["precio"].'</span></strong>

							</p>

							<div class="sumaSubTotal"><span>'.$infoproducto["precio"].'</span></div>';


						}else{

							echo'<input class="cantidadItem" value="1" tipo="'.$infoproducto["tipo"].'" precio="'.$infoproducto["precioOferta"].'" idProducto="'.$infoproducto["id"].'">

							<p class="subTotal'.$infoproducto["id"].' subtotales">
						
								<strong>USD $<span>'.$infoproducto["precioOferta"].'</span></strong>

							</p>

							<div class="sumaSubTotal"><span>'.$infoproducto["precioOferta"].'</span></div>';


						}

					




					echo '</div>';

					/*=============================================
					TITULO
					=============================================*/				
					
					if($infoproducto["oferta"] == 0){

						$fecha = date('Y-m-d');
						$fechaActual = strtotime('-30 day', strtotime($fecha));
						$fechaNueva = date('Y-m-d', $fechaActual);

						if($fechaNueva > $infoproducto["fecha"]){

							echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'</h1>';

						}else{

							echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

							<br>

							<small>
						
								<span class="label label-warning">Nuevo</span>

							</small>

							</h1>';

						}

					}else{

						$fecha = date('Y-m-d');
						$fechaActual = strtotime('-30 day', strtotime($fecha));
						$fechaNueva = date('Y-m-d', $fechaActual);

						if($fechaNueva > $infoproducto["fecha"]){

							echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

							<br>';

							if($infoproducto["precio"] != 0){

								echo '<small>
							
									<span class="label label-warning">'.$infoproducto["descuentoOferta"].'% off</span>

								</small>';

							}
							
							echo '</h1>';

						}else{

							echo '<h1 class="text-muted text-uppercase">'.$infoproducto["titulo"].'

							<br>';

							if($infoproducto["precio"] != 0){

								echo '<small>
									<span class="label label-warning">Nuevo</span> 
									<span class="label label-warning">'.$infoproducto["descuentoOferta"].'% off</span> 

								</small>';

							}
							
							echo '</h1>';

						}
					}

					/*=============================================
					TITULO
					=============================================*/	

					if($infoproducto["precio"] == 0){

						echo '<h2 class="text-muted">GRATIS</h2>';

					}else{

						if($infoproducto["oferta"] == 0){

							echo '<h2 class="text-muted">USD $'.$infoproducto["precio"].'</h2>';

						}else{

							echo '<h2 class="text-muted">

								<span>
								
									<strong class="oferta">USD $'.$infoproducto["precio"].'</strong>

								</span>

								<span>
									
									$'.$infoproducto["precioOferta"].'

								</span>

							</h2>';

						}

					}

					/*=============================================
					DESCRIPCIÓN
					=============================================*/		

					echo '<p>'.$infoproducto["descripcion"].'</p>';

				?>
				
				<!--=====================================
				CARACTERÍSTICAS DEL PRODUCTO
				======================================-->

				<hr>

				<div class="form-group row">
					
				<?php

					if($infoproducto["detalles"] != null){

						$detalles = json_decode($infoproducto["detalles"], true);

						if($infoproducto["tipo"] == "fisico"){

							if($detalles["Talla"]!=null){

								echo '<div class="col-md-3 col-xs-12">

									<select class="form-control seleccionarDetalle" id="seleccionarTalla">
										
										<option value="">Talla</option>';

										for($i = 0; $i <= count($detalles["Talla"]); $i++){

											echo '<option value="'.$detalles["Talla"][$i].'">'.$detalles["Talla"][$i].'</option>';

										}

									echo '</select>

								</div>';

							}

							if($detalles["Color"]!=null){

								echo '<div class="col-md-3 col-xs-12">

									<select class="form-control seleccionarDetalle" id="seleccionarColor">
										
										<option value="">Color</option>';

										for($i = 0; $i <= count($detalles["Color"]); $i++){

											echo '<option value="'.$detalles["Color"][$i].'">'.$detalles["Color"][$i].'</option>';

										}

									echo '</select>

								</div>';

							}

							if($detalles["Marca"]!=null){

								echo '<div class="col-md-3 col-xs-12">

									<select class="form-control seleccionarDetalle" id="seleccionarMarca">
										
										<option value="">Marca</option>';

										for($i = 0; $i <= count($detalles["Marca"]); $i++){

											echo '<option value="'.$detalles["Marca"][$i].'">'.$detalles["Marca"][$i].'</option>';

										}

									echo '</select>

								</div>';

							}

						}else{

							echo '<div class="col-xs-12">

								<li>
									<i style="margin-right:10px" class="fa fa-play-circle"></i> '.$detalles["Clases"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-clock-o"></i> '.$detalles["Tiempo"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-check-circle"></i> '.$detalles["Nivel"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-info-circle"></i> '.$detalles["Acceso"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-desktop"></i> '.$detalles["Dispositivo"].'
								</li>
								<li>
									<i style="margin-right:10px" class="fa fa-trophy"></i> '.$detalles["Certificado"].'
								</li>

							</div>';

						}

					}

					/*=============================================
					ENTREGA
					=============================================*/

					if($infoproducto["entrega"] == 0){

						if($infoproducto["precio"] == 0){

							echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								<span class="label label-default" style="font-weight:100">

									<i class="fa fa-clock-o" style="margin-right:5px"></i>
									Entrega inmediata | 
									<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventasGratis"].' inscritos |
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas

								</span>

							</h4>

							<h4 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								<small>

									<i class="fa fa-clock-o" style="margin-right:5px"></i>
									Entrega inmediata <br>
									<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventasGratis"].' inscritos <br>
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistasGratis"].'</span> personas

								</small>

							</h4>';

						}else{

							echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								<span class="label label-default" style="font-weight:100">

									<i class="fa fa-clock-o" style="margin-right:5px"></i>
									Entrega inmediata |
									<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventas"].' ventas |
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].' </span> personas

								</span>

							</h4>

							<h4 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								<small>

									<i class="fa fa-clock-o" style="margin-right:5px"></i>
									Entrega inmediata <br> 
									<i class="fa fa-shopping-cart" style="margin:0px 5px"></i>
									'.$infoproducto["ventas"].' ventas <br>
									<i class="fa fa-eye" style="margin:0px 5px"></i>
									Visto por <span class="vistas" tipo="'.$infoproducto["precio"].'">'.$infoproducto["vistas"].'</span> personas

								</small>

							</h4>';

						}

					}else{

						if($infoproducto["precio"] == 0){

							echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								
							</h4>

							<h4 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								

							</h4>';

						}else{

							echo '<h4 class="col-md-12 col-sm-0 col-xs-0">

								<hr>

								
							</h4>

							<h4 class="col-lg-0 col-md-0 col-xs-12">

								<hr>

								

							</h4>';

						}

					}				

				?>

				</div>

				<!--=====================================
				BOTONES DE COMPRA
				======================================-->

				<div class="row botonesCompra">

				<?php


							echo '<div class="col-lg-6 col-md-8 col-xs-12">';

							if($infoproducto["oferta"] != 0){
									
									echo '<button class="btn btn-default btn-block btn-lg backColor agregarCarrito"  idProducto="'.$infoproducto["id"].'" imagen="'.$servidor.$infoproducto["portada"].'" titulo="'.$infoproducto["titulo"].'" precio="'.$infoproducto["precioOferta"].'" tipo="'.$infoproducto["tipo"].'" peso="'.$infoproducto["peso"].'">';

								}else{

									echo '<button class="btn btn-default btn-block btn-lg backColor agregarCarrito"  idProducto="'.$infoproducto["id"].'" imagen="'.$servidor.$infoproducto["portada"].'" titulo="'.$infoproducto["titulo"].'" precio="'.$infoproducto["precio"].'" tipo="'.$infoproducto["tipo"].'" peso="'.$infoproducto["peso"].'">';

								}


									echo 'ADICIONAR AL CARRITO 

									<i class="fa fa-shopping-cart"></i>

									</button>

								</div>';

				?>

				</div>
				
				<!--=====================================
				ZONA DE LUPA
				======================================-->

				<figure class="lupa">
					
					<img src="">

				</figure>

			</div>
			
		</div>
