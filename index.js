
$(document).ready(() => {
    $('#options :checkbox').click(function(){
        var option = $(this).attr('name');
        $('.'+option).toggle();
    });
});
