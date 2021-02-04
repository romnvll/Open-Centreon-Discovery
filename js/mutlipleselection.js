$(document).ready(function () {

    $("#selectAll").click(function () {

        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

    });

    $("#selectTpl").change(function () {
        let p = $("#selectTpl").val();
         $(".hardTpl").val(p);
        

    });

});