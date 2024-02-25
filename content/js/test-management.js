$('.tests-carousel').flickity({});
var $testsCarousel = $('.tests-carousel').flickity();

//on document ready, get the subjects for the dropdown
$(document).ready(function() {
    getSubjects();
});

//when the modal is hidden, reset the form
$(document).on('hidden.bs.modal', '#createTestModal', function() {
    $("#createTestForm").trigger("reset");
    $("#testNameLabel").text("Create Test");
    $("#submitForm").text("Create Test");
    //remove all questions from the accordion
    $("#accordionFlush").children().slice(1).remove();
    //set the form to create mode
    $("#createTestForm").attr("data-mode", "create");
    //remove the test id attribute from the modal
    $("#createTestForm").removeAttr("data-test-id");
});

function getSubjects() {
    $.ajax({
        type: "POST",
        url: "/php/retrieveSubjects.php",
        dataType: 'json',
        success: function(data) {
            //populate the dropdown with the subjects
            for(var i = 0; i < data.length; i++) {
                var option = $("<option value='" + data[i].SID + "'>" + data[i].subjectName + "</option>");
                $("#testSubject").append(option);
            }
        },
        error: function() {
            Swal.fire("Error", "There was an error getting the subjects", "error");
        }
    });
}


//function, passed a question number, returns the html for a question accordion item with updated attributes to uniquely identify them
function updateQuestionData(question, questionNumber) {
    //change the text of the question number to the new question number
    question.find(".accordion-button").text("Question " + questionNumber);

    //change the question attribute on any children inputs to the new question number
    question.find("input").each(function() {
        $(this).attr("data-question", questionNumber);
    });

    //change the delete question button data-question attribute to the new question number
    question.find(".deleteQuestion").attr("data-question", questionNumber);

    //change the name attribute of the radio buttons to isCorrect + question number
    question.find("input[type='radio']").each(function() {
        var name = $(this).attr("name");
        $(this).attr("name", "isCorrect" + questionNumber);
    });

    //change the radio button labels for attribute from isCorrect1 to isCorrect + question number
    question.find("label[for^='isCorrect']").each(function() {
        var forAttribute = $(this).attr("for");
        $(this).attr("for", "isCorrect" + questionNumber);
    });

    //change the accordion-button data-bs-target to #question + question number
    question.find(".accordion-button").attr("data-bs-target", "#flush-collapse" + questionNumber);

    //change all id flush-collapse to flush-collapse + question number
    question.find("[id^='flush-collapse']").each(function() {
        $(this).attr("id", "flush-collapse" + questionNumber);
    });

    //change all elements with aria-controls attribute to #question + question number
    question.find("[aria-controls]").each(function() {
        $(this).attr("aria-controls", "flush-collapse" + questionNumber);
    });

    //change any element with id flush-heading1 to flush-heading + question number
    question.find("[id^='flush-heading']").each(function() {
        $(this).attr("id", "flush-heading" + questionNumber);
    });

    //return the updated question element
    return question;
}

//when the user clicks the add question button, clone the question accordion element and append it to the accordion
//on click add question button
$(document).on("click", "#addQuestion", function() {
    //calculate the new question number
    var questionNumber = ($("#accordionFlush").children().length + 1);

    //clone the first question element
    var question = $("#questionAccordionItem").clone();

    //remove the id attribute from the cloned question
    question.removeAttr("id");

    //remove any values in the inputs
    question.find("input").val("");
    //select the first radio button
    question.find("input[type='radio']").first().prop("checked", true);

    //run the function to change all the attributes to the new question number
    newQuestion = updateQuestionData(question, questionNumber);

    //add a button to delete the question
    var deleteButton = $("<button class='btn btn-danger deleteQuestion ms-2' data-question='" + questionNumber + "'>Delete</button>");
    //append the delete button to questionAccordionButtonContainer
    newQuestion.find(".questionAccordionButtonContainer").append(deleteButton);

    //append the question to the accordion
    $("#accordionFlush").append(newQuestion);
});

function deleteQuestion(questionNumber) {
    //the form is in create mode, so we can just delete the question from the accordion as we don't need to delete it from the database
    //remove the question with the question number from the accordion
    $("#accordionFlush").children().eq(questionNumber - 1).remove();

    //get all the questions that come after the deleted question
    var questions = $("#accordionFlush").children().slice(questionNumber - 1);
    
    //loop through questions and update the question
    questions.each(function() {
        var newQuestionNumber = $(this).index() + 1;
        var question = $(this);
        question = updateQuestionData(question, newQuestionNumber);
    });
}

//when the user clicks the delete question button, remove the question from the accordion and update the question numbers for the questions that come after it
$(document).on("click", ".deleteQuestion", function(e) {
    //prevent the default action of the button
    e.preventDefault();

    //get the question number from the button
        var questionNumber = $(this).attr("data-question");

        //we need to check if the form is in create mode or edit mode
        if($("#createTestForm").attr("data-mode") == "edit") {
            //we need confirmation from the user if they want to delete the question from the database
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to recover this question!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, Delete',
                reverseButtons: true
            }).then((result) => {
                //If the user confirms they want to delete the question
                if (result.isConfirmed) {
                    //get the test id from the modal
                    var testID = $("#createTestForm").attr("data-test-id");

                    console.log("deleting question " + questionNumber + " from test " + testID + " in edit mode");

                    //delete the question from the database
                    $.ajax({
                        type: "POST",
                        url: "/php/deleteQuestion.php",
                        data: {
                            testID: testID,
                            questionIndex: questionNumber
                        },
                        success: function() {
                            deleteQuestion(questionNumber);
                        },
                        error: function() {
                            Swal.fire("Error", "There was an error deleting the question", "error");
                        }
                    });
                }
            });
        }
        else{
            //if the form is in create mode, we can just delete the question from the accordion as we don't need to delete it from the database
            deleteQuestion(questionNumber);
        }
        
});


//function for validating the form
function validateForm(form) {
    //return true if the form is valid, false if it is not

    //make variable "valid" to store the validity of the form, set to true by default
    var valid = true;

    //loop through the form and check if it is valid
    while (valid) {     
        //check if the test name is empty
        if($("#testName").val() === "") {
            //if it is empty, fire an error message
            Swal.fire("Error", "Please fill in the test name", "error");
            valid = false;
        }
        else if($("#testName").val().length > 50) {
            //if it is longer than 50 characters, fire an error message
            Swal.fire("Error", "Test name must be less than 50 characters", "error");
            valid = false;
        }
    
        //check if the test description is empty and check if it is longer than 255 characters
        if($("#testDescription").val() === "") {
            //if it is empty, fire an error message
            Swal.fire("Error", "Please fill in the test description", "error");
            valid = false;
        }
        else if($("#testDescription").val().length > 255) {
            //if it is longer than 255 characters, fire an error message
            Swal.fire("Error", "Test description must be less than 255 characters", "error");
            valid = false;
        }
    
        //for each input in the form with name "question", check if it is empty
        form.find("input[name='question']").each(function() {
            if($(this).val() === "") {
                //if it is empty, fire an error message
                Swal.fire("Error", "Please fill in all the questions", "error");
                valid = false;
            }
            else if($(this).val().length > 1000) {
                //if the question is longer than supported in the database, fire an error message
                Swal.fire("Error", "Questions must be less than 100 characters", "error");
                return false;
            }
        });
    
        //for each input in the form with name "answer", check if it is empty
        form.find("input[name='answer']").each(function() {
            if($(this).val() === "") {
                //if it is empty, fire an error message
                Swal.fire("Error", "Please fill in all the answers", "error");
                valid = false;
            }
            else if($(this).val().length > 1000) {
                //if the answer is longer than supported in the database, fire an error message
                Swal.fire("Error", "Answers must be less than 1000 characters", "error");
                return false;
            }
        });

        //make sure at least one radio button is checked per data-question attribute. This should technically be impossible to fail, but it's here just in case the form is modified
        form.find("input[type='radio']").each(function() {
            if($("input[name='isCorrect" + $(this).attr("data-question") + "']:checked").length == 0) {
                //if no radio button is checked, fire an error message
                Swal.fire("Error", "Please select a correct answer for each question", "error");
                valid = false;
            }
        });

        //if we have reached this point, the form is valid so break out of the loop
        break;
    }
    //return the validity of the form
    return valid;
}

//When the Form is submitted
$("#submitForm").click(function(e) {
    e.preventDefault();

    //validate the form
    var form = $("#createTestForm");

    //If the form is valid, continue
    if(validateForm(form) == true) {

        //get the test title
        var testTitle = $("#testName").val();

        //get the test description
        var testDescription = $("#testDescription").val();

        //get the test subject
        var testSubject = $("#testSubject").val();
        
        //define an array to store questions
        var questions = [];

        //define arrays to store the question text, answer text and correct answers
        var questionText;

        //loop through each html element in class accordion-item
        $(".accordion-item").each(function() {
            var answerText = [];
            var correctAnswer = 0;

            //get the input with the name question
            questionText = $(this).find("input[name='question']").val();

            //get all inputs with name answer
            var answers = $(this).find("input[name^='answer']");

            //get all inputs with name isCorrect
            var correctRadios = $(this).find("input[name^='isCorrect']");

            //loop through the answers and push them to the answerText array
            answers.each(function() {
                answerText.push($(this).val());
            });

            //loop through the correctRadios and push them to the correctAnswer array
            correctRadios.each(function(index) {
                //if this radio button is checked, store the index of the radio button in the correctAnswer array
                if($(this).is(":checked")) {
                    correctAnswer = index;
                }
            });

            //push the questionText and answer arrays to the questions array as well as the correct answer index for the question
            questions.push({
                questionText: questionText,
                answers: answerText,
                correctAnswer: correctAnswer
            });
        });

        //if the form is in create mode, we are creating a test.
        if(form.attr("data-mode") == "edit") {
            console.log("submitting edit form");

        }
        else{
            $.ajax({
                url: "/php/createTest.php",
                type: "POST",
                data: {
                    testTitle: testTitle,
                    testDescription: testDescription,
                    testSubject: testSubject,
                    questions: questions
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

    //otherwise, the form must be invalid so break out of the function
    else{
        return;
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
        //set the test id attribute of the modal to the test id
        $("#createTestForm").attr("data-test-id", testID);

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
                //change add test button to update test button
                $("#submitForm").text("Update Test");
                $("#testName").val(test.title);
                $("#testDescription").val(test.testDesc);
                $("#testSubject").val(test.subjectID);


                //for each question in the test, add a question to the modal
                for(var i = 0; i < test.questions.length; i++) {
                    //if this is the first question, we don't need to clone it
                    if(i == 0) {
                        var question = $("#questionAccordionItem");
                    }
                    else {
                        //clone the first question element
                        var question = $("#questionAccordionItem").clone();
                        //run the question object through the updateQuestionData function to update the question number
                        newQuestion = updateQuestionData(question, i + 1);
                        //add a button to delete the question
                        var deleteButton = $("<button class='btn btn-danger deleteQuestion ms-2' data-question='" + i + 1 + "'>Delete</button>");
                        //append the delete button to questionAccordionButtonContainer
                        newQuestion.find(".questionAccordionButtonContainer").append(deleteButton);
                        //append the question to the accordion
                        $("#accordionFlush").append(newQuestion);
                    }

                    //use the updatedQuestionData function to update the question number
                    var question = $("#accordionFlush").children().eq(i);
                    question = updateQuestionData(question, i + 1);

                    //populate the question with the question text
                    question.find("input[name='question']").val(test.questions[i].questionText);

                    //loop through each input in the form with name answer and populate it with the correct answer
                    question.find("input[name='answer']").each(function(index) {
                        $(this).val(test.questions[i].answers[index].answerText);
                    });

                    //loop through each radio button with name starting with isCorrect in the question and if it's the correct answer, check it
                    question.find("input[name^='isCorrect']").each(function(index) {
                        if(test.questions[i].answers[index].isCorrect == 1) {
                            $(this).prop("checked", true);
                        }
                    });
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