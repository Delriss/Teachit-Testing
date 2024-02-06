$('.tests-carousel').flickity({});
var $testsCarousel = $('.tests-carousel').flickity();

//when the modal is hidden, reset the form
$(document).on('hidden.bs.modal', '#createTestModal', function() {
    $("#createTestForm").trigger("reset");
    $("#testNameLabel").text("Create Test");
});

//function for validating the form
function validateForm(form) {
    form.validate({
        rules: {
            testName: {
                required: true,
                minlength: 3
            },
            questionName: {
                required: true,
                minlength: 3
            },
            answer1: {
                required: true,
                minlength: 1
            },
            answer2: {
                required: true,
                minlength: 1
            },
            answer3: {
                required: true,
                minlength: 1
            },
            answer4: {
                required: true,
                minlength: 1
            }
        },
        messages: {
            testName: {
                required: "Please enter a test name",
                minlength: "Test name must be at least 3 characters long"
            },
            questionName: {
                required: "Please enter a question",
                minlength: "Question must be at least 3 characters long"
            },
            answer1: {
                required: "Please enter an answer",
                minlength: "Answer must be at least 1 character long"
            },
            answer2: {
                required: "Please enter an answer",
                minlength: "Answer must be at least 1 character long"
            },
            answer3: {
                required: "Please enter an answer",
                minlength: "Answer must be at least 1 character long"
            },
            answer4: {
                required: "Please enter an answer",
                minlength: "Answer must be at least 1 character long"
            }
        }
    });
    //return true if the form is valid, false if it is not
    return form.valid();
}

//When the Form is submitted
$("#submitForm").click(function(e) {
    e.preventDefault();

    //validate the form
    var form = $("#createTestForm");

    //If the form is not valid, do nothing
    if(validateForm(form) === false) {
        return;
    }

    //If the form is valid, continue
    else{

        //if the test is being edited
        if ($("#createTestForm").attr("data-mode") === "edit") {
            // Editing an existing test
            // Add your code here
        } 
        
        else {
            //We are creating a new test

            //Get the test title from the form
            var testTitle = $("#testName").val();
            //Get array of question texts from the form
            var questionText = [
                //FIX More questions should be added here when dynamic form is implemented 
                $("#questionName").val()
                ];

            //Get array of answers from the form
            var answerText = [
                //FIX varied numbers of answers should be added here when dynamic form is implemented
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
                    //close modal
                    $('#createTestModal').modal('hide');
                    //fire success message
                    Swal.fire("Success", "Test Created Successfully", "success");
                },
                error: function() {
                    Swal.fire("Error", "There was an error creating the test", "error");
                }
            });
        }
    }


});

//When Delete Test button is clicked, delete the test from the database, update the DOM asynchronously so it reflects the change
$(document).on("click", ".deleteTestButton", function() {
    //Ask the user if they are sure they want to delete the test using sweetalert
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to recover this Test!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, Delete',
        reverseButtons: true
    }).then((result) => {
        //If the user confirms they want to delete the test
        if (result.isConfirmed) {
            //Get the test id from the button
            var thisObject = this;
            var id = this.id;

            //Delete the test from the database
            $.ajax({
                type: "POST",
                url: "/php/deleteTest.php",
                data: {
                    testID: id
                },
                success: function() {
                    //Update the DOM asynchronously so it reflects the change
                    updateTestCarousel();
                    //fire success message
                    Swal.fire("Success", "Test Deleted Successfully", "success");
                },
                error: function() {
                    Swal.fire("Error", "There was an error deleting the test", "error");
                }
            });
        }
    });
});

//When the edit test button is clicked, get the test information from the database and populate the modal with it
$(document).on('show.bs.modal', '#createTestModal', function(e) {

    //get id of button that triggered the modal
    var button = e.relatedTarget;
    var testID = button.getAttribute('id');

    //if the button has an id
    if(testID != null) {
        //set the form to edit mode
        $("#createTestForm").attr("data-mode", "edit");

        //get the test information from the database
        $.ajax({
            type: "POST",
            url: "/php/retrieveTests.php",
            data: {
                testID: testID
            },
            dataType: 'json',
            success: function(test) {
                //populate the modal with the test information
                $("#testNameLabel").text("Modifying: " + test.title);
                $("#testName").val(test.title);
                for (var question of test.questions){
                    $("#questionName").val(question.questionText);
                    $("#answer1").val(question.answers[0].answerText);
                    $("#answer2").val(question.answers[1].answerText);
                    $("#answer3").val(question.answers[2].answerText);
                    $("#answer4").val(question.answers[3].answerText);
                    
                    //check radio button for correct answer
                    if(question.answers[0].isCorrect == 1) {
                        $("#answerRadio1").prop("checked", true);
                    } else if(question.answers[1].isCorrect == 1) {
                        $("#answerRadio2").prop("checked", true);
                    } else if(question.answers[2].isCorrect == 1) {
                        $("#answerRadio3").prop("checked", true);
                    } else if(question.answers[3].isCorrect == 1) {
                        $("#answerRadio4").prop("checked", true);
                    }

                }
            },
            error: function() {
                Swal.fire("Error", "There was an error getting the test", "error");
            }
        });

    }
    else{
        //set the form to create mode
        $("#createTestForm").attr("data-mode", "create");
    }
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
        },
        error: function() {
            //reload the page as a last resort
            window.location.reload();
        }
  });
}