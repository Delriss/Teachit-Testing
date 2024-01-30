$('.tests-carousel').flickity({});
var $testsCarousel = $('.tests-carousel').flickity();

//When the Form is submitted
$("#submitForm").click(function(e) {
    e.preventDefault();

    //Get the test title from the form
    var testTitle = $("#testName").val();
    //Get array of question texts from the form
    var questionText = [
        //FIX More questions should be added here when dynamic form is implemented 
        $("#questionName").val()
        ];

    //Get array of answers from the form
    var answerText = [
        $("#answer1").val(),
        $("#answer2").val(),
        $("#answer3").val(),
        $("#answer4").val()
        ];

    //which answer is correct
    var correctAnswer = 0;
    if($("#answerRadio1").is(":checked")) {
        correctAnswer = 0;
    } else if($("#answerRadio2").is(":checked")) {
        correctAnswer = 1;
    } else if($("#answerRadio3").is(":checked")) {
        correctAnswer = 2;
    } else if($("#answerRadio4").is(":checked")) {
        correctAnswer = 3;
    }

    //Create the test in the database
    $.ajax({
        url: "/php/createTest.php",
        type: "POST",
        data: {
            testTitle: testTitle,
            questionText: questionText,
            answerText: answerText,
            correctAnswer: correctAnswer
        },
        success: function() {
            updateTestCarousel();
        },
        error: function() {
            //Swal.fire("Error", "There was an error creating the test", "error");
        }
    });
});

//When Delete Test button is clicked, delete the test from the database, update the DOM asynchronously so it reflects the change
$(document).on("click", ".deleteTestButton", function(){
    var thisObject = this
    var id = this.id;

    $.ajax({
        type: "POST",
        url: "/php/deleteTest.php",
        data: {
            testID: id
        },
        success: function() {
            updateTestCarousel();
        },
        error: function() {
            //Swal.fire("Error", "There was an error deleteing the test", "error");
        }
    });
});

//create a function to update the test carousel
function updateTestCarousel() {
    $.ajax({
        type: "POST",
        url: "/php/outputTests.php",
        dataType: 'html',

        success: function(data) {
          var newState = $.trim(data);
          //destroy current flickity carousel, change elements of cards, then rebuild flickity afterwards with new values
          $testsCarousel.flickity('destroy');
          $('#tests').html(newState);
          $testsCarousel.flickity();
          //$('#Modal').modal('hide');
        },
        error: function() {
            //Swal.fire("Error", "There was an error Updating the test Carousel", "error");
        }
  });
}