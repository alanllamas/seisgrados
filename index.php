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

		    $gdb = new PDO('mysql:host=siteground291.com;dbname=seisgrad_prueba', 'seisgrad_crmuser', '2015crm62015');
		    // $gdb = new PDO('mysql:host=localhost;dbname=seisgrad_prueba', 'root', 'root');

		    $gdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $sql  = "INSERT INTO contactos_joomla (genero, edad_busca_1, edad_busca_2, quiere_conocer, busco_tipo, primer_nombre, segundo_nombre, apellido_paterno, apellido_materno, email, confirma_email, como_encontraste, fecha_nacimiento, estatura, peso, estado_civil, tiene_hijos, estado, ciudad, tipo_telefono, lada, telefono, tipo_telefono_2, lada_2, telefono_2, email_2, confirma_email_2, usuario_facebook, usuario_twitter, titulo_academico, profesion, sector, fotografia) VALUES (:genero, :edad_busca_1, :edad_busca_2, :quiere_conocer, :busco_tipo, :primer_nombre, :segundo_nombre, :apellido_paterno, :apellido_materno, :email, :confirma_email, :como_encontraste, :fecha_nacimiento, :estatura, :peso, :estado_civil, :tiene_hijos, :estado, :ciudad, :tipo_telefono, :lada, :telefono, :tipo_telefono_2, :lada_2, :telefono_2, :email_2, :confirma_email_2, :usuario_facebook, :usuario_twitter, :titulo_academico, :profesion, :sector, :fotografia)";

			$q = $gdb->prepare($sql);
			$q->execute(
				array(

					':genero'           => $data[0]->sexo,
					':edad_busca_1'     => $data[0]->edad1,
					':edad_busca_2'     => $data[0]->edad2,
					':quiere_conocer'   => $data[0]->quisiera_conocer,
					':busco_tipo'       => $data[0]->busco_tipo,

					':primer_nombre'    => $data[1]->firstname,
					':segundo_nombre'   => $data[1]->secondname,
					':apellido_paterno' => $data[1]->lastname1,
					':apellido_materno' => $data[1]->lastname2,
					':email'            => $data[1]->email,
					':confirma_email'   => $data[1]->confirm,
					':como_encontraste' => $data[1]->found,

					':fecha_nacimiento' => $data[2]->birthdate,
					':estatura'         => $data[2]->estatura,
					':peso'             => $data[2]->peso,
					':estado_civil'     => $data[2]->civil,
					':tiene_hijos'      => $data[2]->tiene_hijos,
					':estado'           => $data[2]->estado,
					':ciudad'           => $data[2]->ciudad,
					':tipo_telefono'    => $data[2]->tel1_tipo,
					':lada'             => $data[2]->lada,
					':telefono'         => $data[2]->phone,
					':tipo_telefono_2'  => $data[2]->tel2_tipo,
					':lada_2'           => $data[2]->lada2,
					':telefono_2'       => $data[2]->phone2,
					':email_2'          => $data[2]->email2,
					':confirma_email_2' => $data[2]->confirm2,
					':usuario_facebook' => $data[2]->usuario_fb,
					':usuario_twitter'  => $data[2]->usuario_twitter,

					':titulo_academico' => $data[3]->academics,
					':profesion'        => $data[3]->profesion,
					':sector'           => $data[3]->sector,
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
		<img src="img/grados_back_1.png" class="img-responsive" alt="">
		<img src="img/grados_back_2.png" class="img-responsive" alt="">
		<img src="img/grados_back_3.png" class="img-responsive" alt="">
		<img src="img/grados_back_4.png" class="img-responsive" alt="">
	
	</div>

	<header>
		<div class="nav navbar">
			<img src="img/6-grados_logo.png" class="img-responsive col-sm-12 block-center" alt="seis grados">

		</div>
	</header>
	
	<section class="welcome" ng-hide="welcome" >
		
			<h1 class="text-center" >Bienvenido, estas por comenzar tu registro en <span class="req">6</span>grados. </h1>
			<h3 class="text-center">
				<p>
					<span class="req">6</span> rados desarrolla experiencias personalizadas pensadas en ti. Al pagar una <span class="req"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">membresía</a></span> anual, podrás  gozar de sus beneficios. Por favor completa los siguientes <span class="req"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">datos personales</a></span> para poder contactarte.
				</p>
			</h3>
			<h2 class="text-center">
				
					<span class="req">6</span> rados. Encuentros Inteligentes.
			</h2>

			<div class="row btn-row">
				<div class=" col-md-6 col-md-offset-3 col-xs-12">
		    			
	    			<button ng-model=	"welcome" ng-click="welcome = true;" class="btn btn-danger form-control">
	    				Comenzar
	    			</button>
		    		
				
	    		</div>
	    		<div class="margin-bottom-15 margin-top-15 col-xs-10-offset-2 col-md-9 col-md-offset-3">
	    			<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span>
		    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span>
		    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">Políticas de Venta</a></span>
	    		</div>
			</div>

	</section>
	<wizard name="wizard" ng-show="welcome" edit-mode="true"  on-finish="end()" class="wizard"> 
	
		<wz-step title="¿A Quien Buscas?" canexit="pass">
        	<form  novalidate class="form"  id="buscas" name="buscas">
		        <div class="row">

					<h2>¿A quién buscas?</h2>
					<h4>Todos los campos marcados con 
						<span class="req" >*</span> son obligatorios. </h4>
					<div class="row">

							<div class="col-md-4 col-xs-12 ">

								<h3>Soy<span class="req" >*</span></h3>

								<div>
									<select ng-model="main.sexo" ng-value="main.sexo"  name="sexo" ng-value="sexo" id="sexo" required>
										<option value="" selected>Género...</option>
										<option value="femenino">Mujer</option>
										<option value="masculino">Hombre</option>
									</select>
									
								</div>
							</div>


						<div class="col-xs-12 ">
							<h3 >Busco alguien entre<span class="req" >*</span></h3>

								<select class="col-md-1 col-xs-3" required ng-model="edad1" ng-value="edad1" value="Edad..." name="edad1" id="edad1" >
									<option value="" >Edad...</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
									<option value="32">32</option>
									<option value="33">33</option>
									<option value="34">34</option>
									<option value="35">35</option>
									<option value="36">36</option>
									<option value="37">37</option>
									<option value="38">38</option>
									<option value="39">39</option>
									<option value="40">40</option>
									<option value="41">41</option>
									<option value="42">42</option>
									<option value="43">43</option>
									<option value="44">44</option>
									<option value="45">45</option>
									<option value="46">46</option>
									<option value="47">47</option>
									<option value="48">48</option>
									<option value="49">49</option>
									<option value="50">50</option>
									<option value="51">51</option>
									<option value="52">52</option>
									<option value="53">53</option>
									<option value="54">54</option>
									<option value="55">55</option>
									<option value="56">56</option>
									<option value="57">57</option>
									<option value="58">58</option>
									<option value="59">59</option>
									<option value="60">60</option>
									<option value="61">61</option>
									<option value="62">62</option>
									<option value="63">63</option>
									<option value="64">64</option>
									<option value="65">65</option>
									<option value="66">66</option>
									<option value="67">67</option>
									<option value="68">68</option>
									<option value="69">69</option>
									<option value="70">70</option>
								</select>
								<p class="col-md-1 col-xs-3" >y</p>
					
								
								<select class="col-md-1 col-xs-3" required value="Edad..." ng-model="edad2" ng-value="edad2" name="edad2" id="edad2" >
									<option value="">Edad...</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option>
									<option value="32">32</option>
									<option value="33">33</option>
									<option value="34">34</option>
									<option value="35">35</option>
									<option value="36">36</option>
									<option value="37">37</option>
									<option value="38">38</option>
									<option value="39">39</option>
									<option value="40">40</option>
									<option value="41">41</option>
									<option value="42">42</option>
									<option value="43">43</option>
									<option value="44">44</option>
									<option value="45">45</option>
									<option value="46">46</option>
									<option value="47">47</option>
									<option value="48">48</option>
									<option value="49">49</option>
									<option value="50">50</option>
									<option value="51">51</option>
									<option value="52">52</option>
									<option value="53">53</option>
									<option value="54">54</option>
									<option value="55">55</option>
									<option value="56">56</option>
									<option value="57">57</option>
									<option value="58">58</option>
									<option value="59">59</option>
									<option value="60">60</option>
									<option value="61">61</option>
									<option value="62">62</option>
									<option value="63">63</option>
									<option value="64">64</option>
									<option value="65">65</option>
									<option value="66">66</option>
									<option value="67">67</option>
									<option value="68">68</option>
									<option value="69">69</option>
									<option value="70">70</option>
								</select>

								
							
							
						</div>

					</div>

					<div class="row">
						<div class="col-xs-12 ">
							
							<h3>Quisiera conocer <span class="req">*</span></h3>
							<div>
								<p>
									<label for="radio60"  class="col-md-2 col-xs-5"><input  type="radio" name="quisiera_conocer" id="radio60"  ng-model="quisiera_conocer"  value="Hombre" required/>Hombre</label>
									<label for="radio61" class="col-md-2 col-xs-5"><input type="radio" name="quisiera_conocer" id="radio61"  ng-model="quisiera_conocer"  value="Mujer" required/>Mujer</label> 
									
								</p>
							</div> 
						</div>
					</div>
					<div class="row" ng-show="quisiera_conocer === 'Hombre' && main.sexo == 'masculino'">
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
						<h3 class="col-md-12 ">Correo Electrónico<span class="req" >*</span></h3>
						<div class="col-md-6 col-xs-12 ">
							
							<input class="input form-control placeholder" required name="email" type="email" placeholder="Ejemplo@ejemplo.com (requerido) " ng-pattern="/\S+@\S+\.\S+/" size="30" id="email"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off" ng-model="email" ng-value="email" >
							
						</div>
						<div class="col-md-6 col-xs-12 ">
							
							<input class="input form-control placeholder" required name="confirm" type="email" placeholder="Ejemplo@ejemplo.com (requerido)" ng-pattern="/\S+@\S+\.\S+/" size="30" id="confirm"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off" ng-model="confirmEmail" ng-value="confirmEmail" ui-validate="'$value === email'" ui-validate="'email'" >
						</div>
					</div>

					<div class="row">
						<div class="col-md-5 col-xs-12 ">
						<h3>¿Cómo nos encontraste?<span class="req" >*</span></h3>
							
							<select ng-model="found" ng-value="found" required name="found" id="found" >
								
								<option value="" selected>Selecciona...</option>
								<option value="Participante de la Revista Moi">Participante de la Revista Moi</option>
								<option value="Actitud FEM">Actitud FEM</option>
								<option value="Airport Style">Airport Style</option>
								<option value="Alto Nivel">Alto Nivel</option>
								<option value="El Efecto Leopi">El Efecto Leopi</option>
								<option value="El Financiero">El Financiero</option>
								<option value="El Respetable">El Respetable</option>
								<option value="Email">Email</option>
								<option value="Estilo DF">Estilo DF</option>
								<option value="Facebook">Facebook</option>
								<option value="Forbes">Forbes</option>
								<option value="GQ">GQ</option>
								<option value="Google">Google</option>
								<option value="Intrend Magazine">Intrend Magazine</option>
								<option value="Linked In">Linked In</option>
								<option value="Martha Debayle">Martha Debayle</option>
								<option value="Milenio">Milenio</option>
								<option value="Mojoe">Mojoe</option>
								<option value="Moi">Moi</option>
								<option value="Netas Divinas">Netas Divinas</option>
								<option value="Networking Nights">Networking Nights</option>
								<option value="Radio">Radio</option>
								<option value="Recomendacion de un amigo">Recomendacion de un amigo</option>
								<option value="Recomendacion de un socio">Recomendacion de un socio</option>
								<option value="S1ngular">S1ngular</option>
								<option value="Smartbox">Smartbox</option>
								<option value="Soho">Soho</option>
								<option value="Soltera pero No Sola">Soltera pero No Sola</option>
								<option value="Solteros Club">Solteros Club</option>
								<option value="The Box Club">The Box Club</option>
								
								<option value="Televisión">Televisión</option>
								<option value="Twitter">Twitter</option>
								<option value="Otros">OTROS</option>

							</select>

							
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

							<div class="col-md-6 col-xs-12 ">
								<h3>Fecha de Nacimiento<span class="req" >*</span></h3>

								<div>

									<input  type="text" class="input datepicker form-control" readonly placeholder="selecciona tu fecha (requerido)" ng-model="date" ng-value="date" name="birthdate" required />	
									
								</div>
							</div>
						</div>
						<div class="row">
						
							<div class="col-md-3 col-xs-6 ">
								<h3>Estatura<span class="req" >*</span></h3>

								<div>
									<select ng-model="estatura" ng-value="estatura"  name="estatura" required>
										<option selected value="">Estatura...</option>
										<option value="1.50 o menos">1.50 o menos</option>
										<option value="1.51">1.51</option>
										<option value="1.52">1.52</option>
										<option value="1.53">1.53</option>
										<option value="1.54">1.54</option>
										<option value="1.55">1.55</option>
										<option value="1.56">1.56</option>
										<option value="1.57">1.57</option>
										<option value="1.58">1.58</option>
										<option value="1.59">1.59</option>
										<option value="1.60">1.60</option>
										<option value="1.61">1.61</option>
										<option value="1.62">1.62</option>
										<option value="1.63">1.63</option>
										<option value="1.64">1.64</option>
										<option value="1.65">1.65</option>
										<option value="1.66">1.66</option>
										<option value="1.67">1.67</option>
										<option value="1.68">1.68</option>
										<option value="1.69">1.69</option>
										<option value="1.70">1.70</option>
										<option value="1.71">1.71</option>
										<option value="1.72">1.72</option>
										<option value="1.73">1.73</option>
										<option value="1.74">1.74</option>
										<option value="1.75">1.75</option>
										<option value="1.76">1.76</option>
										<option value="1.77">1.77</option>
										<option value="1.78">1.78</option>
										<option value="1.79">1.79</option>
										<option value="1.80">1.80</option>
										<option value="1.81">1.81</option>
										<option value="1.82">1.82</option>
										<option value="1.83">1.83</option>
										<option value="1.84">1.84</option>
										<option value="1.85">1.85</option>
										<option value="1.86">1.86</option>
										<option value="1.87">1.87</option>
										<option value="1.88">1.88</option>
										<option value="1.89">1.89</option>
										<option value="1.90">1.90</option>
										<option value="1.91">1.91</option>
										<option value="1.92">1.92</option>
										<option value="1.93">1.93</option>
										<option value="1.94">1.94</option>
										<option value="1.95">1.95</option>
										<option value="1.96">1.96</option>
										<option value="1.97">1.97</option>
										<option value="1.98">1.98</option>
										<option value="1.99">1.99</option>
										<option value="2.00">2.00</option>
										<option value="2.01">2.01 o más</option>
									</select>
									
								</div>
							</div>

						
						
							<div class="col-md-2 col-md-offset-2 col-xs-6">	
								<h3>Peso<span class="req" >*</span></h3>

								<div>

									<select ng-model="peso" ng-value="peso" name="peso" required>
										<option selected value="">Peso...</option>
										<option value="35 o menos">35 o menos</option>
										<option value="36">36</option>
										<option value="37">37</option>
										<option value="38">38</option>
										<option value="39">39</option>
										<option value="40">40</option>
										<option value="41">41</option>
										<option value="42">42</option>
										<option value="43">43</option>
										<option value="44">44</option>
										<option value="45">45</option>
										<option value="46">46</option>
										<option value="47">47</option>
										<option value="48">48</option>
										<option value="49">49</option>
										<option value="50">50</option>
										<option value="51">51</option>
										<option value="52">52</option>
										<option value="53">53</option>
										<option value="54">54</option>
										<option value="55">55</option>
										<option value="56">56</option>
										<option value="57">57</option>
										<option value="58">58</option>
										<option value="59">59</option>
										<option value="60">60</option>
										<option value="61">61</option>
										<option value="62">62</option>
										<option value="63">63</option>
										<option value="64">64</option>
										<option value="65">65</option>
										<option value="66">66</option>
										<option value="67">67</option>
										<option value="68">68</option>
										<option value="69">69</option>
										<option value="70">70</option>
										<option value="71">71</option>
										<option value="72">72</option>
										<option value="73">73</option>
										<option value="74">74</option>
										<option value="75">75</option>
										<option value="76">76</option>
										<option value="77">77</option>
										<option value="78">78</option>
										<option value="79">79</option>
										<option value="80">80</option>
										<option value="81">81</option>
										<option value="82">82</option>
										<option value="83">83</option>
										<option value="84">84</option>
										<option value="85">85</option>
										<option value="86">86</option>
										<option value="87">87</option>
										<option value="88">88</option>
										<option value="89">89</option>
										<option value="90">90</option>
										<option value="91">91</option>
										<option value="92">92</option>
										<option value="93">93</option>
										<option value="94">94</option>
										<option value="95">95</option>
										<option value="96">96</option>
										<option value="97">97</option>
										<option value="98">98</option>
										<option value="99">99</option>
										<option value="100 o más">100 o más</option>
									</select>
									
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-xs-6 ">
								<h3>Mi Estado civil</h3>

								<div>
									<select ng-model="estadi_civil" ng-value="estadi_civil" name="civil" id="estadi_civil">
										<option value="" selected>Selecciona..</option>
										<option value="Soltero (a)">Soltero (a)</option>
										<option value="Divorciado (a)">Divorciado (a)</option>
										<option value="En proceso de divorcio">En proceso de divorcio</option>
										<option value="Separado (a)">Separado (a)</option>
										<option value="Viudo (a)">Viudo (a)</option>
									</select>
								</div>
							</div>
							
							<div class="col-md-4 col-md-offset-1 col-xs-6" >
								<h3 >¿Tienes hijos?</h3>

								<div>
									<select name="tiene_hijos" ng-model="hijos" ng-value="hijos" id="pos_hijos">
										<option value="">Hijos...</option>
										<option value="si">Sì</option>
										<option value="no">No</option>
									</select>
								</div>
							</div>
						
						</div>
					</fieldset>


						
						
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
										<option value="5">Chiapas</option>
										<option value="6">Chihuahua</option>
										<option value="7">Coahuila</option>
										<option value="8">Colima</option>
										<option value="9">Distrito Federal</option>
										<option value="10">Durango</option>
										<option value="11">Estado de México</option>
										<option value="12">Guanajuato</option>
										<option value="13">Guerrero</option>
										<option value="14">Hidalgo</option>
										<option value="15">Jalisco</option>
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
								<h3 >Teléfono<span class="req" >*</span></h3>

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
						</div>
						<div class="row">
							<div class="col-md-12 ">
								
								<h3 class=" col-md-12" >Correo Electrónico Adicional</h3>
								<div class="col-md-6 ">

									<div>
										<input class="input form-control" ng-model="email2" placeholder="(opcional)" ng-value="email2" name="email2" type="email" ng-pattern="/\S+@\S+\.\S+/" size="30" id="email2"  onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off">
										
									</div>
								</div>
								
								<div class="col-md-6">

									<div >
										<input class="input form-control" ng-model="email2confirma" ng-value="email2confirma" placeholder="Confirma tu correo (opcional)" name="confirm2" type="email" ng-pattern="/\S+@\S+\.\S+/" size="30" id="confirm" onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete="off"  ui-validate="'$value === email2'" ui-validate="'email2'" >
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							
							<div class="col-md-12">
								
								<div class="col-md-6 ">
									<h3>Usuario de Facebook</h3>
									
									<div>
										<input class="input form-control" placeholder="(opcional)" ng-model="usuario_fb" ng-value="usuario_fb" name="usuario_fb" type="text" size="20" maxlength="30" id="usuario_fb">
									</div>
								</div>

								<div class="col-md-6">
									<h3>Usuario de Twitter</h3>

									<div>
										<input class="input form-control" placeholder="(opcional)" ng-model="usuario_twitter" ng-value="usuario_twitter" name="usuario_twitter" type="text" size="20" maxlength="30" id="usuario_twitter">
									</div>
								</div>
							</div>
						</div>
						<div class="row btn-row">
							<div class="col-xs-12 col-md-12">
								
								<div class="col-md-4 col-xs-4">
									
									<input type="submit" class="btn form-control btn-danger" wz-previous value="Anterior" />
								</div>
								<div class="col-md-4 col-xs-4">
									
						      	  <input class="btn form-control btn-warning" type="submit"  value="Reiniciar" ng-click="reset()" />
								</div>
								<div class="col-md-4 col-xs-4">
									
						      	  <input type="submit" class="btn form-control btn-danger" id="next" wz-next ng-disabled="!pers.$valid" value="Siguiente" />
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
	    <wz-step title="Estudios" canexit="pass">
        	<form novalidate class="form"  id="estudios" name="estudios">
		        <div class="row">

					<h2>Estudios y trabajo</h2>
					<h4>Todos los campos marcados con <span class="req" >*</span> son obligatorios. </h4>

					<div class="col-md-12 " >

						<h3>Máximo título académico<span class="req" >*</span></h3>

						<div>
							<select required ng-model="max_tit_academico" ng-value="max_tit_academico"  name="academics" id="max_tit_academico" >
								<option value="">Selecciona...</option>
								<option value="Estudios de doctorado">Estudios de doctorado</option>
								<option value="Estudios de maestría">Estudios de maestría</option>
								<option value="Estudios de postgrado">Estudios de postgrado</option>
								<option value="Estudios universitarios">Estudios universitarios</option>
								<option value="Bachillerato general">Bachillerato general</option>
								<option value="Profesional técnico">Profesional técnico</option>
							</select>
							
						</div>

					
					</div>


					<div class="col-sm-12 ">
						<h3>Profesión<span class="req" >*</span></h3>
						<div>
							<select required ng-model="profesion" ng-value="profesion" name="profesion" id="profesion"  >
								<option value="">Selecciona...</option>
								<option value="Empleado (a)">Empleado (a)</option>
								<option value="Empresario (a)">Empresario (a)</option>
								<option value="Independiente">Independiente</option>
								<option value="Burócrata">Burócrata</option>
								<option value="Pensionado (a)">Pensionado (a)</option>
								<option value="Desempleado (a)">Desempleado (a)</option>
								<option value="Ejecutivo (a)">Ejecutivo (a)</option>
								<option value="Gerente">Gerente</option>
								<option value="Director (a)">Director (a)</option>
								<option value="otra">Otra...</option>
							</select>
						</div>
					</div>


					

					<div class="col-sm-12 ">
							
						<h3>Sector<span class="req" >*</span></h3>
						<div>
							<select required ng-model="sector" ng-value="sector"  name="sector" id="sector" >
								<option value="">Selecciona...</option>
								<option value="Agricultura/Pesca/Servicios forestales/Cuidado de animales">Agricultura/Pesca/Servicios forestales/Cuidado de animales</option>
								<option value="Alta dirección">Alta dirección</option>
								<option value="Arte / Diseño / Entretenimiento">Arte / Diseño / Entretenimiento </option>
								<option value="Automóviles / Partes automotrices">Automóviles / Partes automotrices </option>
								<option value="Bienes raíces">Bienes raíces </option>
								<option value="Biotecnología / Farmacéutica">Biotecnología / Farmacéutica </option>
								<option value="Ciencias e investigación">Ciencias e investigación </option>
								<option value="Comercio / Ventas">Comercio / Ventas </option>
								<option value="Comunidad/Servicios sociales/Religión/Proyectos no lucrativos">Comunidad/Servicios sociales/Religión/Proyectos no lucrativos </option>
								<option value="Construcción / Minería / Obreros especializados">Construcción / Minería / Obreros especializados </option>
								<option value="Control de calidad y seguridad">Control de calidad y seguridad </option>
								<option value="Diseño gráfico / Interiores / Modas">Diseño gráfico / Interiores / Modas </option>
								<option value="Educación, cuidado infantil / Librerías">Educación, cuidado infantil / Librerías </option>
								<option value="Finanzas / Contabilidad / Seguros">Finanzas / Contabilidad / Seguros </option>
								<option value="Gobierno">Gobierno </option>
								<option value="Hotelería / Turismo">Hotelería / Turismo </option>
								<option value="Industria manufacturera">Industria manufacturera </option>
								<option value="Ingeniería/arquitectura">Ingeniería/arquitectura </option>
								<option value="Instalación, mantenimiento y reparaciones">Instalación, mantenimiento y reparaciones </option>
								<option value="Joyería">Joyería </option>
								<option value="Labores administrativas y de oficina">Labores administrativas y de oficina </option>
								<option value="Labores generales">Labores generales </option>
								<option value="Legal">Legal </option>
								<option value="Medios / periodismo / impresión / Servicios editoriales">Medios / periodismo / impresión / Servicios editoriales </option>
								<option value="Mercadotecnia / publicidad / RP / Desarrollo de negocios">Mercadotecnia / publicidad / RP / Desarrollo de negocios </option>
								<option value="Operación / logística / Almacenaje">Operación / logística / Almacenaje </option>
								<option value="Recreación / deportes">Recreación / deportes </option>
								<option value="Recursos humanos">Recursos humanos </option>
								<option value="Restaurantes / Gastronomía">Restaurantes / Gastronomía </option>
								<option value="Servicio a clientes">Servicio a clientes </option>
								<option value="Servicios arreglo personal / Seguridad / Esparcimiento">Servicios arreglo personal / Seguridad / Esparcimiento </option>
								<option value="Servicios de protección / Seguridad">Servicios de protección / Seguridad </option>
								<option value="Servicios de salud / medicina">Servicios de salud / medicina </option>
								<option value="Software / sistemas de información / Desarrollo de hardware">Software / sistemas de información / Desarrollo de hardware </option>
								<option value="Tecnología de la información">Tecnología de la información </option>
								<option value="Transportes / Mudanzas de materiales">Transportes / Mudanzas de materiales </option>
								<option value="Ventas / Servicio a clientes">Ventas / Servicio a clientes </option>
							</select>
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
								
					        <input type="submit" class="btn form-control btn-danger" id="next" wz-next ng-disabled="!estudios.$valid" value="Siguiente" />
							
				       		</div>	
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
	    
	  
	    <wz-step title="Fotografia" canexit="pass">
        	<form enctype="multipart/form-data" novalidate class="form"  id="foto" name="foto">
		        <div class="row">
		        	<div class="col-sm-12 ">
			        	<div class="row">
				        		
							<h3>Fotografía</h3>
							<h4>Todos los campos marcados con <span class="req" >*</span> son obligatorios. </h4>
							<div>
								<h4>Seleccione...</h4>
								<div>
									<input  ng-model="photo" ng-value="photo" id="photo" type="file" container_id="0" name="photo" accept="image/*" />
									<p>Se acepta formato JPG o PNG</p>
						
									<p>
										<strong>
											<span class="req">El tamaño no debe ser mayor a 5Mb</span>
										</strong>
									</p>
									<p>
									Te recordamos que tu información e imagen son exclusivamente de uso interno de Seis Grados y ten la tranquilidad que ninguno de los usuarios tendrá acceso a nuestro banco de imágenes, las cuales únicamente le ayudan a tu Head Hunter Social a reconocerte el día de tu entrevista.
									</p>
								</div>
							</div>
			        	</div>
						<div class="row">
							
							<div class="col-md-6 col-xs-12">
								<p>Buenas fotos</p>
								<div class="col-md-6 col-xs-6"><img src="img/fotoOK1.jpg" /></div>
								<div class="col-md-6 col-xs-6"><img src="img/fotoOK2.jpg" /></div>
							</div>
							<div class="col-md-6">
								<p>Se rechazarán las siguientes fotos</p>
								<div class="col-xs-4" ><img src="img/fotoMala1.jpg" /></div>
								<div class="col-xs-4" ><img src="img/fotoMala2.jpg" /></div>
								<div class="col-xs-4" ><img src="img/fotoMala3.jpg" /></div>
							</div>
						</div>
						<div id="terminos" class="par">
							Al hacer click en Registrarme, aceptas todos los <span class="req"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span> y confirmas haber leído el <span class="req"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span> de <span class="req">6</span>rados.
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
										
							        <input type="submit" class="btn form-control btn-danger" id="next" wz-next ng-disabled="!foto.$valid" id="end" value="Registrarme" />
									
						       	</div>
							</div>
							<div class="margin-bottom-15 margin-top-15 col-xs-10-offset-2 col-md-9 col-md-offset-3">
				    			<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/aviso-de-privacidad/">Aviso de Privacidad</a></span>
					    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/terminos-y-condiciones/">Términos y Condiciones</a></span>
					    		<span class="req col-md-3 col-xs-4 text-center"><a href="http://www.seisgrados.com.mx/politicas-de-venta/">Políticas de Venta</a></span>
			    			</div>
						</div>
					</div>
				</div>
		     
    		</form>
	        	
	    </wz-step>
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
	
</body>
</html>
<?php
	}
?>
