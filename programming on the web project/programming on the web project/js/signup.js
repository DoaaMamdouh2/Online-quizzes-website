// code sign up ajax with jquery
$(document).ready(function() {
    $('#signup').on('click', function() {
        // variable request signup
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();


        
        // condition from requests
        if(first_name!="" && last_name!="" && email!="" && password!=""){
            // start ajax signup
            $.ajax({
                url: "signup.php",
                type: "POST",
                data: {
                    signup: 1,
                    f_name: first_name,
                    l_name: last_name,
                    email: email,
                    password: password,
                    confirm_password:confirm_password				
                },
                success: function(response){
                    // return response
                    $('#response').html(response);
                    
                    // condition response and redirect to page start quiz
                    if (response.indexOf('success') >= 0) {
                        window.location = 'index.php';
                    }
                },
                dataType: 'text'
               
            });
		}
		else{
            // condition from requests the empty
			alert('Please fill all the field !');
		}

    });
});