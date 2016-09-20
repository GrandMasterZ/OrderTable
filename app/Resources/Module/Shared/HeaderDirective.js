/**
 * Created by root on 9/18/16.
 */
angular.module('OrderTableApp')
    .directive('header', header)

function header()
{
    var directive = {
        templateUrl: 'templates/Shared/Header.html',
    };

    return directive;
}