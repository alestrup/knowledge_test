$(document).ready(function(){
    $("#login_form").submit(function(event){
        event.preventDefault();
        $('#login_error').addClass('d-none');
        var inputs = $(this).find("input");

        var data = {
            "email" : $('#email').val(),
            "password" : $('#password').val(),
            "remember" : $("#remember").is(":checked") == true ? 1 : 0 
        }

        inputs.prop("disabled", true);

        request = $.ajax({
            url: api_url + "auth",
            type: "POST",
            data: JSON.stringify(data),
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
        }).done(function(response){
            $.cookie('session', JSON.stringify(response.session));
            location.href = 'list.html';
        }).fail(function(){
            $('#login_error').removeClass('d-none');
        }).always(function () {
            // Reenable the inputs
            inputs.prop("disabled", false);
        });;
    });
})