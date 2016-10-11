/**
 * Created by root on 9/17/16.
 */
angular.module('OrderTableApp')
    .directive('restaurantInfo', restaurantInfo);

function restaurantInfo()
{
    var url = '/templates/Main/Restaurant.html';

    scope: {
        restaurant: '=restaurantData'
    }

    var directive = {
        templateUrl: url,
    };

    return directive;
}