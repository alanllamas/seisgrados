var app = angular.module('myApp', ['mgo-angular-wizard', 'ui.validate','ngSanitize']);

	app.controller('MainCtrl', ['$scope','WizardHandler','$log','$http', function ($scope, WizardHandler,$http, $log) {
		this.sexo;
		this.busco;
		info = [{},{},{},{}];
		this.info =  info;
		body = document.body;
		body.setAttribute('style', 'background:gray url(img/grados_back_1.png)fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; '
				);

		urls = [
			'url(img/grados_back_2.png)',
			'url(img/grados_back_3.png)',
			'url(img/grados_back_4.png)',
			'url(img/grados_back_1.png)',
			'url(img/grados_back_2.png)',
			'url(img/grados_back_3.png)',
			'url(img/grados_back_4.png)',
			'url(img/grados_back_1.png)',
			'url(img/grados_back_2.png)'
		]
		//inicia obtener archivo json de municipios
		var xmlhttp = new XMLHttpRequest();
		var url = "municipios.json";

		xmlhttp.onreadystatechange = function() {
		    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		        var municipios = JSON.parse(xmlhttp.responseText);
				$scope.mun = municipios;
		    }
		    
		}
		xmlhttp.open("GET", url, true);
		xmlhttp.send();

		//termina obtener archivo json municipios
		function myFunction(arr) {
		    var out = "";
		    var i;
		    for(i = 0; i < arr.length; i++) {
		        out += '<a href="' + arr[i].url + '">' + 
		        arr[i].display + '</a><br>';
		    }
		}



        
		this.store = function  () {
			if (!store.enabled) {
				alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.')
				return
			}
		};

		//store.clear();
		getinfo = store.get('info');
		if (getinfo) {
			for (var i = 0; i < info.length; i++) {
				info[i]= getinfo[i];
			};

			//se obtienen datos del primer objeto/forma
				$scope.main.sexo = getinfo[0]['sexo'];
				$scope.edad1 = getinfo[0]['edad1'];
				$scope.edad2 = getinfo[0]['edad2'];
				$scope.quisiera_conocer = getinfo[0]['quisiera_conocer'];
				$scope.busco_tipo = getinfo[0]['busco_tipo'];
				


			//se obtienen datos del segundo objeto/forma

			
			$scope.firstname = getinfo[1]['firstname'];
			$scope.secondname = getinfo[1]['secondname'];
			$scope.lastname1 = getinfo[1]['lastname1'];
			$scope.lastname2 = getinfo[1]['lastname2'];
			$scope.email = getinfo[1]['email'];
			$scope.confirmEmail = getinfo[1]['confirm'];
			$scope.found = getinfo[1]['found'];
			
			//se obtienen datos del tercer objeto/forma
			$scope.date = getinfo[2]['birthdate'];
			$scope.estatura = getinfo[2]['estatura'];
			$scope.peso = getinfo[2]['peso'];
			$scope.estado = getinfo[2]['estado'];
			$scope.ciudad = getinfo[2]['ciudad'];
			$scope.cp = getinfo[2]['cp'];
			$scope.estadi_civil = getinfo[2]['civil'];
			$scope.hijos = getinfo[2]['tiene_hijos'];
			$scope.tel1_tipo = getinfo[2]['tel1_tipo'];
			$scope.lada = getinfo[2]['lada'];
			$scope.phone = getinfo[2]['phone'];
			$scope.tel2_tipo = getinfo[2]['tel2_tipo'];
			$scope.lada2 = getinfo[2]['lada2'];
			$scope.phone2 = getinfo[2]['phone2'];
			$scope.email2 = getinfo[2]['email2'];
			$scope.email2confirma = getinfo[2]['confirm2'];
			$scope.usuario_fb = getinfo[2]['usuario_fb'];
			$scope.usuario_twitter = getinfo[2]['usuario_twitter'];
			
			
			//se obtienen datos del cuarto objeto/forma
		
			$scope.max_tit_academico = getinfo[3]['academics'];
			$scope.profesion = getinfo[3]['profesion'];
			$scope.sector = getinfo[3]['sector'];


		};
		
		
		
		$scope.pass = function () {

			form =$('form');
			C = WizardHandler.wizard('wizard').currentStepNumber()-1;
			f = form[C];
			$('.datepicker').datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy/mm/dd',
				dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
				yearRange: "1930:1990",
				monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
				minDate: "-85y",
				maxDate: "-25y"

			});
				
				body.setAttribute('style', 'background:gray ' + urls[C] + 'fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; '
				);
				
				
			for (var i = 0; i < 6; i++) {
			};

			
			if (f.name != "foto") {

				for (var i = 0; i < f.length; i++) {
				

						if (f[i].type === 'radio') {
							r = angular.element(f[i]).hasClass('ng-valid-parse');
							n = f[i].name;
							if (r) {
								v =	f[i].value;
								info[C][n]= v ;
								
							}else {
								info[C][n]= '' ;
							};
						};
											
						if (f[i].type != 'submit' && f[i].type != 'radio' ) {
							
								
								v =	f[i].value;
								n = f[i].name;
								info[C][n]= v ;
							
						};
				};
			};
				store.set('info', info);
				get = store.get('info');
				console.log(info)
				console.log(get)
			
		
			return	true;
		};
		$scope.reset = function () {
			if (confirm('Estas seguro de querer reiniciar el formulario, se perderan todos los datos que has ingresado.')) {
				store.clear();
				window.location.reload(true)
			};
		}
		$scope.end = function () {
			foto = $('#photo');
			ff = foto[0].files[0];
			if (ff) {
				foto.removeClass('ng-invalid');
				foto.removeClass('ng-touched');
			

				var formData = new FormData();

				Info = JSON.stringify(info);
				formData.append('foto', foto[0].files[0]);
				formData.append('info', Info)

		        $.ajax({
		            url: "/seisgrados/",
		            type: "POST",
		            data: formData,
		            async: false,
		            cache: false,
		            contentType: false,
		            processData: false
		        }).done(function (data) {
		        	console.log(data)
				if (true) {
						
					// store.clear()
					$('.wizard').empty();
					$('.wizard').append("<h1 class='text-center' >Gracias por tu información.</h1> <h3 class='text-center'>En las próximas 48 hrs uno de nuestros head hunters sociales se comunicará contigo para que comiences a vivir la experiencia <span class='req'>6</span> rados.</h3> <br /> <h2 class='text-center'><span class='req'>6</span> rados. Encuentros Inteligentes.</h2>");
						
					}else{
						$('.pname').empty();
						$('.pname').append("Ha ocurrido algo inesperado reinicia la pagina y vuelve a enviar tu forma.");
					};
		        });

			}else{
				alert('necesitas ingresar una foto');
				foto.addClass('ng-invalid');
				foto.addClass('ng-touched');
			};

				
			

		};

	}]);
				