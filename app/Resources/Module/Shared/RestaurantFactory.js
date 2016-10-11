angular.module('OrderTableApp')
    .factory('restaurantData', restaurantData);

restaurantData.$inject = ['$http'];

function restaurantData($http) {

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

    function addRestaurant(title, phone, email, starts, closes, address, description)
    {
        var postData = {
            Title: title,
            Description: description,
            Phone: phone,
            Email: email,
            Address: address,
            WorkingHours: starts+closes
        };

        return $http.post('postRestaurant', postData)
            .then(getPostComplete)
            .catch(getPostFailed);

        function getPostComplete(response) {
            return response.data;
        }

        function getPostFailed(error) {
            console.log('XHR Failed for getAvengers.' + error.data);
        }
    }

}