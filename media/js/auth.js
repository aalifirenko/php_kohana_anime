$(document).ready(function(){

    $('#top-register-btn').live("click", function(e){
        e.preventDefault();
        var email_field = $('#top-validate-email');
        var password_filed = $('#top-validate-password');
        var repeat_field = $('#top-validate-repeat');
        var nick_field = $('#top-validate-nick');

        if (email_field.val() != '' && password_filed.val() != '' && repeat_field.val() != '' && nick_field.val() != '') {
            $('.top-register-errors').html("").hide();
            if (password_filed.val().length >= 6) {
                if (password_filed.val() == repeat_field.val()) {
                    if (validateEmail(email_field.val())) {
                        $.post(
                            window.baseUrl + 'auth/checkEmail',
                            {
                                email: email_field.val()
                            },
                            function(response) {
                                if (response == 0) {
                                    if ($('#check_robot').is(':checked')) {
                                        $.post(
                                            window.baseUrl + 'auth/register',
                                            {
                                                email: email_field.val(),
                                                password: password_filed.val(),
                                                confirm_password: repeat_field.val(),
                                                nick: nick_field.val(),
                                                check_robot: "on"
                                            },
                                            function() {
                                                window.location.reload();
                                            }
                                        );
                                    } else
                                        $('.top-register-errors').html("Извините, роботов мы не обслуживаем").show();
                                } else {
                                    $('.top-register-errors').html("Извините, email уже занят").show();
                                }
                            }
                        );
                    } else
                        $('.top-register-errors').html("Введите правильный email").show();
                } else
                $('.top-register-errors').html("Пароли не совпадают!").show();
            } else {
                $('.top-register-errors').html("Пароль должен быть не менее 6 символов").show();
            }
        } else {
            $('.top-register-errors').html("Заполните все данные!").show();
        }
    });

    $('.action-login').live('click', function(){
        var email_field = $('#login-email-field');
        var password_field = $('#login-password-field');

        if (email_field.val() != '' && password_field.val() != '') {
            $('.top-login-errors').html("").hide();

            $.post(
                window.baseUrl + 'auth/login',
                {
                    email: email_field.val(),
                    password: password_field.val(),
                    rememberme: $('#top-login-rememberme').is(':checked')
                },
                function(response) {
                    if (response == 'success')
                        window.location.reload();
                    else {
                        $('.top-login-errors').html("логин или пароль неверный!").show();
                    }
                }
            );
        } else {
            $('.top-login-errors').html("Введите все данные!").show();
        }
    });

    function validateEmail(email)
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

});