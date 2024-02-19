$("#registrationForm").submit(function (e) {
  e.preventDefault();

  $.ajax({
    type: "POST",
    url: "/php/_registrationScript.php",
    data: $("#registrationForm").serialize(),

    success: function (data) {
      if (data.includes("Registration successful")) {
        console.log(data)
        //Output
        Swal.fire({
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
      } else {
        Swal.fire({
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
  if (window.location.href.includes("test-selection") == false){
    console.log("Not on test selection page")
    return;
  }

  $.ajax({
    type: "POST",
    url: "/php/outputStudentTests.php",
    data: $("#testContainer").serialize(),

    success: function (data) {
      //Inject custom HTML into the page
      $("#testContainer").html(data);
    }
  });
});
