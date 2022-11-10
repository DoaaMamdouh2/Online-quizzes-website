// Code start quiz used ajax with jquery
$(document).ready(function () {
    $('.choose').on('click', function(){
        // variable request start quiz
        var i = 1;
        var userid = $('.userId').val();
        var examId = $('.examId').val();

        // start ajax start quiz
        $.ajax({
            url: 'start_quiz.php',
            method: 'POST',
            data:{
                choose: 1,
                userIdPHP: userid,
                examIdPHP: examId
            },
            success: function(response) {
                // return response
                $('#response').html(response);

                // condition response and redirect to page start quiz
                if (response.indexOf('success') >= 0) {
                    window.location = 'quiz.php';
                }
            },
            dataType: 'text'
        })
    })
});