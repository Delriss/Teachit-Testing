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
                heightAuto: false
              });
            } else if (data.includes("e3")) {
              //OUTPUT
              window.location = "/test-selection";
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
                heightAuto: false
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