/**
 * Created by Sedvis on 9/30/2016.
 */
$(document).ready(function () {
    $('#datetime').datetimepicker({
        locale: 'lt',
        minDate: moment({h:0,m:0})
    });
});