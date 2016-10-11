/**
 * Created by root on 9/17/16.
 */
angular.module('OrderTableApp', ['ngRoute'])
        .config(function($routeProvider){
            $routeProvider
            .when('/', {
                controller: 'MainController',
                templateUrl: 'templates/Main/Main.html',
            })
            .when('/orders', {
                controller: 'OrdersController',
                templateUrl: 'templates/Orders/Orders.html',
            })
            .when('/popular', {
                controller: 'PopularController',
                templateUrl: 'templates/MostPopular/Populars.html'
            })
            .when('/newRestaurant', {
                controller: 'NewRestaurantController',
                templateUrl: 'templates/NewRestaurant/Form.html'
            })
            .when('/restaurant/:Id', {
                controller: 'OneRestaurantController',
                templateUrl: 'templates/OneRestaurant/OneRestaurant.html'
            })
        });