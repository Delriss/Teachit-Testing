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
            window.location = "./index";
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

// Registration Form - Populate Subjects
$(document).ready(function () {
  //Ensure registration form is loaded
  if ($("#courses").length > 0) {
    //Send AJAX request to the server for asynchronous processing
    $.ajax({
      type: "POST",
      url: "/php/retrieveSubjects.php",
      dataType: "json",

      //If the request is successful
      success: function (data) {
        //Output
        for (var i = 0; i < data.length; i++) {
          $("#courses").append("<option value=" + data[i].SID +">" + data[i].subjectName + "</option>"
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
  else 
  {
    console.log("Not on registration page");
  }
});

// Login Form
$("#loginForm").submit(function (e) {
  e.preventDefault(); //Prevent the default form submission

  //Ajax request to the server for asynchronous processing
  $.ajax({
    type: "POST",
    url: "./php/auth.php",
    data: {
      email: $("#email").val(),
      password: $("#password").val(),
    }
  });

});
