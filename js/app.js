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
			$log.log('hay info')
			$log.log(getinfo)

			//se obtienen datos del primer objeto/forma
			$scope.firstname = getinfo[0]['firstname'];
			$scope.secondname = getinfo[0]['secondname'];
			$scope.lastname1 = getinfo[0]['lastname1'];
			$scope.lastname2 = getinfo[0]['lastname2'];
			$scope.email = getinfo[0]['email'];
			$scope.confirmEmail = getinfo[0]['email'];
			$scope.password = getinfo[0]['password'];
			$scope.confirmPassword = getinfo[0]['password'];
			$scope.found = getinfo[0]['found'];
			$scope.PromoCode = getinfo[0]['PromoCode'];

			//se obtienen datos del segundo objeto/forma
			$scope.date = getinfo[1]['datepicker'];
			$scope.main.sexo = getinfo[1]['sexo'];
			$scope.estatura = getinfo[1]['estatura'];
			$scope.peso = getinfo[1]['peso'];
			if (getinfo[1]['tel']) {
				$scope.tel1_tipo = getinfo[1]['tel'][0];
				$scope.lada = getinfo[1]['tel'][1];
				$scope.phone = getinfo[1]['tel'][2];
			};
			$scope.estado = getinfo[1]['estado'];
			$scope.ciudad = getinfo[1]['ciudad'];
			$scope.cp = getinfo[1]['cp'];
			$scope.estadi_civil = getinfo[1]['estadi_civil'];
			$scope.hijos = getinfo[1]['posesion_hijos'];
			if ( getinfo[1]['tel2']) {
				$scope.tel2_tipo = getinfo[1]['tel2'][0];
				$scope.lada2 = getinfo[1]['tel2'][1];
				$scope.phone2 = getinfo[1]['tel2'][2];
			};
			$scope.email2 = getinfo[1]['email2'];
			$scope.email2confirma = getinfo[1]['email2'];
			$scope.usuario_fb = getinfo[1]['usuario_fb'];
			$scope.usuario_twitter = getinfo[1]['usuario_twitter'];
			
			//se obtienen datos del tercer objeto/forma
			$scope.max_tit_academico = getinfo[2]['max_tit_academico'];
			$scope.profesion = getinfo[2]['profesion'];
			$scope.sector = getinfo[2]['sector'];
			
			//se obtienen datos del cuarto objeto/forma
			$scope.edad1 = getinfo[3]['edad1'];
			$scope.edad2 = getinfo[3]['edad2'];
			$scope.main.busco = getinfo[3]['quisiera_conocer']
			if ( getinfo[3]['busco_gay_activo']) {
			$scope.gay1 = getinfo[3]['busco_gay_activo'];
				console.log($scope.gay1);
			};
			if ( getinfo[3]['busco_gay_pasivo']) {
				$scope.gay2 = getinfo[3]['busco_gay_pasivo'];
				console.log($scope.gay2);
			};
			if ( getinfo[3]['busco_gay_versatil']) {
				$scope.gay3 = getinfo[3]['busco_gay_versatil'];
				console.log($scope.gay3);
			};

			//se obtienen datos del quinto objeto/forma
			$scope.mem = getinfo[4]['tipo_membresia'];
				$scope.day1lu = getinfo[4]['Lunes,1'];
				$scope.day1ma = getinfo[4]['Martes,1'];
				$scope.day1mi = getinfo[4]['Miércoles,1'];
				$scope.day1ju = getinfo[4]['Jueves,1'];
				$scope.day1vi = getinfo[4]['Viernes,1'];
				$scope.day1sa = getinfo[4]['Sábado,1'];
				$scope.day1do = getinfo[4]['Domingo,1'];
			$scope.hora_entrevista_ini1 = getinfo[4]['hora_entrevista_ini1'];
			$scope.hora_entrevista_fin1 = getinfo[4]['hora_entrevista_fin1'];
				$scope.day2lu = getinfo[4]['Lunes,2'];
				$scope.day2ma = getinfo[4]['Martes,2'];
				$scope.day2mi = getinfo[4]['Miércoles,2'];
				$scope.day2ju = getinfo[4]['Jueves,2'];
				$scope.day2vi = getinfo[4]['Viernes,2'];
				$scope.day2sa = getinfo[4]['Sábado,2'];
				$scope.day2do = getinfo[4]['Domingo,2'];
			$scope.hora_entrevista_ini2 = getinfo[4]['hora_entrevista_ini2'];
			$scope.hora_entrevista_fin2 = getinfo[4]['hora_entrevista_fin2'];

		};
		json = JSON.stringify(info,undefined,6);
		
		$scope.pass = function () {

			form =$('form');
			check = [];
			check2 = [];
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
				$log.log(C)
				body.setAttribute('style', 'background:gray ' + urls[C] + 'fixed;-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover; '
				);
				//background = 'gray ' + urls[C] + 'fixed';
				$log.log(urls[C])
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
								$log.log(f[i])
							};
							if (g) {
								 
								v =	f[i].value;
								n = f[i].name;
								info[C][n]= f[i].checked ;
							};

							
							d1 = angular.element(f[i]).hasClass('day1');
							D1 = $('.day1');
							if (d1) {
								if (f[i].checked) {
									check.push(1);
								}else{
									check.push(0);
								};
									v =	f[i].value;
									n = f[i].name;
									if (check.length == 7 && check.indexOf(1) == -1) {
										D1.addClass('ng-invalid');
										D1.addClass('ng-touched');

										D1.removeClass('ng-valid');
										D1.removeClass('ng-untouched');
										return false;
									}else{
										D1.addClass('ng-valid');
										

										D1.removeClass('ng-invalid');
									};
								info[C][v + "1"]= f[i].checked ;
							};


							d2 = angular.element(f[i]).hasClass('day2');
							D2 = $('.day2');
							if (d2) {
								if (f[i].checked) {
									check2.push(1);
								}else{
									check2.push(0);
								};
									v =	f[i].value;
									n = f[i].name;
									if (check2.length == 7 && check2.indexOf(1) == -1) {
										D2.addClass('ng-invalid');
										D2.addClass('ng-touched');

										D2.removeClass('ng-valid');
										D2.removeClass('ng-untouched');
										return false;
									}else{
										D2.addClass('ng-valid');
										D2.removeClass('ng-invalid');
									};
								info[C][v + "2"]= f[i].checked ;
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
			
			console.log(info)
		
			return	true;
		};
		$scope.end = function () {
			foto = $('#photo');
			ff = foto[0].files[0];
				if (ff) {
					alert('has terminado el wizard');
					foto.removeClass('ng-invalid');
					foto.removeClass('ng-touched');
				}else{
					alert('necesitas ingresar una foto');
					foto.addClass('ng-invalid');
					foto.addClass('ng-touched');
				};
				get = store.get('info');
				$log.log(ff);
		};




	}]);
