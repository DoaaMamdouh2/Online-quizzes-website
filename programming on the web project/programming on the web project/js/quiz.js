// code control in time used javascript

// variables time
var minutesLabel = document.getElementById("minutes");
var secondsLabel = document.getElementById("seconds");
var totalSeconds = 0;

// count time
setInterval(setTime, 1000);

// function count setTime
function setTime() {
    ++totalSeconds;
    secondsLabel.innerHTML = pad(totalSeconds % 60);
    minutesLabel.innerHTML = pad(parseInt(totalSeconds / 60));

    // condition stop count time 30 seconds
    if ( minutesLabel.innerHTML == 20) {
        document.getElementById("submit").click(); // Click on the submit
    }
}

// function count
function pad(val) {
    var valString = val + "";
    if (valString.length < 2) {
        return "0" + valString;
    } else {
        return valString;
    }
}

// code insert used Ajax 
$('.submit').on('click', function(){
    var end_date = $('.start_date').val();
    var number_correct_answers = $('.number_correct_answers').val();
    $('.submit').attr('hidden', 'hidden');
})