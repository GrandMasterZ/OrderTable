angular
    .module('OrderTableApp')
    .factory('restaurantData', restaurantData);

restaurantData.$inject = ['$http'];

function restaurantData($http) {

    var service = {
        getAllRestaurants: getAllRestaurants
    };

    return service;

    ////////////

    function getAllRestaurants() {
        return $http.get('/restaurants')
            .then(getRestaurantsComplete)
            .catch(getRestaurantsFailed);

        function getRestaurantsComplete(response) {
            return response.data.results;
        }

        function getRestaurantsFailed(error) {
            console.log('XHR Failed for getAvengers.' + error.data);
        }
    }

}