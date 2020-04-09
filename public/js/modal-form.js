$('#modelForm').submit(function(event){
    event.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        method: 'post',
        data: $(this).serialize(),
        success: function(result){
            $('#response').removeAttr('class');
            $('#response').addClass('alert alert-'+result.type);
            $('#response').html(result.message);
            if(result.type == 'success'){
                setTimeout(function() {
                    $('#defaultModal').modal('hide');
                }, 3000);
                location.reload();
            }
        },
        error: function( json )
        {
            var errors = json.responseJSON.errors;
            if(json.status === 422) {
                $.each(errors, function (key, value) {
                    $('#'+key+'_error').html(value);
                    $('#'+key+'_error').closest('.invalid-feedback').css('display','block');
                });
            }
        }
    });
});
