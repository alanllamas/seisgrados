var app = angular.module('myApp', ['mgo-angular-wizard', 'ui.validate' ]);

	app.controller('MainCtrl', ['$scope','WizardHandler','$log', function ($scope, WizardHandler, $log) {
		this.sexo;
		this.busco;
		info = [{},{},{},{},{}];
		this.info =  info;
			
	
			

		this.store = function  () {
			if (!store.enabled) {
				alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.')
				return
			}
		};

/*
		$scope.firstname;
		$scope.lastname;
		$scope.email;
		$scope.confirmEmail;
		$scope.password;
		$scope.confirmPassword;
		$scope.found;
		$scope.age;
		$scope.sexo;
		$scope.estatura;
		$scope.peso;
		$scope.tel1_tipo;
		$scope.lada;
		$scope.phone;
		$scope.estado;
		$scope.ciudad;
		$scope.cp;
		$scope.estadi_civil;
		$scope.r1;
		$scope.r1;
		$scope.cuantosHijos;
		$scope.tel2_tipo;
		$scope.lada2;
		$scope.phone2;
		$scope.email2;
		$scope.email2confirma;
		$scope.usuario_fb;
		$scope.usuario_twitter;
		$scope.max_tit_academico;
		$scope.institucion_educativa;
		$scope.profesion;
		$scope.actividad_laboral;
		$scope.sector;
		$scope.edad1;
		$scope.edad2;
		$scope.busco;
		$scope.busco;
		$scope.g1;
		$scope.g1;
		$scope.gay = {};
		$scope.gay.activo;
		$scope.gay.pasivo;
		$scope.gay.versatil;
		$scope.mem;
		$scope.mem;
		$scope.day1 = {};
		$scope.day1.lu;
		$scope.day1.ma;
		$scope.day1.mi;
		$scope.day1.ju;
		$scope.day1.vi;
		$scope.day1.sa;
		$scope.day1.do;
		$scope.hora_entrevista_ini1;
		$scope.hora_entrevista_fin1;
		$scope.day2 = {};
		$scope.day2.lu;
		$scope.day2.ma;
		$scope.day2.mi;
		$scope.day2.ju;
		$scope.day2.vi;
		$scope.day2.sa;
		$scope.day2.do;
		$scope.hora_entrevista_ini2;
		$scope.hora_entrevista_fin2;
		$scope.photo;
		getInfo = store.get('info');
		for (var i = 0; i < getInfo.length; i++) {
			if (getInfo[i] && getInfo[i] != "") {
				info[i] = getInfo[i];




					$scope.firstname = info[i].firstname;
					$scope.lastname;
					$scope.email;
					$scope.confirmEmail;
					$scope.password;
					$scope.confirmPassword;
					$scope.found;
					$scope.age;
					$scope.sexo;
					$scope.estatura;
					$scope.peso;
					$scope.tel1_tipo;
					$scope.lada;
					$scope.phone;
					$scope.estado;
					$scope.ciudad;
					$scope.cp;
					$scope.estadi_civil;
					$scope.r1;
					$scope.r1;
					$scope.cuantosHijos;
					$scope.tel2_tipo;
					$scope.lada2;
					$scope.phone2;
					$scope.email2;
					$scope.email2confirma;
					$scope.usuario_fb;
					$scope.usuario_twitter;
					$scope.max_tit_academico;
					$scope.institucion_educativa;
					$scope.profesion;
					$scope.actividad_laboral;
					$scope.sector;
					$scope.edad1;
					$scope.edad2;
					$scope.busco;
					$scope.busco;
					$scope.g1;
					$scope.g1;
					$scope.gay = {};
					$scope.gay.activo;
					$scope.gay.pasivo;
					$scope.gay.versatil;
					$scope.mem;
					$scope.mem;
					$scope.day1 = {};
					$scope.day1.lu;
					$scope.day1.ma;
					$scope.day1.mi;
					$scope.day1.ju;
					$scope.day1.vi;
					$scope.day1.sa;
					$scope.day1.do;
					$scope.hora_entrevista_ini1;
					$scope.hora_entrevista_fin1;
					$scope.day2 = {};
					$scope.day2.lu;
					$scope.day2.ma;
					$scope.day2.mi;
					$scope.day2.ju;
					$scope.day2.vi;
					$scope.day2.sa;
					$scope.day2.do;
					$scope.hora_entrevista_ini2;
					$scope.hora_entrevista_fin2;
					$scope.photo;

				$log.log('info descargado de store:',  info[i]);
			};
		};
*/

		//$('.datepicker').datepicker(); $( ".datepicker" ).datepicker({altFormat: "yy-mm-dd"});
	





		$scope.pass = function () {

			form =$('form');
			check = [];
			check2 = [];

			C = WizardHandler.wizard('wizard').currentStepNumber()-1;
			f = form[C];
				console.log(f.name);
			if (f.name != "foto") {

							$('.datepicker').datepicker();
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
							if (g) {
								 
								v =	f[i].value;
								n = f[i].name;
								info[C][v]= f[i].checked ;
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
											D1.addClass('ng-untouched');
										
										D1.removeClass('ng-touched');
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
								info[C][n]= v ;

							if (f[i].value != "") {
							};

						};
				
							 
					
				};
			};
				store.set('info', info);
		
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
				$log.log(get);
				$log.log(info);
				$log.log(ff);
		};




	}]);
