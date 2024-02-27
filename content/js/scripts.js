// Registration Form - User Registration
$("#registrationForm").submit(function (e) {
  e.preventDefault(); //Prevent the default form submission

  //Ajax request to the server for asynchronous processing
  $.ajax({
    type: "POST",
    url: "/php/createUser.php",
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
          text: "Registration Failed: ".data,
          icon: "error",
        });
      }
    },
  });
});

//Run the test selection display script on the test selection page load
$(document).ready(function () {
  //Only run on the test selection page
  if (window.location.href.includes("test-selection") == true) {
    //Run the test selection display script
    $.ajax({
      type: "POST",
      url: "/php/outputStudentTests.php",
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
      url: "/php/outputCompletedStudentTests.php",
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
      url: "/php/retrieveSubjects.php",
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
  else {
    console.log("Not on registration page");
  }
});

// Login Form
$("#loginForm").submit(function (e) {
  e.preventDefault(); //Prevent the default form submission

  //Ajax request to the server for asynchronous processing
  $.ajax({
    type: "POST",
    url: "../php/auth.php",
    data: {
      email: $("#email").val(),
      password: $("#password").val(),
    },

    success: function(data) {
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
        });
      }
    }
  })
});
