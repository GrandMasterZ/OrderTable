/**
 * Created by root on 9/18/16.
 */
angular.module('OrderTableApp')
    .directive('orderInfo', orderInfo);

function orderInfo()
{
    var directive = {
        templateUrl: 'templates/Orders/Order.html',
    };

    return directive;
}