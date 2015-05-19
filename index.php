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
			//$gdb = new PDO('mysql:host=siteground291.com;dbname=seisgrad_prueba', 'seisgrad_crmuser', '2015crm62015');
		    // $gdb = new PDO('mysql:host=siteground291.com;dbname=seisgrad_crm', 'seisgrad_crmuser', '2015crm62015');
		    $gdb = new PDO('mysql:host=localhost;dbname=prueba', 'root', 'secret');

		    $gdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $sql  = "INSERT INTO contactos_joomla (genero, quiere_conocer, busco_tipo, primer_nombre, segundo_nombre, apellido_paterno, apellido_materno, email, confirma_email, estado, ciudad, tipo_telefono, lada, telefono, tipo_telefono_2, lada_2, telefono_2) VALUES (:genero, :quiere_conocer, :busco_tipo, :primer_nombre, :segundo_nombre, :apellido_paterno, :apellido_materno, :email, :confirma_email, :estado, :ciudad, :tipo_telefono, :lada, :telefono, :tipo_telefono_2, :lada_2, :telefono_2)";

			$q = $gdb->prepare($sql);
			$q->execute(
				array(

					':genero'           => convertToLatin1($data[0]->sexo),
					':quiere_conocer'   => convertToLatin1($data[0]->quisiera_conocer),
					':busco_tipo'       => convertToLatin1($data[0]->busco_tipo),
					':primer_nombre'    => convertToLatin1($data[0]->firstname),
					':segundo_nombre'   => convertToLatin1($data[0]->secondname),
					':apellido_paterno' => convertToLatin1($data[0]->lastname1),
					':apellido_materno' => convertToLatin1($data[0]->lastname2),
					':email'            => convertToLatin1($data[0]->email),
					':confirma_email'   => convertToLatin1($data[0]->confirm),
					':estado'           => convertToLatin1($data[0]->estado),
					':ciudad'           => convertToLatin1($data[0]->ciudad),
					':tipo_telefono'    => convertToLatin1($data[0]->tel1_tipo),
					':lada'             => convertToLatin1($data[0]->lada),
					':telefono'         => convertToLatin1($data[0]->phone),
					':tipo_telefono_2'  => convertToLatin1($data[0]->tel2_tipo),
					':lada_2'           => convertToLatin1($data[0]->lada2),
					':telefono_2'       => convertToLatin1($data[0]->phone2),

				)
			);

			echo "0";

		    $gbd = null;

		} catch (PDOException $e) {

		    print "¡Error!: " . $e->getMessage() . "<br/>";
		    // echo "1";
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
	<link rel="stylesheet" href="public/lib/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="public/lib/font-awesome/css/font-awesome.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body  ng-controller="MainCtrl as main" ng-app="myApp">

	<div class="loader">
		
		<img class="" src="img/loader-128.gif" alt="">
		
	</div>

	<div class="preloader">
		<img src="img/grados_back_1.jpg" class="img-responsive" alt="">
	<!-- 	<img src="img/grados_back_2.jpg" class="img-responsive" alt="">
		<img src="img/grados_back_3.jpg" class="img-responsive" alt="">
		<img src="img/grados_back_4.jpg" class="img-responsive" alt=""> -->
	
	</div>

	<header>
		<div class="nav navbar">
			<a href="/">
				<img src="img/6-grados_logo.png" class="sg-logo  img-responsive block-center" alt="seis grados">
			</a>

		</div>
	</header>
	
	<section class="welcome" ng-hide="welcome" >
		
			<h1 class="text-center" >BIENVENIDO, <span class="req">6</span>rados desarrolla experiencias personalizadas para cambiar tu vida. </h1>
		
			<h2 class="text-center">
				
					<span class="req">6</span>rados. Encuentros Inteligentes.
			</h2> 




	<div class="row ">
				<div class="col-xs-12 col-md-4">
					<div class="row">
			    		<a href="javascript:void($zopim.livechat.say(''))" class="btn btn-danger btn-lg" style="padding: .8em 1em 1em 1em;">
		    				Chatea &nbsp <i class="fa fa-comments"></i>
		    			</a>
					</div>
					<div class="row">
	    				<p class='text-center'>Chatea con nosotros.</p>
	    			</div>
    			</div>
				<div class="col-xs-12 col-md-4">
					<div class="row">
		    			<a ng-model="welcome" ng-click="welcome = true; footer = true;" class=" btn btn-danger btn-lg" style="padding: .8em 1em 1em 1em;">
		    				Regístrate &nbsp <i class="fa fa-file-text-o"></i>
		    			</a>
	    			</div>
					<div class="row">
	    				<p class='text-center'>Te contactaremos de 24 a 48 horas hábiles</p>
	    			</div>
	    		</div>
	    		<div class="col-xs-12 col-md-4 margin-bottom-15">
	    			<div class="row">
			    		<a href="tel:5526483265" class="btn btn-danger btn-lg" style="padding: .8em 1em 1em 1em;">
		    				Llámanos &nbsp <i style="font-size:1.3em;" class="fa fa-mobile"></i>
		    			</a>
					</div>
					<div class="row">
		    			<p class='text-center'>Horario de atención: de 10 a 19 hrs.</p>
					</div>
				</div>
			</div>




<!-- 

			<div class="row ">
				
	    		<div class="col-xs-12 col-md-6 margin-bottom-15 text-center">
		    		<div class="row">
		    			<a href="tel:5526483265" class="btn btn-danger btn-lg" style="padding: .8em 1em 1em 1em;">
		    				Llámanos &nbsp <i style="font-size:1.3em;" class="fa fa-mobile"></i>
		    			</a>
		    		</div>

		    		<div class="row">
	    				<p class='text-center'>Horario de atención: de 10 a 19 hrs.</p>
		    		</div>
	    			
				</div>

				<div class="col-xs-12 col-md-6 text-center">
					<div class="row">
		    			<a ng-model="welcome" ng-click="welcome = true; footer = true;" class=" btn btn-danger btn-lg" style="padding: .8em 1em 1em 1em;">
		    				Regístrate &nbsp <i class="fa fa-file-text-o"></i>
		    			</a>
					</div>
	    			<div class="row">
	    				<p class='text-center'>Te contactaremos de 24 a 48 horas hábiles</p>
	    			</div>
	    		</div>
			</div>
    		 -->

	</section>
	<section class="main" ng-show="welcome">
	
        	<form  novalidate class="form"  id="forma" name="forma">
		        <fieldset class="row">

					<h2>Felicidades, estás a menos de <span class="req">6</span>rados de conocer la persona para ti...</h2>
					<h3>Por favor completa los siguientes datos personales para poder contactarte.</h3>
					<h4>Todos los campos marcados con <span class="req" >*</span> son obligatorios. </h4>
					<div class="row">

						<div class="col-md-5 col-xs-12 ">

							<h3>Soy<span class="req" >*</span></h3>

							<div>
								<select ng-model="main.sexo" ng-value="main.sexo"  name="sexo" ng-value="sexo" id="sexo" required>
									<option value="" selected>Género...</option>
									<option value="Femenino">Mujer</option>
									<option value="Masculino">Hombre</option>
								</select>
								
							</div>
						</div>

						<div class="col-md-3 col-xs-12 ">
							
							<h3>Quisiera conocer <span class="req">*</span></h3>
							<div>
								<label for="radio60"  class="col-md-5 col-xs-5"><input  type="radio" name="quisiera_conocer" id="radio60"  ng-model="quisiera_conocer"  value="Hombre" required/>Hombre</label>
								<label for="radio61" class="col-md-5 col-xs-5"><input type="radio" name="quisiera_conocer" id="radio61"  ng-model="quisiera_conocer"  value="Mujer" required/>Mujer</label> 
									
							</div> 
						</div>
						<div class="col-md-4" ng-show="quisiera_conocer === 'Hombre' && main.sexo == 'Masculino'">
						
							<div id="campo_gay_2 ">
							<h3 id="etiqueta_gay_2">Busco</h3>
								<p>
									
									<label class="col-md-4 col-xs-4" for="busco_gay_activo"><input class="gay" type="radio"  name="busco_tipo" id="busco_gay_activo" ng-model="busco_tipo"   value="Activo" />Activo</label>
									<label class="col-md-4 col-xs-4"  for="busco_gay_pasivo"><input class="gay" type="radio"  name="busco_tipo"  id="busco_gay_pasivo" ng-model="busco_tipo" value="Pasivo"  />Pasivo</label>
									<label class="col-md-4 col-xs-4" for="busco_gay_versatil"><input class="gay" type="radio"  name="busco_tipo"  id="busco_gay_versatil" ng-model="busco_tipo"  value="Versátil"  />Versátil</label> 
								</p>
							</div>
						</div>
						
					</div>

				</fieldset>

				<fieldset class="row">
					
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
							
							<input class="input form-control placeholder" required name="email" type="email" placeholder="Correo@valido.com (requerido) " ng-pattern="/\S+@\S+\.\S+/" size="30" id="email"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off" ng-model="email" ng-value="email" >
							
						</div>

						<div class="col-md-6 col-xs-12 ">
							<h3>Confirma tu Correo Electrónico de Contacto<span class="req" >*</span></h3>
							
							<input class="input form-control placeholder" required name="confirm" type="email" placeholder="Correo@existente.com (requerido)" ng-pattern="/\S+@\S+\.\S+/" size="30" id="confirm"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off" ng-model="confirmEmail" ng-value="confirmEmail" ui-validate="'$value === email'" ui-validate="'email'" >
						</div>
					</div>

				</fieldset>
        	
				<fieldset class="row">
						
					<h2>Datos Personales</h2>
					<h4>Todos los campos marcados con <span class="req" >*</span> son obligatorios. </h4>
					<div class="col-md-12">
						
			
						
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

								
									<select ng-model="tel1_tipo" ng-value="tel1_tipo" class="tel1 col-md-2 col-md-offset-1 col-xs-4 " name="tel1_tipo" id="tel1_tipo" required>
										<option value="" selected>tipo...</option>
										<option value="casa">casa</option>
										<option value="trabajo">trabajo</option>
										<option value="celular">celular</option>
										<option value="nextel">nextel</option>
									</select>

									<input ng-pattern="/^[0-9]*$/" id="lada"  placeholder="LADA" class="input tel1 col-md-2 col-md-offset-1 col-xs-offset-1 col-xs-6 " ng-model="lada" ng-value="lada" name="lada" type="tel" size="2" maxlength="3" minlength="2" required>
								
								
									
									
									<input ng-pattern="/^[0-9]*$/" id="phone" placeholder="Numero valido" class="input tel1 col-md-3 col-md-offset-1 col-xs-offset-1 col-xs-11" ng-model="phone" ng-value="phone" name="phone" type="tel" size="9" maxlength="8" minlength="7" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off" required>
								
							</div>
								<div class="col-md-6 col-xs-12">
								<h3>Teléfono Adicional de Contacto</h3>

									<div>
										<select ng-model="tel2_tipo" ng-value="tel2_tipo" class="tel2 col-md-2 col-md-offset-1 col-xs-4" name="tel2_tipo" id="tel2_tipo">
											<option value="" selected>tipo...</option>
											<option value="casa">casa</option>
											<option value="trabajo">trabajo</option>
											<option value="celular">celular</option>
											<option value="nextel">nextel</option>
										</select>
									
										<input ng-pattern="/^[0-9]*$/" ng-model="lada2" ng-value="lada2" id="lada2" class="input tel2 col-md-2 col-md-offset-1 col-xs-6" name="lada2" placeholder="LADA" value="" type="tel" ng-keyup="" size="2" maxlength="3"  minlength="2">

										<input ng-pattern="/^[0-9]*$/" ng-model="phone2" ng-value="phone2" id="phone2" class="input tel2 col-md-3 col-md-offset-1 col-xs-offset-1 col-xs-11" placeholder="Teléfono (opcional)" value="" name="phone2" type="tel" size="9" maxlength="8" minlength="7" autocomplete="off"    ui-validate="'!$value || $value != phone'" ui-validate="'phone'" >
										
									</div>
								</div>
							</div>
							<div id="terminos" class="par">
								Al hacer click en Registrarme, aceptas todos los <span class="req"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span> y confirmas haber leído el <span class="req"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span> de <span class="req">6</span>rados.
							</div>
						</div>

					</div>
				</fieldset>

				<fieldset class="row btn-row">
					
					<div class="col-xs-12 col-md-12">
						
				       	<div class="col-sm-6 col-xs-6 text-center">
				       		<div class="col-sm-4">
							</div>
								
							
				      	  	<input class="btn btn-danger col-sm-4 col-sm-offset-4" value="Reiniciar" ng-click="reset()" />
						</div>
						<div class="col-sm-6 col-xs-6 text-center">
							<div class="col-sm-4">
							</div>
								
					        <input type="submit" class="btn btn-danger col-sm-4 " id="next" ng-click="pass()"  wz-next ng-disabled="!forma.$valid"  value="Registrarme" />
							
				       	</div>
					</div>
					<div class="margin-bottom-15 margin-top-15 col-xs-10-offset-2 col-md-9 col-md-offset-3">
		    			<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span>
			    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span>
			    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">Políticas de Venta</a></span>
	    			</div>
				</fieldset>
    		</form>

	</section>
	    	
		    
	    	

	<footer ng-hide="!footer">
		
			
		
	</footer>

		
		

	

	<script src="public/lib/jquery/dist/jquery.min.js" ></script>
	<script src="js/script.js" ></script>
	<script src="public/lib/angular/angular.min.js" ></script>
	<script src="public/lib/angular-ui-utils/ui-utils.min.js" ></script>
	<script src="public/lib/angular-sanitize/angular-sanitize.min.js" ></script>
	<script src="js/app.js" ></script>
	<script src="js/filtros.js" ></script>
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
	
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
$.src="//v2.zopim.com/?2xTJMpJw8BWjLmztqekNuCvKRI85RSKn";z.t=+new Date;$.
type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
</script>

<script>
 
  $zopim(function() {
    $zopim.livechat.window.hide();
  });
 
</script>

<script>
var versaTag = {};
versaTag.id = "2970";
versaTag.sync = 0;
versaTag.dispType = "js";
versaTag.ptcl = "HTTPS";
versaTag.bsUrl = "bs.serving-sys.com/BurstingPipe";
//VersaTag activity parameters include all conversion parameters including custom parameters and Predefined parameters. Syntax: "ParamName1":"ParamValue1", "ParamName2":"ParamValue2". ParamValue can be empty.
versaTag.activityParams = {
//Predefined parameters:
"OrderID":"","Session":"","Value":"","productid":"","productinfo":"","Quantity":""
//Custom parameters:
};
//Static retargeting tags parameters. Syntax: "TagID1":"ParamValue1", "TagID2":"ParamValue2". ParamValue can be empty.
versaTag.retargetParams = {};
//Dynamic retargeting tags parameters. Syntax: "TagID1":"ParamValue1", "TagID2":"ParamValue2". ParamValue can be empty.
versaTag.dynamicRetargetParams = {};
// Third party tags conditional parameters and mapping rule parameters. Syntax: "CondParam1":"ParamValue1", "CondParam2":"ParamValue2". ParamValue can be empty.
versaTag.conditionalParams = {};
</script>
<script id="ebOneTagUrlId" src="https://secure-ds.serving-sys.com/SemiCachedScripts/ebOneTag.js"></script>
<noscript>
<iframe src="https://bs.serving-sys.com/BurstingPipe?
cn=ot&amp;
onetagid=2970&amp;
ns=1&amp;
activityValues=$$Value=[Value]&amp;OrderID=[OrderID]&amp;Session=[Session]&amp;ProductID=[ProductID]&amp;ProductInfo=[ProductInfo]&amp;Quantity=[Quantity]$$&amp;
retargetingValues=$$$$&amp;
dynamicRetargetingValues=$$$$&amp;
acp=$$$$&amp;"
style="display:none;width:0px;height:0px"></iframe>
</noscript>
</body>
</html>
<?php
	}
?>
