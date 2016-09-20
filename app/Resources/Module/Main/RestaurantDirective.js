/**
 * Created by root on 9/17/16.
 */
angular.module('OrderTableApp')
    .directive('restaurantInfo', restaurantInfo)

function restaurantInfo()
{
    var directive = {
        templateUrl: 'templates/Main/Restaurant.html',
    };

    return directive;
}