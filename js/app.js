(function () {
	var app = angular.module('wizard', []);

	app.controller('MainCtrl', ['$scope', function ($scope) {
		this.step = 0;
		this.currStep = function (curr) {
			if (curr === 1) {
				return this.step = curr;
			};
			if (curr === 2) {
				return this.step = curr;
			};
			if (curr === 3) {
				return this.step = curr;
			};
			if (curr === 4) {
				return this.step = curr;
			};
			if (curr === 5) {
				return this.step = curr;
			};
			if (curr === 6) {
				return this.step = 6;
			};
		};
	}]);

	app.directive('cuenta', [function () {
		return {
			restrict: 'EA',
			templateUrl: 'templates/cuenta.html'
		};
	}]);
	app.directive('personal', [function () {
		return {
			restrict: 'EA',
			templateUrl: 'templates/personal.html'
		};
	}]);
	app.directive('estudios', [function () {
		return {
			restrict: 'EA',
			templateUrl: 'templates/estudios.html'
		};
	}]);
	app.directive('buscas', [function () {
		return {
			restrict: 'EA',
			templateUrl: 'templates/buscas.html'
		};
	}]);
	app.directive('membresia', [function () {
		return {
			restrict: 'EA',
			templateUrl: 'templates/membresia.html'
		};
	}]);
	app.directive('fotografia', [function () {
		return {
			restrict: 'EA',
			templateUrl: 'templates/fotografia.html'
		};
	}]);
})();