<!--=====================================
VALIDAR SESIÓN
======================================-->

<?php

$url = Ruta::ctrRuta();
$servidor = Ruta::ctrRutaServidor();

if(!isset($_SESSION["validarSesion"])){

	echo '<script>
	
		window.location = "'.$url.'";

	</script>';

	exit();

}

?>

<!--=====================================
BREADCRUMB PERFIL
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
SECCIÓN PERFIL
======================================-->

<div class="container-fluid">

	<div class="container">

		<ul class="nav nav-tabs">
		  
	  	

	  		<li> 				
		  		<a data-toggle="tab" href="#deseos">
		  		<i class="fa fa-gift"></i> MI LISTA DE DESEOS</a>
	  		</li>

	  		<li>				
	  			<a data-toggle="tab" href="#perfil">
	  			<i class="fa fa-user"></i> EDITAR PERFIL</a>
	  		</li>

	  		
		</ul>

		<div class="tab-content">

			<!--=====================================
			PESTAÑA COMPRAS
			======================================-->

	  	
		  	<!--=====================================
			PESTAÑA DESEOS
			======================================-->

		  	<div id="deseos" class="tab-pane fade">
		    	
			<?php

				$item = $_SESSION["id"];

				$deseos = ControladorUsuarios::ctrMostrarDeseos($item);

				if(!$deseos){

					echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center error404">
				               
			    		<h1><small>¡Oops!</small></h1>
			    
			    		<h2>Aún no tiene productos en su lista de deseos</h2>

			  		</div>';
				
				}else{

					foreach ($deseos as $key => $value1) {

						$ordenar = "id";
						$valor = $value1["id_producto"];
						$item = "id";

						$productos = ControladorProductos::ctrListarProductos($ordenar, $item, $valor);

						echo '<ul class="grid0">';

							foreach ($productos as $key => $value2) {
							
							echo '<li class="col-md-3 col-sm-6 col-xs-12">

									<figure>
										
										<a href="'.$url.$value2["ruta"].'" class="pixelProducto">
											
											<img src="'.$servidor.$value2["portada"].'" class="img-responsive">

										</a>

									</figure>

									<h4>
							
										<small>
											
											<a href="'.$url.$value2["ruta"].'" class="pixelProducto">
												
												'.$value2["titulo"].'<br>

												<span style="color:rgba(0,0,0,0)">-</span>';

										/*		if($value2["nuevo"] != 0){

													echo '<span class="label label-warning fontSize">Nuevo</span> ';

												}

												if($value2["oferta"] != 0){

													echo '<span class="label label-warning fontSize">'.$value2["descuentoOferta"].'% off</span>';

												} */

											echo '</a>	

										</small>			

									</h4>

									<div class="col-xs-6 precio">';

									if($value2["precio"] == 0){

										echo '<h2 style="margin-top:-10px"><small>GRATIS</small></h2>';

									}else{

										if($value2["oferta"] != 0){

											echo '<h2 style="margin-top:-10px">

													<small>
								
														<strong class="oferta" style="font-size:12px">USD $'.$value2["precio"].'</strong>

													</small>

													<small>$'.$value2["precioOferta"].'</small>
												
												</h2>';

										}else{

											echo '<h2 style="margin-top:-10px"><small>USD $'.$value2["precio"].'</small></h2>';

										}
										
									}
													
									echo '</div>

									<div class="col-xs-6 enlaces">
										
										<div class="btn-group pull-right">
											
											<button type="button" class="btn btn-danger btn-xs quitarDeseo" idDeseo="'.$value1["id"].'" data-toggle="tooltip" title="Quitar de mi lista de deseos">
												
												<i class="fa fa-heart" aria-hidden="true"></i>

											</button>';

											if($value2["tipo"] == "virtual" && $value2["precio"] != 0){

												if($value2["oferta"] != 0){

													echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value2["id"].'" imagen="'.$servidor.$value2["portada"].'" titulo="'.$value2["titulo"].'" precio="'.$value2["precioOferta"].'" tipo="'.$value2["tipo"].'" peso="'.$value2["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

													<i class="fa fa-shopping-cart" aria-hidden="true"></i>

													</button>';

												}else{

													echo '<button type="button" class="btn btn-default btn-xs agregarCarrito"  idProducto="'.$value2["id"].'" imagen="'.$servidor.$value2["portada"].'" titulo="'.$value2["titulo"].'" precio="'.$value2["precio"].'" tipo="'.$value2["tipo"].'" peso="'.$value2["peso"].'" data-toggle="tooltip" title="Agregar al carrito de compras">

													<i class="fa fa-shopping-cart" aria-hidden="true"></i>

													</button>';

												}

											}

											echo '<a href="'.$url.$value2["ruta"].'" class="pixelProducto">
											
												<button type="button" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ver producto">
													
													<i class="fa fa-eye" aria-hidden="true"></i>

												</button>	
											
											</a>

										</div>

									</div>

								</li>';
							}

						echo '</ul>';


					}

				}

			?>


		  	</div>

			<!--=====================================
			PESTAÑA PERFIL
			======================================-->
		  	
		  	<div id="perfil" class="tab-pane fade">
		    	
				<div class="row">
					
					<form method="post" enctype="multipart/form-data">
					
						<div class="col-md-3 col-sm-4 col-xs-12 text-center">
							
							<br>

							<figure id="imgPerfil">
								
							<?php

							echo '<input type="hidden" value="'.$_SESSION["id"].'" id="idUsuario" name="idUsuario">
							      <input type="hidden" value="'.$_SESSION["password"].'" name="passUsuario">
							      <input type="hidden" value="'.$_SESSION["foto"].'" name="fotoUsuario" id="fotoUsuario">
							      <input type="hidden" value="'.$_SESSION["modo"].'" name="modoUsuario" id="modoUsuario">';


							if($_SESSION["modo"] == "directo"){

								if($_SESSION["foto"] != ""){

									echo '<img src="'.$url.$_SESSION["foto"].'" class="img-thumbnail">';

								}else{

									echo '<img src="'.$servidor.'vistas/img/usuarios/default/anonymous.png" class="img-thumbnail">';

								}
					

							}else{

								echo '<img src="'.$_SESSION["foto"].'" class="img-thumbnail">';
							}		

							?>

							</figure>

							<br>

							<?php

							if($_SESSION["modo"] == "directo"){
							
							

							}

							?>

							<div id="subirImagen">
								
								<input type="file" class="form-control" id="datosImagen" name="datosImagen">

								<img class="previsualizar">

							</div>

						</div>	

						<div class="col-md-9 col-sm-8 col-xs-12">

						<br>
							
						<?php

						if($_SESSION["modo"] != "directo"){

							echo '<label class="control-label text-muted text-uppercase">Nombre:</label>
									
									<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input type="text" class="form-control"  value="'.$_SESSION["nombre"].'" readonly>

									</div>

									<br>

									<label class="control-label text-muted text-uppercase">Correo electrónico:</label>
									
									<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input type="text" class="form-control"  value="'.$_SESSION["email"].'" readonly>

									</div>

									<br>

									<label class="control-label text-muted text-uppercase">Modo de registro en el sistema:</label>
									
									<div class="input-group">
								
										<span class="input-group-addon"><i class="fa fa-'.$_SESSION["modo"].'"></i></span>
										<input type="text" class="form-control text-uppercase"  value="'.$_SESSION["modo"].'" readonly>

									</div>

									<br>';
		

						}else{

							echo '<label class="control-label text-muted text-uppercase" for="editarNombre">Cambiar Nombre:</label>
									
									<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input type="text" class="form-control" id="editarNombre" name="editarNombre" value="'.$_SESSION["nombre"].'">

									</div>

								<br>

								<label class="control-label text-muted text-uppercase" for="editarEmail">Cambiar Correo Electrónico:</label>

								<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
										<input type="text" class="form-control" id="editarEmail" name="editarEmail" value="'.$_SESSION["email"].'">

									</div>

								<br>

								<label class="control-label text-muted text-uppercase" for="editarPassword">Cambiar Contraseña:</label>

								<div class="input-group">
								
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										<input type="text" class="form-control" id="editarPassword" name="editarPassword" placeholder="Escribe la nueva contraseña">

									</div>

								<br>

								<button type="submit" class="btn btn-default backColor btn-md pull-left">Actualizar Datos</button>';

						}

						?>

						</div>

						<?php

							$actualizarPerfil = new ControladorUsuarios();
							$actualizarPerfil->ctrActualizarPerfil();

						?>					

					</form>

					<button class="btn btn-danger btn-md pull-right" id="eliminarUsuario">Eliminar cuenta</button>

					<?php

							$borrarUsuario = new ControladorUsuarios();
							$borrarUsuario->ctrEliminarUsuario();

						?>	

				</div>

		  	</div>

		</div>

	</div>

</div>

