//Logout Button
$(".btnLogout").click(function (e) {
  e.preventDefault(); //Prevent the default form submission
  //Ajax request to the server for asynchronous processing
  $.ajax({
    type: "GET",
    url: "/logout",
    success: function (data) {
      if (data.includes("Logout successful")) {
        //OUTPUT
        Swal.fire({
          //Alert the user with a success message
          title: "Logout Successful",
          text: "You have successfully logged out.",
          icon: "success",
          showCancelButton: false,
          confirmButtonColor: "#3085d6",
          confirmButtonText: "Continue",
          heightAuto: false,
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = "/";
          }
        });
      }
    },
  });
});

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
                heightAuto: false,
              });
            }
          },
        });
      });
  });
});

//Run the test selection display script on the test selection page load
$(document).ready(function () {
  //
  //TEST SELECTION PAGE
  //
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
  //
  //TEST SELECTION END
  //

  //
  //REGISTRATION PAGE
  //
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
  //
  //REGISTRATION PAGE END
  //

  //TESTING PAGE
  //This code will load nextQuestion.php when testing.php is loaded
  if(window.location.href.includes("testing") == true){
    //while the page is loading, this will hide the blank background
    $("#testingBackground").hide();
    $.ajax({
      type: "POST",
      url: "/includes/nextQuestion",
      data: $("#testingInterface").serialize(),

      success: function (data) {
        //inserting the data from nextQuestion.php into the testingInterface div
        $("#testingInterface").html(data);
        //this will make the interface reappear
        $("#testingBackground").show();
      },
    });
  }

  //
  //STUDENT MANAGEMENT PAGE
  //

  //Fill the student management table
  if (window.location.href.includes("student-management") == true) {
    //Run the student management display script
    $.ajax({
      type: "POST",
      url: "/includes/outputStudents",
      data: $("#studentTable").serialize(),

      success: function (data) {
        //Inject custom HTML into the page
        $("#studentTable").html(data);

        //Init Datatable
        $("#studentTable").DataTable({
          responsive: true,
        });
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
    url: "/includes/initialiseTest",
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
    url: "/includes/validateAnswer",
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
              url: "/includes/nextQuestion",

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
                  url: "/includes/finaliseTest",
    
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
                  url: "/includes/finaliseTest",
    
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
              url: "/includes/nextQuestion",

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


  //
  //STUDENT MANAGEMENT PAGE
  //

  //Fill the student management table
  if (window.location.href.includes("student-management") == true) {
    //Run the student management display script
    $.ajax({
      type: "POST",
      url: "/includes/outputStudents",
      data: $("#studentTable").serialize(),

      success: function (data) {
        //Inject custom HTML into the page
        $("#studentTable").html(data);

        //Init Datatable
        $("#studentTable").DataTable({
          responsive: true,
        });
      },
    });
  }

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
                heightAuto: false,
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
                heightAuto: false,
              });
            } else if (data.includes("e5")) {
              console.log(data);
              //OUTPUT
              Swal.fire({
                //Alert the user with an error message
                title: "Account Locked",
                text: "Your account has been locked. Please contact your administrator.",
                icon: "error",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue",
                heightAuto: false,
              });
            }
          },
        });
      });
  });
});

//animating the progress bars on the leaderboard page
$(".leaderboardProgress").each(function(i){
  $(this).delay( 500*i ).animate( { width: $(this).attr('aria-valuenow') + '%' }, 500 );
});

//Student Management - Delete Student
$(document).on("click", "#btnDelete", function (e) {
  e.preventDefault(); //Prevent the default form submission

  //Send Confirmation SWAL
  Swal.fire({
    title: "Are you sure?",
    text: "This action cannot be undone!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
    cancelButtonText: "No, cancel!",
    heightAuto: false,
  }).then((result) => {
    if (result.isConfirmed) {
      //Ajax request to the server for asynchronous processing
      $.ajax({
        type: "POST",
        url: "/includes/deleteUser",
        data: {
          UID: $(this).data("id"),
        },
        success: function (data) {
          if (data.includes("User deleted")) {
            //OUTPUT
            Swal.fire({
              //Alert the user with a success message
              title: "Student Deleted",
              text: "The student has been successfully deleted.",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Continue",
              heightAuto: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = "/student-management";
              }
            });
          } else {
            //OUTPUT
            Swal.fire({
              //Alert the user with an error message
              title: "Error",
              text: "An error has occurred. Please try again.",
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Continue",
              heightAuto: false,
            });
          }
        },
      });
    }
  });
});

//Student Management - Lock Student
$(document).on("click", "#btnLock", function (e) {
  e.preventDefault(); //Prevent the default form submission

  //Send Confirmation SWAL
  Swal.fire({
    title: "Are you sure?",
    text: "This will lock the user's account. They will not be able to log in.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, lock it!",
    cancelButtonText: "No, cancel!",
    heightAuto: false,
  }).then((result) => {
    if (result.isConfirmed) {
      //Ajax request to the server for asynchronous processing
      $.ajax({
        type: "POST",
        url: "/includes/lockUser",
        data: {
          UID: $(this).data("id"),
          lock: $(this).data("lock"),
        },
        success: function (data) {
          if (data.includes("User lock changed")) {
            //OUTPUT
            Swal.fire({
              //Alert the user with a success message
              title: "Student Locked",
              text: "The student has been successfully locked.",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Continue",
              heightAuto: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = "/student-management";
              }
            });
          } else {
            //OUTPUT
            Swal.fire({
              //Alert the user with an error message
              title: "Error",
              text: "An error has occurred. Please try again.",
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Continue",
              heightAuto: false,
            });
          }
        },
      });
    }
  });
});

//Student Management - Unlock Student
$(document).on("click", "#btnUnlock", function (e) {
  e.preventDefault(); //Prevent the default form submission

  //Send Confirmation SWAL
  Swal.fire({
    title: "Are you sure?",
    text: "This will unlock the user's account. They will be able to log in.",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, unlock it!",
    cancelButtonText: "No, cancel!",
    heightAuto: false,
  }).then((result) => {
    if (result.isConfirmed) {
      //Ajax request to the server for asynchronous processing
      $.ajax({
        type: "POST",
        url: "/includes/lockUser",
        data: {
          UID: $(this).data("id"),
          lock: $(this).data("lock"),
        },
        success: function (data) {
          if (data.includes("User lock changed")) {
            //OUTPUT
            Swal.fire({
              //Alert the user with a success message
              title: "Student Unlocked",
              text: "The student has been successfully unlocked.",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Continue",
              heightAuto: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location = "/student-management";
              }
            });
          } else {
            //OUTPUT
            Swal.fire({
              //Alert the user with an error message
              title: "Error",
              text: "An error has occurred. Please try again.",
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              confirmButtonText: "Continue",
              heightAuto: false,
            });
          }
        },
      });
    }
  });
});

//Student Management - Add Student
$("#btnCreateStudent").click(function (e) {
  e.preventDefault();
  //Custom SWAL Form to accept Student Data
  Swal.fire({
    title: "Add Student",
    html: `
          <form id="addStudentForm">
            <div class="mb-2 d-flex">
                <input type="text" class="form-control m-1" id="studentNum" name="studentNum" placeholder="Student Number (Numbers Only)" required>
                <input type="email" class="form-control m-1" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-2 d-flex">
                <input type="text" class="form-control m-1" id="firstName" name="firstName" placeholder="First Name" required>
                <input type="text" class="form-control m-1" id="lastName" name="lastName" placeholder="Last Name" required>
            </div>
            <div class="mb-2">
                <select class="form-select m-1" id="courseTitle" name="courseTitle" placeholder="Select Course" required>
                    <!-- <option value="1">Fill this with PHP/JS</option> -->
                </select>
            </div>
            <div class="mb-2">
                <input type="password" class="form-control m-1" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-text">
                Password must be at least 8 characters long and contain at least one number and one special character.
            </div>
            <div class="mb-2">
                <input type="password" class="form-control m-1" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <div class="mb-2 w-100 d-flex justify-content-center">
                <input type="checkbox" class="form-check-input m-1" id="accountLock" name="accountLock">
                <label class="form-check label" for="accountLock">Lock Account</label>
            </div>
          </form>
        `,
    showCancelButton: true,
    heightAuto: false,
    willOpen: () => {
      //Runs function on SWAL opening to load course data
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
    }
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "/includes/addStudent",
        data: $("#addStudentForm").serialize(),
        success: function (data) {
          if (data.includes("Registration successful")) {
            Swal.fire({
              title: "Student Added",
              text: "Student successfully added.",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Continue",
              heightAuto: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = "/student-management";
              }
            });
          } else {
            Swal.fire({
              title: "Student Creation Failed",
              text: data,
              icon: "error",
            });
          }
        },
      });
    }
  });
});


//Student Management - Edit Student
$(document).on("click", "#btnEdit", function (e) {
  e.preventDefault();
  //Custom SWAL Form to accept Student Data
  Swal.fire({
    title: "Edit Student",
    html: `
          <form id="editStudentForm">
            <div class="mb-2 d-flex">
                <input type="text" class="form-control m-1" id="studentNum" name="studentNum" placeholder="Student Number (Numbers Only)" required>
                <input type="email" class="form-control m-1" id="email" name="email" placeholder="Email" required>
            </div>
            <div class="mb-2 d-flex">
                <input type="text" class="form-control m-1" id="firstName" name="firstName" placeholder="First Name" required>
                <input type="text" class="form-control m-1" id="lastName" name="lastName" placeholder="Last Name" required>
            </div>
            <div class="mb-2">
                <select class="form-select m-1" id="courseTitle" name="courseTitle" placeholder="Select Course" required>
                    <!-- <option value="1">Fill this with PHP/JS</option> -->
                </select>
            </div>
            <div class="mb-2 w-100 d-flex justify-content-center">
                <input type="checkbox" class="form-check-input m-1" id="accountLock" name="accountLock">
                <label class="form-check label" for="accountLock">Lock Account</label>
            </div>
          </form>
        `,
    showCancelButton: true,
    heightAuto: false,
    willOpen: () => {
      //Runs function on SWAL opening to load course data
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

      //Runs function on SWAL opening to load student data into form
      $.ajax({
        type: "POST",
        url: "/includes/retrieveStudentData",
        data: {
          UID: $(this).data("id"),
        },
        dataType: "json",
        success: function (data) {
          $("#studentNum").val(data.ID);
          $("#email").val(data.email);
          $("#firstName").val(data.firstName);
          $("#lastName").val(data.lastName);
          $("#courseTitle").val(data.courseTitle);
          if (data.accountLock == 1) {
            $("#accountLock").prop("checked", true);
          }
        },
      });
    }
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "/includes/editStudent",
        data: $("#editStudentForm").serialize(),
        success: function (data) {
          if (data.includes("Update successful")) {
            Swal.fire({
              title: "Student Account Edited",
              text: "Student successfully Edited.",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Continue",
              heightAuto: false,
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = "/student-management";
              }
            });
          } else {
            Swal.fire({
              title: "Student Edit Failed",
              text: data,
              icon: "error",
            });
          }
        },
      });
    }
  });
});

//Student Management - Reset Student Password
$("#btnResetPassword").click(function (e) {
  e.preventDefault();
  
  //Custom SWAL Form to accept Student Data
  Swal.fire({
    title: "Reset Student Password",
    html: `
          <form id="resetPasswordForm">
            <div class="mb-2">
                <input type="text" class="form-control m-1" id="studentNum" name="studentNum" placeholder="Student Number (Numbers Only)" required>
            </div>
            <div class="mb-2 d-flex">
                <input type="password" class="form-control m-1" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="mb-2">
                <input type="password" class="form-control m-1" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" required>
            </div>
            <div class="form-text">
                Password must be at least 8 characters long and contain at least one number and one special character.
            </div>
          </form>
        `,
    showCancelButton: true,
    heightAuto: false,
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "POST",
        url: "/includes/resetPassword",
        data: $("#resetPasswordForm").serialize(),
        success: function (data) {
          if (data.includes("Password reset")) {
            Swal.fire({
              title: "Password Reset",
              text: "Password successfully reset.",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Continue",
              heightAuto: false,
            });
          } else {
            Swal.fire({
              title: "Password Reset Failed",
              text: data,
              icon: "error",
            });
          }
        },
      });
    }
  })
});
