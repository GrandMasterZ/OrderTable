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