$("#accountCreation").submit(function(e) {
    $.ajax({
        type: "POST",
        url: "content/php/accountCreation.php",
        data: $(this).serialize(),
        success: function(response)
        {
            $("#accountCreation").html(response);
        }
        
});