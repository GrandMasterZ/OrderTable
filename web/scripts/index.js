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
        });
/**
 * Created by root on 9/17/16.
 */
angular.module('OrderTableApp')
        .controller('MainController', MainController)

MainController.$inject = ['$scope'];

function MainController($scope)
{
    $scope.hello = 'Hello!';
}
/**
 * Created by root on 9/17/16.
 */
angular.module('OrderTableApp')
    .directive('restaurantInfo', restaurantInfo)

function restaurantInfo()
{
    var directive = {
        templateUrl: 'templates/Main/Restaurant.html',
    };

    return directive;
}
/**
 * Created by root on 9/19/16.
 */
angular.module('OrderTableApp')
    .controller('PopularController', PopularController)

PopularController.$inject = ['$scope'];

function PopularController($scope)
{
    $scope.hello = 'Hello!';
}
/**
 * Created by root on 9/19/16.
 */
angular.module('OrderTableApp')
    .directive('popularInfo', popularInfo)

function popularInfo()
{
    var directive = {
        templateUrl: 'templates/MostPopular/Popular.html',
    };

    return directive;
}
/**
 * Created by root on 9/19/16.
 */
angular.module('OrderTableApp')
    .controller('NewRestaurantController', NewRestaurantController)

NewRestaurantController.$inject = ['$scope'];

function NewRestaurantController($scope)
{
    $scope.hello = 'Hello!';
}
/**
 * Created by root on 9/18/16.
 */
angular.module('OrderTableApp')
    .directive('orderInfo', orderInfo)

function orderInfo()
{
    var directive = {
        templateUrl: 'templates/Orders/Order.html',
    };

    return directive;
}
/**
 * Created by root on 9/18/16.
 */
angular.module('OrderTableApp')
    .controller('OrdersController', OrdersController)

MainController.$inject = ['$scope'];

function OrdersController($scope)
{

}
/**
 * Created by root on 9/18/16.
 */
angular.module('OrderTableApp')
    .directive('header', header)

function header()
{
    var directive = {
        templateUrl: 'templates/Shared/Header.html',
    };

    return directive;
}