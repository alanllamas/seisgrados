var app = angular.module('myApp', ['mgo-angular-wizard']);

	app.controller('MainCtrl', ['$scope','WizardHandler', function ($scope, WizardHandler) {
			

		$scope.pass = function () {
			
			for (var i = 0; i < cuenta.length; i++) {
				if (cuenta[i].type != 'submit') {

					console.log(cuenta[i].type)
				};
			};



			return true; 
			
		};



	}]);
