/**
 * Created by root on 9/17/16.
 */
angular.module('OrderTableApp', ['ngRoute', 'ngFileUpload'])
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
angular.module('OrderTableApp')
        .controller('MainController', MainController);

MainController.$inject = ['restaurantData', '$scope'];

function MainController(restaurantData, $scope)
{
    activate();

    function activate() {
        return getRestaurants().then(function() {
            console.log('success')
        });
    }

    function getRestaurants() {
        return restaurantData.getAllRestaurants()
            .then(function(data) {
                $scope.restaurants = data;
                console.log($scope.restaurants);
                return $scope.restaurants;
            });
    }
}
/**
 * Created by root on 9/17/16.
 */
angular.module('OrderTableApp')
    .directive('restaurantInfo', restaurantInfo);

function restaurantInfo()
{
    var url = '/templates/Main/Restaurant.html';

    scope: {
        restaurant: '=restaurantData'
    }

    var directive = {
        templateUrl: url,
    };

    return directive;
}
/**
 * Created by root on 9/19/16.
 */
angular.module('OrderTableApp')
    .controller('PopularController', PopularController);

PopularController.$inject = ['$scope'];

function PopularController($scope)
{
    $scope.hello = 'Hello!';
}
/**
 * Created by root on 9/19/16.
 */
angular.module('OrderTableApp')
    .directive('popularInfo', popularInfo);

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
    .controller('NewRestaurantController', NewRestaurantController);

NewRestaurantController.$inject = ['$scope','restaurantData', '$location'];

function NewRestaurantController($scope, restaurantData, $location)
{
    $scope.submit = function()
    {
        restaurantData.addRestaurant($scope.title, $scope.phone, $scope.email, $scope.starts, $scope.closes, $scope.address, $scope.description, $scope.file)
            .then(function (data) {
                $location.url('/restaurant/' + data.data);
            });
    }


    $scope.deleteImage = function (f)
    {
        console.log($scope.file);
        var index = $scope.file.indexOf(f);
        $scope.file.splice(index, 1);
    };

}
angular.module('OrderTableApp')
    .controller('OneRestaurantController', OneRestaurantController);

OneRestaurantController.$inject = ['restaurantData', '$scope', '$routeParams'];

function OneRestaurantController(restaurantData, $scope, $routeParams)
{
    console.log($routeParams.Id);

    activate();

    function activate() {
        return getRestaurant().then(function() {
            console.log('success')
        });
    }

    function getRestaurant() {
        return restaurantData.getRestaurantById($routeParams.Id)
            .then(function(data) {
                $scope.restaurant = data;
                console.log($scope.restaurant);
                return $scope.restaurant;
            });
    }
}
/**
 * Created by root on 9/18/16.
 */
angular.module('OrderTableApp')
    .directive('orderInfo', orderInfo);

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
    .controller('OrdersController', OrdersController);

OrdersController.$inject = ['$scope'];

function OrdersController($scope)
{

}
/**
 * Created by root on 9/18/16.
 */
angular.module('OrderTableApp')
    .directive('header', header);

function header()
{
    var directive = {
        templateUrl: 'templates/Shared/Header.html',
    };

    return directive;
}
angular.module('OrderTableApp')
    .factory('restaurantData', restaurantData);

restaurantData.$inject = ['$http', 'Upload'];

function restaurantData($http, Upload) {

    var service = {
        getAllRestaurants: getAllRestaurants,
        getRestaurantById: getRestaurantById,
        addRestaurant: addRestaurant
    };

    return service;

    ////////////

    function getAllRestaurants() {
        return $http.get('/restaurants')
            .then(getRestaurantsComplete)
            .catch(getRestaurantsFailed);

        function getRestaurantsComplete(response) {
            return response.data;
        }

        function getRestaurantsFailed(error) {
            console.log('XHR Failed for getAvengers.' + error.data);
        }
    }

    function getRestaurantById(id)
    {
        return $http.get('/restaurant/'+id)
            .then(getRestaurantComplete)
            .catch(getRestaurantFailed);

        function getRestaurantComplete(response) {
            return response.data;
        }

        function getRestaurantFailed(error) {
            console.log('XHR Failed for getAvengers.' + error.data);
        }
    }

    function addRestaurant(title, phone, email, starts, closes, address, description, files)
    {
        console.log(title);
        var postData = {
            Title: title,
            Description: description,
            Phone: phone,
            Email: email,
            Address: address,
            WorkingHours: starts.toString()+ '-' + closes.toString()
        };

        return Upload.upload({
            url: '/postRestaurant',
            method: 'POST',
            file: files,
            data: postData
        })
    }

}