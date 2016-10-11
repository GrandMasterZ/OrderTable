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