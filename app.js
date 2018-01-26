var mainApp = angular.module("mainApp", ['ngRoute']);
         mainApp.config(['$routeProvider', function($routeProvider) {
            $routeProvider.
            
            when('/home', {
               templateUrl: 'home.htm',
               controller: 'HomeController'
            }).
            
            when('/game/:name/:id', {
               templateUrl: 'game.htm',
               controller: 'GameController'
            }).
			when('/play/:id', {
               templateUrl: 'play.htm',
               controller: 'PlayController'
            }).
            
            when('/category/:category', {
               templateUrl: 'category.htm',
               controller: 'CategoryController'
            }).
            
	   when('/categories', {
               templateUrl: 'categories.htm',
               controller: 'CategoriesController'
            }).

            when('/search/:query', {
               templateUrl: 'search.htm',
               controller: 'SearchController'
            }).

            otherwise({
               redirectTo: '/home'
            });
         }]);
		 
		 mainApp.service('Games', function() {
			this.data ="";
			this.set = function (x) {
				this.data = x;
				return this.data;
			}
			this.get = function () {
				return this.data
			}
		});
		 
         	 mainApp.controller('HomeController', ['$scope', '$http', 'Games', function($scope, $http, Games) {
			
			
			

			$scope.recent = false;
			$scope.viewed = true;	
						
			$scope.sortType = "views";
			var url = 'http://arcade.gurminderboparai.com/api.php/gamesAll/75/1/'+$scope.sortType;
			$http.get(url).success( function(response) {
				$scope.games = response;
				Games.set(response);
			});
			$scope.page = 1;
			$scope.load = function(){
				$scope.page = $scope.page+1;
				var url = 'http://arcade.gurminderboparai.com/api.php/gamesAll/75/'+$scope.page+'/'+$scope.sortType;
				$http.get(url).success( function(response) {
					$scope.games = $scope.games.concat(response); 
					Games.set($scope.games);
				}); 
			} 
			$scope.sortName = function(){
				$scope.page = 1;
				$scope.sortType = "title";
				var url = 'http://arcade.gurminderboparai.com/api.php/gamesAll/75/'+$scope.page+'/'+$scope.sortType;
				$http.get(url).success( function(response) {
					$scope.games = response; 
					Games.set($scope.games);
				}); 
			}
			$scope.sortRecent = function(){
				$scope.recent = true;
				$scope.viewed = false;
				$scope.page = 1;
				$scope.sortType = "id";
				var url = 'http://arcade.gurminderboparai.com/api.php/gamesAll/75/'+$scope.page+'/'+$scope.sortType;
				$http.get(url).success( function(response) {
					$scope.games = response; 
					Games.set($scope.games);
				}); 
			}
			$scope.sortViewed = function(){
				$scope.recent = false;
				$scope.viewed = true;
				$scope.page = 1;
				$scope.sortType = "views";
				var url = 'http://arcade.gurminderboparai.com/api.php/gamesAll/75/'+$scope.page+'/'+$scope.sortType;
				$http.get(url).success( function(response) {
					$scope.games = response; 
					Games.set($scope.games);
				}); 
			}
			
		 }]);
		 
        	 mainApp.controller('GameController', ['$scope', '$routeParams','$http', function($scope, $routeParams, $http) {
			 
			var url = 'http://arcade.gurminderboparai.com/api.php/game/'+$routeParams.id
			$http.get(url).success( function(response) {
				$scope.title = response[0].title;
				$scope.description = response[0].description;
				$scope.id = response[0].id;
				$scope.category = response[0].catagory;
				$scope.thumbnail = response[0].thumbnail;
			}); 
		   
		 }]);
		 mainApp.controller('PlayController', ['$scope', '$routeParams', '$http','$sce', function($scope, $routeParams, $http, $sce) {
			var url = 'http://arcade.gurminderboparai.com/api.php/game/'+$routeParams.id;
			var url2 = 'http://arcade.gurminderboparai.com/api.php/increment/view/'+$routeParams.id;
			$http.put(url2).success( function(response) {
			});
			$http.get(url).success( function(response) {
					$scope.link = $sce.trustAsResourceUrl( response[0].url);
					$scope.game = response[0];				
			}); 
		 }]);

         	mainApp.controller('CategoryController', ['$scope', '$routeParams', '$http', function($scope, $routeParams, $http) {
			$scope.recent = false;
			$scope.viewed = true;	
			
			$scope.sortType = "views";
			$scope.category = $routeParams.category;			
			var url = 'http://arcade.gurminderboparai.com/api.php/gamesCategory/75/1/'+$scope.sortType+'/'+$routeParams.category;
			$http.get(url).success( function(response) {
						$scope.games = response; 
			});
			$scope.page = 1;
			$scope.load = function(){
				$scope.page = $scope.page+1;
				var url = 'http://arcade.gurminderboparai.com/api.php/gamesCategory/75/'+$scope.page+'/'+$scope.sortType+'/'+$routeParams.category;
				$http.get(url).success( function(response) {
					$scope.games = $scope.games.concat(response); 
				}); 
			}

			$scope.sortRecent = function(){
				$scope.recent = true;
				$scope.viewed = false;
				$scope.page = 1;
				$scope.sortType = "id";
				var url = 'http://arcade.gurminderboparai.com/api.php/gamesCategory/75/'+$scope.page+'/'+$scope.sortType+'/'+$routeParams.category;
				$http.get(url).success( function(response) {
					$scope.games = response; 
					Games.set($scope.games);
				}); 
			}
			$scope.sortViewed = function(){
				$scope.recent = false;
				$scope.viewed = true;
				$scope.page = 1;
				$scope.sortType = "views";
				var url = 'http://arcade.gurminderboparai.com/api.php/gamesCategory/75/'+$scope.page+'/'+$scope.sortType+'/'+$routeParams.category;	
				$http.get(url).success( function(response) {
					$scope.games = response; 
					Games.set($scope.games);
				}); 
			}
			
		 }]);
		 
		mainApp.controller('SearchController', ['$scope', '$routeParams','$http', function($scope, $routeParams, $http) {
			
			var url = 'http://arcadechameleon.com/api.php/search/'+$routeParams.query;
			$http.get(url).success( function(response) {
				$scope.games = response;
				Games.set(response);
			});
			
		 }]);
		
		mainApp.controller('CategoriesController', ['$scope', '$routeParams','$http', function($scope, $routeParams, $http) {
			
			var url = 'http://arcade.gurminderboparai.com/api.php/category/sdfasdf';
			$http.get(url).success( function(response) {
				$scope.games = response;
			});
	

		 }]);
		(function (ng) {
				  'use strict';

				  var app = ng.module('ngLoadScript', []);

				  app.directive('script', function() {
					return {
					  restrict: 'E',
					  scope: false,
					  link: function(scope, elem, attr) {
						if (attr.type === 'text/javascript-lazy') {
						  var code = elem.text();
						  var f = new Function(code);
						  f();
						}
					  }
					};
				  });

				}(angular));	