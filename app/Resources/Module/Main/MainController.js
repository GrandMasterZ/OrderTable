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