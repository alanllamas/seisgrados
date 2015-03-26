var app = angular.module('myApp', ['mgo-angular-wizard', 'ui.validate', ]);

	app.controller('MainCtrl', ['$scope','WizardHandler','$log', function ($scope, WizardHandler, $log) {
		this.sexo;
		this.busco;

			info = [];
			
		this.store = function  () {
			if (!store.enabled) {
				alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.')
				return
			}
		};
	/*
		$scope.validate = function (data, id){
		    if (data) {
				validate = /^[0-9]*$/.test(data);
				$log.log(validate);
					id = $('#' + id)
					$log.log(data, id);
				   	return validate ;

		    };
		}; 
			 <!--
	    $scope.validate = function (evt){
	         var charCode = (evt.which) ? evt.which : event.keyCode
	         if (charCode > 31 && (charCode < 48 || charCode > 57))
	            return false;

	         return true;
	      }
	      //-->
		*/
		$scope.pass = function () {

			form =$('form');

			C = WizardHandler.wizard('wizard').currentStepNumber()-1;
			f = form[C];
			function Arr (f) {
				F = {
					f : {}
				};
				return F; 
			};
			Arr(f);

			for (var i = 0; i < f.length; i++) {
			

					if (f[i].type === 'radio') {
						r = angular.element(f[i]).hasClass('ng-valid-parse');
						if (r) {
							if (indexOf(f.name) == -1) {
								F.push(f[i].value);
							};
							
						};
					};
					if (f[i].type === 'checkbox') {

						g = angular.element(f[i]).hasClass('gay');
						if (g && f[i].checked) {
							 
							if (indexOf(f.name) == -1) {
								F.push(f[i].value);
							};
						};

						
						d1 = angular.element(f[i]).hasClass('day1');
						if (d1 && f[i].checked) {
							if (indexOf(f.name) == -1) {
								F.push(f[i].value);
							};
						};


						d2 = angular.element(f[i]).hasClass('day2');
						if (d2 && f[i].checked) {
							if (indexOf(f.name) == -1) {
								F.push(f[i].value);
							};
						};
					};
					if (f[i].name != 'confirm' && f[i].type != 'submit' && f[i].type != 'radio' && f[i].type != 'checkbox' ) {
						
							if (indexOf(f.name) == -1) {
								F.push(f[i].value);
							};


						if (f[i].value != "") {
						};

					};
			
						 
				
			};
				console.log(F);
			if (C === 4) {

				get = store.getAll();
				info.push(get);
				console.log(info);
			};
			return	true;
		};




	}]);
