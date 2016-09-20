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