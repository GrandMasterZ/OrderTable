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