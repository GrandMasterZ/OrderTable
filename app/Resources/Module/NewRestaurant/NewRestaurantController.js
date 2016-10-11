/**
 * Created by root on 9/19/16.
 */
angular.module('OrderTableApp')
    .controller('NewRestaurantController', NewRestaurantController);

NewRestaurantController.$inject = ['$scope','restaurantData'];

function NewRestaurantController($scope, restaurantData)
{
    $scope.submit = function()
    {
        restaurantData.addRestaurant($scope.title, $scope.phone, $scope.email, $scope.starts, $scope.closes, $scope.address, $scope.description)
            .then(function(data){
               console.log('sadasd');
            });
    }
}