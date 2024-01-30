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
