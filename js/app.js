var app = angular.module('myApp', ['mgo-angular-wizard', 'ui.validate','ngSanitize']);

	app.controller('MainCtrl', ['$scope','WizardHandler','$log', function ($scope, WizardHandler, $log) {
		this.sexo;
		this.busco;
		info = [{},{},{},{},{}];
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



        $.getJSON('municipios.json', function(json, textStatus) {
        		muni = $.parseJSON(json);
        		alert(muni)
        		
        		$.each(json, function(index, val) {
	        		$log.log(val)
        		});

        		return muni;
        });
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
				$scope.main.busco = getinfo[0]['quisiera_conocer']
				if ( getinfo[0]['busco_gay_activo']) {
				$scope.gay1 = getinfo[0]['busco_gay_activo'];
				};
				if ( getinfo[0]['busco_gay_pasivo']) {
					$scope.gay2 = getinfo[0]['busco_gay_pasivo'];
				};
				if ( getinfo[0]['busco_gay_versatil']) {
					$scope.gay3 = getinfo[0]['busco_gay_versatil'];
				};


			//se obtienen datos del segundo objeto/forma

			
			$scope.firstname = getinfo[1]['firstname'];
			$scope.secondname = getinfo[1]['secondname'];
			$scope.lastname1 = getinfo[1]['lastname1'];
			$scope.lastname2 = getinfo[1]['lastname2'];
			$scope.email = getinfo[1]['email'];
			$scope.confirmEmail = getinfo[1]['email'];
			$scope.found = getinfo[1]['found'];
			
			//se obtienen datos del tercer objeto/forma
			$scope.date = getinfo[2]['datepicker'];
			$scope.estatura = getinfo[2]['estatura'];
			$scope.peso = getinfo[2]['peso'];
			$scope.estado = getinfo[2]['estado'];
			$scope.ciudad = getinfo[2]['ciudad'];
			$scope.cp = getinfo[2]['cp'];
			$scope.estadi_civil = getinfo[2]['estadi_civil'];
			$scope.hijos = getinfo[2]['posesion_hijos'];
			if (getinfo[2]['tel']) {
				$scope.tel1_tipo = getinfo[2]['tel'][0];
				$scope.lada = getinfo[2]['tel'][1];
				$scope.phone = getinfo[2]['tel'][2];
			};
			if ( getinfo[2]['tel2']) {
				$scope.tel2_tipo = getinfo[2]['tel2'][0];
				$scope.lada2 = getinfo[2]['tel2'][1];
				$scope.phone2 = getinfo[2]['tel2'][2];
			};
			$scope.email2 = getinfo[2]['email2'];
			$scope.email2confirma = getinfo[2]['email2'];
			$scope.usuario_fb = getinfo[2]['usuario_fb'];
			$scope.usuario_twitter = getinfo[2]['usuario_twitter'];
			
			
			//se obtienen datos del cuarto objeto/forma
		
			$scope.max_tit_academico = getinfo[3]['max_tit_academico'];
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
							if (r) {
								v =	f[i].value;
								n = f[i].name;
								info[C][n]= v ;
								
							};
						};
						if (f[i].type === 'checkbox') {

							g = angular.element(f[i]).hasClass('gay');
							if (f[i].name == 'quisiera_conocer') {
								
							};
							if (g) {
								 
								v =	f[i].value;
								n = f[i].name;
								info[C][n]= f[i].checked ;
							};

							
							
						};
						if (angular.element(f[i]).hasClass('tel1')) {
							tel = [f['tel1_tipo'].value,f['lada'].value,f['phone'].value];
							info[C]['tel'] = tel;

						};
						if (angular.element(f[i]).hasClass('tel1')) {
							tel = [f['tel2_tipo'].value,f['lada2'].value,f['phone2'].value];
							info[C]['tel2'] = tel;
						};

						
						if (f[i].name != 'confirm' && f[i].type != 'submit' && f[i].type != 'radio' && f[i].type != 'checkbox' && !angular.element(f[i]).hasClass('tel1') && !angular.element(f[i]).hasClass('tel2') ) {
							
								
								v =	f[i].value;
								n = f[i].name;
								
							if (v != "") {
								info[C][n]= v ;

							};
						};
				};
			};
				store.set('info', info);
				get = store.get('info');
			
		
			return	true;
		};
		$scope.end = function () {
			foto = $('#photo');
			ff = foto[0].files[0];
				if (ff) {
					foto.removeClass('ng-invalid');
					foto.removeClass('ng-touched');
					$('.wizard').empty();
					$('.wizard').append("<h1 class='text-center' >Gracias por tu información.</h1> <h3 class='text-center'>En las próximas 48 hrs uno de nuestros head hunters sociales se comunicará contigo para que comiences a vivir la experiencia <span class='req'>6</span> rados.</h3> <br /> <h2 class='text-center'><span class='req'>6</span> rados. Encuentros Inteligentes.</h2>");

				}else{
					alert('necesitas ingresar una foto');
					foto.addClass('ng-invalid');
					foto.addClass('ng-touched');
				};
				get = store.get('info');		
		};
		$scope.reset = function () {
			if (confirm('Estas seguro de querer reiniciar el formulario, se perderan todos los datos que has ingresado.')) {
				store.clear();
				window.location.reload(true)
			};
		}




	}]);
				