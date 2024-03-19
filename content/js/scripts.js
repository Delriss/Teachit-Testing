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
          url: "/php/createUser",
          data: $("#registrationForm").serialize(),

          //If the request is successful
          success: function (data) {
            if (data.includes("Registration successful")) {
              console.log(data);
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
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location = "/test-selection";
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
      url: "/php/outputStudentTests",
      data: $("#testContainer").serialize(),

      success: function (data) {
        //Inject custom HTML into the page
        $("#testContainer").html(data);
      },
    });

    $.ajax({
      type: "POST",
      url: "/php/outputCompletedStudentTests",
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
      url: "/php/retrieveSubjects",
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

  //
  //STUDENT MANAGEMENT PAGE
  //

  //Fill the student management table
  if (window.location.href.includes("student-management") == true) {
    //Run the student management display script
    $.ajax({
      type: "POST",
      url: "/php/outputStudents",
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
    url: "/php/outputStudentTests",
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
          url: "/php/auth",
          data: $("#loginForm").serialize(),

          success: function (data) {
            if (data.includes("e1") || data.includes("e2")) {
              console.log(data);
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
              console.log(data);
              //OUTPUT
              Swal.fire({
                //Alert the user with an error message
                title: "Successfully Logged In",
                text: "Please click continue to proceed to the testing page.",
                icon: "success",
                showCancelButton: false,
                confirmButtonColor: "#3085d6",
                confirmButtonText: "Continue",
                heightAuto: false,
              }).then((result) => {
                if (result.isConfirmed) {
                  window.location = "/test-selection";
                }
              });
            } else if (data.includes("e4")) {
              console.log(data);
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
        url: "/php/deleteUser",
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
        url: "/php/lockUser",
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
        url: "/php/lockUser",
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
    willOpen: () => {
      //Runs function on SWAL opening to load course data
      //Ensure registration form is loaded
      if ($("#courseTitle").length > 0) {
        //Send AJAX request to the server for asynchronous processing
        $.ajax({
          type: "POST",
          url: "/php/retrieveSubjects",
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
        url: "/php/addStudent",
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
    willOpen: () => {
      //Runs function on SWAL opening to load course data
      //Ensure registration form is loaded
      if ($("#courseTitle").length > 0) {
        //Send AJAX request to the server for asynchronous processing
        $.ajax({
          type: "POST",
          url: "/php/retrieveSubjects",
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
        url: "/php/retrieveStudentData",
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
        url: "/php/editStudent",
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

