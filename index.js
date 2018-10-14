
$(document).ready(() => {
    $('#options :checkbox').click(function(){
        var option = $(this).attr('name');
        $('.'+option).toggle();
    });

    $('#modes :checkbox').on('change', function() {
        $(this).siblings('#modes :checkbox').prop('checked', false);
    });

});
