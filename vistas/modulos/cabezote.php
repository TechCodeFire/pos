 <header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo bg-navy">
		 
		<!-- logo mini -->
		<span class="logo-mini bg-navy">
			
			<img src="vistas/img/plantilla/logouno.png" class="img-responsive" style="padding:0px; background-color:aliceblue; border-radius:100%; "> 

		</span>

		<!-- logo normal -->

		<span class="logo-lg bg-navy" >
			
			<img src="vistas/img/plantilla/fondodos.png" class="img-responsive" style="padding:1px 0px" width="100px" height="30px">

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top bg-navy" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu bg-navy">
				
			<ul class="nav navbar-nav ">
				
				<li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

					<?php

					if($_SESSION["foto"] != ""){

						echo '<img src="'.$_SESSION["foto"].'" class="user-image">';

					}else{


						echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';

					}


					?>
						
						<span class="hidden-xs" style="color: white;"><?php  echo $_SESSION["nombre"]; ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu bg-navy" style="width: 200px; height:67px">
						
						<li class="user-body">
							
							<div class="pull-right">
								
								<a href="salir" class="btn btn-default btn-flat" style="color: whitesmoke;">Salir</a>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>