// Code login used ajax with jquery
$(document).ready(function () {
    $('#login').on('click', function(){
        // variable request login
        var email = $('#email').val();
        var password = $('#password').val();

        // condition from email and password
        if(email == "" || password == ""){
            alert('Pleas check your input');
        }else{
            // start ajax login
            $.ajax({
                url: 'login.php',
                method: 'POST',
                data:{
                    login: 1,
                    emailPHP: email,
                    passwordPHP: password
                },
                success: function(response) {
                    // return response
                    $('#response').html(response);
                    // condition response and redirect to page start quiz
                    if (response.indexOf('success') >= 0) {
                        window.location = 'index.php';
                    }
                },
                dataType: 'text'
            })
        }
    })
});