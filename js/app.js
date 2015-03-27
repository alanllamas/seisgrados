var app = angular.module('myApp', ['mgo-angular-wizard', 'ui.validate', ]);

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
		$scope.validate = function (data, id){
		    if (data) {
				validate = /^[0-9]*$/.test(data);
				$log.log(validate);
					id = $('#' + id);
					btn = $('#pers');
					if (!validate) {
						
						id.addClass('ng-invalid');
						id.addClass('ng-touched');
					}else{
						id.removeClass('ng-invalid');
						
					};
					$log.log(data, id);
				   	return validate ;

		    };
		}; 

		$scope.pass = function () {

			form =$('form');
			check = [];
			check2 = [];

			C = WizardHandler.wizard('wizard').currentStepNumber()-1;
			f = form[C];
				console.log(f.name);
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
			//	store.set('info', info);
			//	get = store.get('info');
				//console.log(get);
			
			console.log(info)
		
			return	true;
		};




	}]);
