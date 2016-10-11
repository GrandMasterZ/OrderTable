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