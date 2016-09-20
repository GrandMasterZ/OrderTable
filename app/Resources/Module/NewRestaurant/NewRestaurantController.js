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