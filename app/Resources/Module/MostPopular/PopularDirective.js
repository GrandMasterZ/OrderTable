/**
 * Created by root on 9/19/16.
 */
angular.module('OrderTableApp')
    .directive('popularInfo', popularInfo);

function popularInfo()
{
    var directive = {
        templateUrl: 'templates/MostPopular/Popular.html',
    };

    return directive;
}