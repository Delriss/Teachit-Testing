// Registration Form - User Registration
$("#registrationForm").submit(function (e) {
  e.preventDefault(); //Prevent the default form submission
  grecaptcha.ready(function () {
    grecaptcha
      .execute("6LdzWYIpAAAAABoryfzQlrNtF24Jd9FB2EGlHdUX", {
        action: "create_comment",
      })
      .then(function (token) {
        $("#recapToken").val(token);
        //Ajax request to the server for asynchronous processing
        $.ajax({
          type: "POST",
          url: "/includes/createUser",
          data: $("#registrationForm").serialize(),

          //If the request is successful
          success: function (data) {
            if (data.includes("Registration successful")) {
              //Output
              Swal.fire({
                //Alert the user with a success message
                title: "Registration Successful",
                text: "You have successfully registered.",
                icon: "success",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Continue",
                heightAuto: false,
                allowOutsideClick: false
              }).then((result) => {
                //redirect to login page
                if (result.value) {
                  window.location = "/login";
                }
              });
              //If the request is not successful
            } else {
              Swal.fire({
                //Alert the user with an error message
                title: "Registration Failed",
                text: data,
                icon: "error",
                heightAuto: false
              });
            }
          },
        });
      });
  });
});

//Run the test selection display script on the test selection page load
$(document).ready(function () {
  //Only run on the test selection page
  if (window.location.href.includes("test-selection") == true) {
    //Run the test selection display script
    $.ajax({
      type: "POST",
      url: "/includes/outputStudentTests",
      data: $("#testContainer").serialize(),

      success: function (data) {
        //Inject custom HTML into the page
        $("#testContainer").html(data);
      },
    });

    //REGISTRATION PAGE
    //Run the completed test selection display script
    $.ajax({
      type: "POST",
      url: "/includes/outputCompletedStudentTests",
      data: $("#completedTestContainer").serialize(),

      success: function (data) {
        //Inject custom HTML into the page
        $("#completedTestContainer").html(data);
      },
    });
  }

  //Ensure registration form is loaded
  if ($("#courseTitle").length > 0) {
    //Send AJAX request to the server for asynchronous processing
    $.ajax({
      type: "POST",
      url: "/includes/retrieveSubjects",
      dataType: "json",

      //If the request is successful
      success: function (data) {
        //Output
        for (var i = 0; i < data.length; i++) {
          $("#courseTitle").append(
            "<option value=" +
              data[i].SID +
              ">" +
              data[i].subjectName +
              "</option>"
          );
        }
      },
      //Debugging - If the request is not successful
      error: function (data) {
        //If the request is not successful
        console.log("Error: " + data);
      },
    });
  }
  //Debugging
  // else {
  //   console.log("Not on registration page");
  // }

  //TESTING PAGE
  //This code will load nextQuestion.php when testing.php is loaded
  if(window.location.href.includes("testing") == true){
    //while the page is loading, this will hide the blank background
    $("#testingBackground").hide();
    $.ajax({
      type: "POST",
      url: "/php/nextQuestion",
      data: $("#testingInterface").serialize(),

      success: function (data) {
        //inserting the data from nextQuestion.php into the testingInterface div
        $("#testingInterface").html(data);
        //this will make the interface reappear
        $("#testingBackground").show();
      },
    });
  }
});

//
//TEST SELECTION -> TESTING PAGE
//
$(document).on("click", "#startTestButton", function (e) {
  e.preventDefault();
  let testID = $(this).data("id");
  //AJAX request to set the testID and other important variables in a SESSION variable to access
  //on testing.php. This will allow the user to return to the test if they have not completed it.
  //Furthermore the testID will be wiped once the test is completed or the user logs out.
  $.ajax({
    type: "POST",
    url: "/php/initialiseTest",
    data: { testID: testID },

    success: function (data) {
      window.location.href = "/testing";
    },
  });
});

//TESTING PAGE RECIEVING USER INPUT
//The code below will run when the user clicks one of the buttons on the testing page.
//  The code will validate the user's answer and add/deduct points accordingly.
//  Based on the result, the user will be presented with a sweet alert, if the answer is
//  incorrect, the correct answer will be displayed. The next question will be loaded afterwards.
$(document).on("click", "#option", function (e) {
  e.preventDefault();
  let userAnswered = $(this).data("id");
  $.ajax({
    type: "POST",
    url: "/php/validateAnswer",
    data: { userAnswered: userAnswered },
    dataType: "json",

    success: function (data) {
      //If the answer is correct
      if (data.status === "e1") {
        //resets the testing interface to avoid complications like the user pressing the same button twice
        //the background is also hidden while loading the question
        $("#testingBackground").hide();
        $("#testingInterface").html("");

        //OUTPUT SWEET ALERT
        Swal.fire({
          //Alert the user with a success message
          title: "Correct",
          text: "You have earned 30 points.",
          icon: "success",
          showCancelButton: false,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Next Question",
          allowOutsideClick: false,
          heightAuto: false
        }).then((result) => { //After the user clicks the button
          if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: "/php/nextQuestion",

              success: function (data) {
                //inserting the data and making the interface reappear
                $("#testingInterface").html(data);
                $("#testingBackground").show();
              },
            });
          }
        });

      } else if (data.status === "e2") { //if the test is completed
        //OUTPUT SWEET ALERT
        Swal.fire({
          //Alert the user with a success message
          title: "Correct",
          text: "You have earned 30 points.",
          icon: "success",
          showCancelButton: false,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Next Question",
          allowOutsideClick: false,
          heightAuto: false
        }).then((result) => { //After the user clicks the button
          if (result.isConfirmed) {
            Swal.fire({
              //Alert the user to inform them that the test is completed and show overall score
              title: "Congratulations!",
              text: "You have completed the test. You have earned " + data.points + " points.",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Finish Test",
              allowOutsideClick: false,
              heightAuto: false
            }).then((result) => {
              //upload and reset the session variables used in the exam
              if (result.isConfirmed) {
                $.ajax({
                  type: "POST",
                  url: "/php/finaliseTest",
    
                  success: function (data) {
                    window.location = "/test-selection";
                  },
                });
              }
            });
          }
        });
        
      } else if (data.status === "e3") {
        //OUTPUT SWEET ALERT
        Swal.fire({
          //Alert the user with an error message
          title: "Incorrect",
          text: "You have been deducted 10 points. The correct answer is: " + data.correctAnswerText + ".",
          icon: "error",
          showCancelButton: false,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Next Question",
          allowOutsideClick: false,
          heightAuto: false
        }).then((result) => { //After the user clicks the button
          if (result.isConfirmed) {
            Swal.fire({
              //Alert the user to inform them that the test is completed and show overall score
              title: "Congratulations!",
              text: "You have completed the test. You have earned " + data.points + " points.",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Finish Test",
              allowOutsideClick: false,
              heightAuto: false
            }).then((result) => {
              //upload and reset the session variables used in the exam
              if (result.isConfirmed) {
                $.ajax({
                  type: "POST",
                  url: "/php/finaliseTest",
    
                  success: function (data) {
                    window.location = "/test-selection";
                  },
                });
              }
            });
          }
        });

      } else { //if the answer is incorrect
        //resets the testing interface to avoid complications like the user pressing the same button twice
        $("#testingBackground").hide();
        $("#testingInterface").html("");

        //OUTPUT SWEET ALERT
        Swal.fire({
          //Alert the user with an error message
          title: "Incorrect",
          text: "You have been deducted 10 points. The correct answer is: " + data.correctAnswerText + ".",
          icon: "error",
          showCancelButton: false,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Next Question",
          allowOutsideClick: false,
          heightAuto: false
        }).then((result) => { //After the user clicks the button
          if (result.isConfirmed) {
            $.ajax({
              type: "POST",
              url: "/php/nextQuestion",

              success: function (data) {
                //inserting the data and making the interface reappear
                $("#testingInterface").html(data);
                $("#testingBackground").show();
              },
            });
          }
        });
      }
    },
  });
});

//Rerun test selection display script on modal close
$("#testSelectionModal").on("hidden.bs.modal", function () {
  //Run the test selection display script
  $.ajax({
    type: "POST",
    url: "/includes/outputStudentTests",
    data: $("#testContainer").serialize(),

    success: function (data) {
      //Inject custom HTML into the page
      $("#testContainer").html(data);
    },
  });
});

// Login Form
$("#loginForm").submit(function (e) {
  e.preventDefault(); //Prevent the default form submission
  grecaptcha.ready(function () {
    grecaptcha
      .execute("6LdzWYIpAAAAABoryfzQlrNtF24Jd9FB2EGlHdUX", {
        action: "create_comment",
      })
      .then(function (token) {
        $("#recapToken").val(token);
        //Ajax request to the server for asynchronous processing
        $.ajax({
          type: "POST",
          url: "/includes/auth",
          data: $("#loginForm").serialize(),

          success: function (data) {
            if (data.includes("e1") || data.includes("e2")) {
              //OUTPUT
              Swal.fire({
                //Alert the user with an error message
                title: "Email or Password Incorrect",
                text: "Please check that you have entered the correct email and password.",
                icon: "error",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue",
                heightAuto: false
              });
            } else if (data.includes("e3")) {
              //OUTPUT
              window.location = "/test-selection";
            } else if (data.includes("e4")) {
              //OUTPUT
              Swal.fire({
                //Alert the user with an error message
                title: "Details Missing",
                text: "Please ensure that you have entered the email and password.",
                icon: "error",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue",
                heightAuto: false
              });
            }
          },
        });
      });
  });
});