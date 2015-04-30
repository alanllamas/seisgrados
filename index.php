<?php

	function convertToLatin1($string){
		/*
			si el string es UTF-8 lo convierte en latin1.
		*/
		
		    $latin1 = utf8_decode($string);

		    return $latin1;

	}

	if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST'){

		$data = json_decode($_POST['info']);

		try {

		    // $gdb = new PDO('mysql:host=siteground291.com;dbname=seisgrad_crm', 'seisgrad_crmuser', '2015crm62015');
		    $gdb = new PDO('mysql:host=localhost;dbname=prueba', 'root', 'secret');

		    $gdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $sql  = "INSERT INTO contactos_joomla (genero, edad_busca_1, edad_busca_2, quiere_conocer, busco_tipo, primer_nombre, segundo_nombre, apellido_paterno, apellido_materno, email, confirma_email, como_encontraste, fecha_nacimiento, estatura, peso, estado_civil, tiene_hijos, estado, ciudad, tipo_telefono, lada, telefono, tipo_telefono_2, lada_2, telefono_2, email_2, confirma_email_2, usuario_facebook, usuario_twitter, titulo_academico, profesion, sector, fotografia) VALUES (:genero, :edad_busca_1, :edad_busca_2, :quiere_conocer, :busco_tipo, :primer_nombre, :segundo_nombre, :apellido_paterno, :apellido_materno, :email, :confirma_email, :como_encontraste, :fecha_nacimiento, :estatura, :peso, :estado_civil, :tiene_hijos, :estado, :ciudad, :tipo_telefono, :lada, :telefono, :tipo_telefono_2, :lada_2, :telefono_2, :email_2, :confirma_email_2, :usuario_facebook, :usuario_twitter, :titulo_academico, :profesion, :sector, :fotografia)";

			$q = $gdb->prepare($sql);
			$q->execute(
				array(

					':genero'           => convertToLatin1($data[0]->sexo),
					':edad_busca_1'     => convertToLatin1($data[0]->edad1),
					':edad_busca_2'     => convertToLatin1($data[0]->edad2),
					':quiere_conocer'   => convertToLatin1($data[0]->quisiera_conocer),
					':busco_tipo'       => convertToLatin1($data[0]->busco_tipo),

					':primer_nombre'    => convertToLatin1($data[1]->firstname),
					':segundo_nombre'   => convertToLatin1($data[1]->secondname),
					':apellido_paterno' => convertToLatin1($data[1]->lastname1),
					':apellido_materno' => convertToLatin1($data[1]->lastname2),
					':email'            => convertToLatin1($data[1]->email),
					':confirma_email'   => convertToLatin1($data[1]->confirm),
					':como_encontraste' => convertToLatin1($data[1]->found),

					':fecha_nacimiento' => convertToLatin1($data[2]->birthdate),
					':estatura'         => convertToLatin1($data[2]->estatura),
					':peso'             => convertToLatin1($data[2]->peso),
					':estado_civil'     => convertToLatin1($data[2]->civil),
					':tiene_hijos'      => convertToLatin1($data[2]->tiene_hijos),
					':estado'           => convertToLatin1($data[2]->estado),
					':ciudad'           => convertToLatin1($data[2]->ciudad),
					':tipo_telefono'    => convertToLatin1($data[2]->tel1_tipo),
					':lada'             => convertToLatin1($data[2]->lada),
					':telefono'         => convertToLatin1($data[2]->phone),
					':tipo_telefono_2'  => convertToLatin1($data[2]->tel2_tipo),
					':lada_2'           => convertToLatin1($data[2]->lada2),
					':telefono_2'       => convertToLatin1($data[2]->phone2),
					':email_2'          => convertToLatin1($data[2]->email2),
					':confirma_email_2' => convertToLatin1($data[2]->confirm2),
					':usuario_facebook' => convertToLatin1($data[2]->usuario_fb),
					':usuario_twitter'  => convertToLatin1($data[2]->usuario_twitter),

					':titulo_academico' => convertToLatin1($data[3]->academics),
					':profesion'        => convertToLatin1($data[3]->profesion),
					':sector'           => convertToLatin1($data[3]->sector),
					':fotografia'       => ''
				)
			);

			$last_insert = $gdb->lastInsertId();

			$dir = "uploads/" . $last_insert . "/";

			if(mkdir($dir, 0755)){

				if(move_uploaded_file( $_FILES["foto"]['tmp_name'], "$dir" . $_FILES['foto']['name'])){

					$sql = "UPDATE contactos_joomla SET fotografia=? WHERE contacto_joomla_id=?";

	        		$q2 = $gdb->prepare($sql);
					$q2->execute(array("$dir" . $_FILES['foto']['name'], $last_insert));

					echo "0";

				} else{

					echo "1";

				}

			} else{

				echo "1";

			}
			

		    $gbd = null;

		} catch (PDOException $e) {

		    print "¡Error!: " . $e->getMessage() . "<br/>";

		    die();

		}


	} else {
?>
<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>6 GRADOS</title>
	<link href='http://fonts.googleapis.com/css?family=Dosis:400,700,500' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="public/lib/jquery-ui/themes/smoothness/jquery-ui.min.css">
	<link rel="stylesheet" href="public/lib/angular-wizard/dist/angular-wizard.css">
	<link rel="stylesheet" href="public/lib/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body  ng-controller="MainCtrl as main" ng-app="myApp">

	<div class="loader">
		
		<img class="hidden-xs" src="img/loader-128.gif" alt="">
		<img class="visible-xs" src="img/loader-256.gif" alt="">
	</div>

	<div class="preloader">
		<img src="img/grados_back_1.jpg" class="img-responsive" alt="">
		<img src="img/grados_back_2.jpg" class="img-responsive" alt="">
		<img src="img/grados_back_3.jpg" class="img-responsive" alt="">
		<img src="img/grados_back_4.jpg" class="img-responsive" alt="">
	
	</div>

	<header>
		<div class="nav navbar">
			<a href="/">
				<img src="img/6-grados_logo.png" class="sg-logo img-responsive block-center" alt="seis grados">
			</a>

		</div>
	</header>
	
	<section class="welcome" ng-hide="welcome" >
		
			<h1 class="text-center" >Bienvenido, estas por comenzar tu registro en <span class="req">6</span>rados. </h1>
			<h3 class="text-center">
				<p>
					<span class="req">6</span>rados desarrolla experiencias personalizadas pensadas en ti. Al pagar una <span class="req"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">membresía</a></span> anual, podrás  gozar de sus beneficios. Por favor completa los siguientes <span class="req"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">datos personales</a></span> para poder contactarte.
				</p>
			</h3>
			<h2 class="text-center">
				
					<span class="req">6</span> rados. Encuentros Inteligentes.
			</h2>

			<div class="row btn-row">
				<div class="col-xs-4">
		    		<button class="btn btn-danger form-control col-xs-4">
	    				Chat
	    			</button>	
	    		</div>
				<div class="col-xs-4">
	    			<button ng-model="welcome" ng-click="welcome = true;" class="col-xs-4 btn btn-danger form-control">
	    				Comenzar
	    			</button>
	    		</div>
	    		<div class="col-xs-4">
		    		<button class="btn btn-danger form-control col-xs-4 col-md-4">
	    				Teléfono
	    			</button>
				</div>
	    		<div class="margin-bottom-15 margin-top-15 col-xs-10-offset-2 col-md-9 col-md-offset-3">
	    			<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span>
		    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span>
		    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">Políticas de Venta</a></span>
	    		</div>
			</div>

	</section>
	<wizard name="wizard" ng-show="welcome" on-finish="end()" class="wizard"> 
	
		<wz-step title="¿A Quien Buscas?" canexit="pass">
        	<form  novalidate class="form"  id="buscas" name="buscas">
		        <div class="row">

					<h2>Felicidades, estás a menos de 6rados de conocer la persona para ti...</h2>
					<h4>Todos los campos marcados con 
						<span class="req" >*</span> son obligatorios. </h4>
					<div class="row">

							<div class="col-md-4 col-md-offset-3 col-xs-12 ">

								<h3>Soy<span class="req" >*</span></h3>

								<div>
									<select ng-model="main.sexo" ng-value="main.sexo"  name="sexo" ng-value="sexo" id="sexo" required>
										<option value="" selected>Género...</option>
										<option value="Femenino">Mujer</option>
										<option value="Masculino">Hombre</option>
									</select>
									
								</div>
							</div>

						<div class="col-md-5 col-xs-12 ">
							
							<h3>Quisiera conocer <span class="req">*</span></h3>
							<div>
								<p>
									<label for="radio60"  class="col-md-2 col-xs-5"><input  type="radio" name="quisiera_conocer" id="radio60"  ng-model="quisiera_conocer"  value="Hombre" required/>Hombre</label>
									<label for="radio61" class="col-md-2 col-xs-5"><input type="radio" name="quisiera_conocer" id="radio61"  ng-model="quisiera_conocer"  value="Mujer" required/>Mujer</label> 
									
								</p>
							</div> 
						</div>
					</div>
				
					<div class="row" ng-show="quisiera_conocer === 'Hombre' && main.sexo == 'Masculino'">
						<div class="col-sm-12  ">
						
							<h3 id="etiqueta_gay_2">Busco</h3>
							<div id="campo_gay_2 ">
								<p>
									
									<label for="busco_gay_activo"><input class="gay " type="radio"  name="busco_tipo" id="busco_gay_activo" ng-model="busco_tipo"   value="Activo" />Activo</label>
									<label  for="busco_gay_pasivo"><input class="gay " type="radio"  name="busco_tipo"  id="busco_gay_pasivo" ng-model="busco_tipo" value="Pasivo"  />Pasivo</label>
									<label  for="busco_gay_versatil"><input class="gay " type="radio"  name="busco_tipo"  id="busco_gay_versatil" ng-model="busco_tipo"  value="Versátil"  />Versátil</label> 
								</p>
							</div>
						</div>
					</div>
					
			       	<div class="row btn-row">
			    		<div class=" col-md-6 col-md-offset-3 col-sm-12">
			    			<input type="submit" class="btn form-control btn-danger" id="next" wz-next ng-disabled="!buscas.$valid" value="Siguiente" />
			    			
			    		
			    		</div>
			    		<div class="margin-bottom-15 margin-top-15 col-xs-10-offset-2 col-md-9 col-md-offset-3">
			    			<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span>
				    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span>
				    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">Políticas de Venta</a></span>
			    		</div>
			    	</div>
		        
				</div>

    		</form>
	        	
	    </wz-step>
	    <wz-step title="Cuenta" canexit="pass">
	    	<form novalidate class="form"  id="cuenta" name="cuenta">
				<div class="row">
					
					<h2>Datos para tu Cuenta</h2>
					<h4>Todos los campos marcados con <span class="req" >*</span> son obligatorios. </h4>
					<div class="row">
						
						
						<h3 class="col-md-12 " >Nombres<span class="req" >*</span></h3>
							
					
						<div class="col-md-6 col-xs-12 ">
							
							<input class="input form-control placeholder" required name="firstname" type="text" size="20" placeholder="Nombre (requerido)" id="firstname" ng-model="firstname" ng-value="firstname" ng-value="firstname" >
							
						</div> 
						
						<div class="col-md-6 col-xs-12">
							
						<input class="input form-control placeholder" placeholder="Otros Nombres (opcional)"  name="secondname" type="text" size="20" id="secondname" ng-model="secondname" ng-value="secondname" >
						</div>

					</div>
					<div class="row">
						
						<h3 class="col-md-12 ">Apellido(s) <span class="req" >*</span></h3>

							<div class="col-md-6 col-xs-12 ">
								
							<input class="input form-control placeholder" placeholder="Paterno (requerido)" required name="lastname1"  type="text" size="20" id="lastname1" ng-model="lastname1" ng-value="lastname1" >
							</div>
							<div class="col-md-6 col-xs-12">
								
							<input class="input form-control placeholder" placeholder="Materno (opcional)"name="lastname2"  type="text" size="20" id="lastname2" ng-model="lastname2" ng-value="lastname2" >
							</div>
							
				
					</div>
					<div class="row">
						<div class="col-md-6 col-xs-12 ">
						<h3>Correo Electrónico de Contacto<span class="req" >*</span></h3>
							
							<input class="input form-control placeholder" required name="email" type="email" placeholder="Ejemplo@ejemplo.com (requerido) " ng-pattern="/\S+@\S+\.\S+/" size="30" id="email"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off" ng-model="email" ng-value="email" >
							
						</div>
						<h3 class="col-md-6 ">Confirma tu Correo Electrónico<span class="req" >*</span></h3>
						<div class="col-md-6 col-xs-12 ">
							
							<input class="input form-control placeholder" required name="confirm" type="email" placeholder="Ejemplo@ejemplo.com (requerido)" ng-pattern="/\S+@\S+\.\S+/" size="30" id="confirm"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off" ng-model="confirmEmail" ng-value="confirmEmail" ui-validate="'$value === email'" ui-validate="'email'" >
						</div>
					</div>

				</div>
		    
		    	<div class="row btn-row">
							<div class="col-xs-12 col-md-12">
								
								<div class="col-md-4 col-xs-4 ">
									
									<input type="submit" class="btn form-control btn-danger" wz-previous value="Anterior" />
								</div>
								<div class="col-md-4 col-xs-4 ">
									
						      	  <input class="btn form-control btn-warning" type="submit"  value="Reiniciar" ng-click="reset()" />
								</div>
								<div class="col-md-4 col-xs-4 ">
									
						      	  <input class="btn form-control btn-danger" type="submit" wz-next  ng-disabled="!cuenta.$valid" value="Siguiente" />
								</div>
							</div>
							<div class="margin-bottom-15 margin-top-15 col-xs-10-offset-2 col-md-9 col-md-offset-3">
				    			<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span>
					    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span>
					    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">Políticas de Venta</a></span>
			    			</div>

				</div>
	    	</form>
	    </wz-step>
	    <wz-step title="Informacion Personal" canexit="pass">
        	<form novalidate class="form"   id="pers" name="pers">
				<div class="row">
						
					<h2>Datos Personales</h2>
					<h4>Todos los campos marcados con <span class="req" >*</span> son obligatorios. </h4>
					<div class="col-md-12">
						
			
						
					<fieldset>
						<div class="row">

							<div class="col-md-6 ">
								<h3>Estado<span class="req" >*</span></h3>

								<div>
									
									<select id="estado" required   ng-model="estado" ng-value="estado" size="1" required class="form-control input A" name="estado">
										<option value="">Estado...</option>
										<option value="1">Aguascalientes</option>
										<option value="2">Baja California</option>
										<option value="3">Baja California Sur</option>
										<option value="4">Campeche</option>
										<option value="7">Chiapas</option>
										<option value="8">Chihuahua</option>
										<option value="5">Coahuila</option>
										<option value="6">Colima</option>
										<option value="9">Distrito Federal</option>
										<option value="10">Durango</option>
										<option value="15">Estado de México</option>
										<option value="11">Guanajuato</option>
										<option value="12">Guerrero</option>
										<option value="13">Hidalgo</option>
										<option value="14">Jalisco</option>
										<option value="16">Michoacán</option>
										<option value="17">Morelos</option>
										<option value="18">Nayarit</option>
										<option value="19">Nuevo León</option>
										<option value="20">Oaxaca</option>
										<option value="21">Puebla</option>
										<option value="22">Querétaro</option>
										<option value="23">Quintana Roo</option>
										<option value="24">San Luis Potosí</option>
										<option value="25">Sinaloa</option>
										<option value="26">Sonora</option>
										<option value="27">Tabasco</option>
										<option value="28">Tamaulipas</option>
										<option value="29">Tlaxcala</option>
										<option value="30">Veracruz</option>
										<option value="31">Yucatán</option>
										<option value="32">Zacatecas</option>
									</select> 
								</div>
							</div>
							
							<div class="col-md-6 ">

								<h3>Delegación o Municipio<span class="req" >*</span></h3>
								<select name="ciudad" ng-model="ciudad" ng-value="ciudad"  class="input form-control"  id="ciudad" required>
									<option selected  value="">Selecciona </option>
									<option ng-selected="k === ciudad" value="{{k}}" ng-repeat="(k , v) in mun[estado -1]" >{{v}} </option>
								</select>
								
							</div>
						</div>	
						<div class="row">
							
							<div class="col-md-6  col-xs-12">
								<h3 >Teléfono de Contacto<span class="req" >*</span></h3>

								<div>
									<select ng-model="tel1_tipo" ng-value="tel1_tipo" class="tel1 col-md-2 col-md-offset-1 col-xs-2 " name="tel1_tipo" id="tel1_tipo" required>
										<option value="" selected>tipo...</option>
										<option value="casa">casa</option>
										<option value="trabajo">trabajo</option>
										<option value="celular">celular</option>
										<option value="nextel">nextel</option>
									</select>

									<input ng-pattern="/^[0-9]*$/" id="lada"  placeholder="LADA" class="input tel1 col-md-2 col-md-offset-1 col-xs-3 " ng-model="lada" ng-value="lada" name="lada" type="tel" size="2" maxlength="3" minlength="2" required>
									
									<input ng-pattern="/^[0-9]*$/" id="phone" placeholder="Numero valido" class="input tel1 col-md-3 col-md-offset-1 col-xs-6" ng-model="phone" ng-value="phone" name="phone" type="tel" size="9" maxlength="8" minlength="7" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off" required>
								</div>
							</div>
								<div class="col-md-6 col-xs-12">
								<h3>Teléfono Adicional</h3>

									<div>
										<select ng-model="tel2_tipo" ng-value="tel2_tipo" class="tel2 col-md-2 col-md-offset-1 col-xs-2" name="tel2_tipo" id="tel2_tipo">
											<option value="" selected>tipo...</option>
											<option value="casa">casa</option>
											<option value="trabajo">trabajo</option>
											<option value="celular">celular</option>
											<option value="nextel">nextel</option>
										</select>
									
										<input ng-pattern="/^[0-9]*$/" ng-model="lada2" ng-value="lada2" id="lada2" class="input tel2 col-md-2 col-md-offset-1 col-xs-3" name="lada2" placeholder="LADA" value="" type="tel" ng-keyup="" size="2" maxlength="3"  minlength="2">

										<input ng-pattern="/^[0-9]*$/" ng-model="phone2" ng-value="phone2" id="phone2" class="input tel2 col-md-3 col-md-offset-1 col-xs-6" placeholder="Teléfono (opcional)" value="" name="phone2" type="tel" size="9" maxlength="8" minlength="7" autocomplete="off"    ui-validate="'!$value || $value != phone'" ui-validate="'phone'" >
										
									</div>
								</div>
							</div>
							<div id="terminos" class="par">
								Al hacer click en Registrarme, aceptas todos los <span class="req"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span> y confirmas haber leído el <span class="req"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span> de <span class="req">6</span>rados.
							</div>
						</div>

						<div class="row btn-row">
							
							<div class="col-xs-12 col-md-12">
								<div class="col-sm-4 col-xs-4 ">
											
									<input type="submit" class="btn form-control btn-danger" wz-previous value="Anterior" />
								</div>
						       	<div class="col-sm-4 col-xs-4 ">
									
						      	  <input class="btn form-control btn-warning" type="submit"  value="Reiniciar" ng-click="reset()" />
								</div>
								<div class="col-sm-4 col-xs-4 ">
										
							        <input type="submit" class="btn form-control btn-danger" id="next" wz-next ng-disabled="!pers.$valid" id="end" value="Registrarme" />
									
						       	</div>
							</div>
							<div class="margin-bottom-15 margin-top-15 col-xs-10-offset-2 col-md-9 col-md-offset-3">
				    			<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span>
					    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span>
					    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">Políticas de Venta</a></span>
			    			</div>
						</div>
					</fieldset>	
					</div>
				</div>
    		</form>
	        	
	    </wz-step>
	    
	  
<!--
				
-->
	</wizard>

	<footer >
		
			
		
	</footer>

		
		

	

	<script src="public/lib/jquery/dist/jquery.min.js" ></script>
	<script src="js/script.js" ></script>
	<script src="public/lib/jquery-ui/jquery-ui.min.js"></script>
	<script src="public/lib/angular/angular.min.js" ></script>
	<script src="public/lib/angular-ui-utils/ui-utils.min.js" ></script>
	<script src="public/lib/angular-sanitize/angular-sanitize.min.js" ></script>
	<script src="js/app.js" ></script>
	<script src="js/filtros.js" ></script>
	<script src="public/lib/angular-wizard/dist/angular-wizard.js" ></script>
	<script src="public/lib/lodash/dist/lodash.compat.min.js" ></script>
	<script src="public/lib/store.js/store.min.js" ></script>

	<!-- Facebook Conversion Code for Conversiones Abril 2015 -->

	<script>(function() {

	  var _fbq = window._fbq || (window._fbq = []);

	  if (!_fbq.loaded) {

	    var fbds = document.createElement('script');

	    fbds.async = true;

	    fbds.src = '//connect.facebook.net/en_US/fbds.js';

	    var s = document.getElementsByTagName('script')[0];

	    s.parentNode.insertBefore(fbds, s);

	    _fbq.loaded = true;

	  }

	})();

	window._fbq = window._fbq || [];

	window._fbq.push(['track', '6025219573159', {'value':'0.01','currency':'EUR'}]);

	</script>

	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6025219573159&amp;cd[value]=0.01&amp;cd[currency]=EUR&amp;noscript=1" /></noscript>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-34706835-2', 'auto');
		ga('send', 'pageview');
	</script>
</body>
</html>
<?php
	}
?>
