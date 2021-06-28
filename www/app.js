var table1 = document.querySelector('#table1');
var table2 = document.querySelector("#table2");
var table3 = document.querySelector("#table3");
var table4 = document.querySelector("#table4");

$(document).ready(function () {
    $(table1).DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": false,
        "searching": true,
        "info": true,
        "autoWidth": false,
    });

    $(table2).DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": false,
        "searching": true,
        "info": true,
        "autoWidth": false,
    });

    $(table3).DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": false,
        "searching": true,
        "info": true,
        "autoWidth": false,
    });
    $(table4).DataTable({
        "paging": true,
        "lengthChange": false,
        "ordering": false,
        "searching": true,
        "info": true,
        "autoWidth": false,
    });
});