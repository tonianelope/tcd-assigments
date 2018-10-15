
$(document).ready(() => {

    $('#options :checkbox').on('change',function(){
        $('.'+this.name).toggle();
    });

    $('#modes :checkbox').change(function() {
        $(this).siblings('#modes :checkbox').prop('checked', false);
        var options = this.value.split(' ');
        $('#options :checkbox').prop('checked', false);
        $('tr').hide();
        if(this.checked){
            $("input[name*="+options.join('],[name=')+"]").prop('checked',true);
            $('.'+options.join(',.')).show();
        }
    });
});
