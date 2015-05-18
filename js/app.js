var app = angular.module('myApp', ['ui.validate','ngSanitize']);

	app.controller('MainCtrl', ['$scope','$log','$http', function ($scope,$http, $log) {
		this.sexo;
		this.busco;
		info = [{}];
		this.info =  info;
	
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

			//se obtienen datos del objeto/forma
				$scope.main.sexo = getinfo[0]['sexo'];
				$scope.quisiera_conocer = getinfo[0]['quisiera_conocer'];
				$scope.busco_tipo = getinfo[0]['busco_tipo'];			
				$scope.firstname = getinfo[0]['firstname'];
				$scope.secondname = getinfo[0]['secondname'];
				$scope.lastname1 = getinfo[0]['lastname1'];
				$scope.lastname2 = getinfo[0]['lastname2'];
				$scope.email = getinfo[0]['email'];
				$scope.confirmEmail = getinfo[0]['confirm'];
				$scope.estado = getinfo[2]['estado'];
				$scope.ciudad = getinfo[2]['ciudad'];
				$scope.tel1_tipo = getinfo[2]['tel1_tipo'];
				$scope.lada = getinfo[2]['lada'];
				$scope.phone = getinfo[2]['phone'];
				$scope.tel2_tipo = getinfo[2]['tel2_tipo'];
				$scope.lada2 = getinfo[2]['lada2'];
				$scope.phone2 = getinfo[2]['phone2'];
			

		};
		
		
		
		$scope.pass = function () {

			form =$('form');
			
			f = form[0];
		
			
				
				
			for (var i = 0; i < 6; i++) {
			};

			

				for (var i = 0; i < f.length; i++) {
				

						if (f[i].type === 'radio') {
							r = angular.element(f[i]).hasClass('ng-valid-parse');
							n = f[i].name;
							if (r) {
								v =	f[i].value;
								info[0][n]= v ;
							};
						};
											
						if (f[i].type != 'submit' && f[i].type != 'radio' ) {
							
								
								v =	f[i].value;
								n = f[i].name;
								info[0][n]= v ;
							
						};
				};
				store.set('info', info);
				get = store.get('info');
				// console.log(info)
				// console.log(get)
			
		
			return	true;
		};
		
		$scope.reset = function () {
			if (confirm('Estas seguro de querer reiniciar el formulario, se perderan todos los datos que has ingresado.')) {
				store.clear();
				window.location.reload(true)
			};
		}
		$scope.end = function () {
		

				var formData = new FormData();

				Info = JSON.stringify(info);
			
				formData.append('info', Info)

		        $.ajax({
		            url: "/",
		            type: "POST",
		            data: formData,
		            async: false,
		            cache: false,
		            contentType: false,
		            processData: false
		        }).done(function (data) {
					if (data == "0") {
							
						store.clear()
						$('.main').empty();
						$('.main').append("<h1 class='text-center' >Haz completado tu primer paso y a partir de éste momento todo tu servicio será personalizado.</h1> <h3 class='text-center'>Durante las próximas 48 horas recibirás una llamada de tu Head Hunter Social, para programar tu entrevista.</h3> <br /> <h2 class='text-center'><span class='req'>6</span> rados. Encuentros Inteligentes.</h2>");
						

					}else {
						$('.main').empty();
						$('.main').append("<h1 class='text-center' >Ha ocurrido algo inesperado reinicia la pagina y vuelve a enviar tu forma.</h1>");
					};
		        });
		 };

	}]);
				
