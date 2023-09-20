$(document).ready(function () {
    $("#register-form").submit(function (e) {

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../api/registration.php",
            data: $(this).serialize(),
            success: function (response) {
                alert(response);
                $("#register-message").html(response);
            }
        });
    });
});

$(document).ready(function () {
    $("#login-form").submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "../api/qone.php",
            data: $(this).serialize(),
            success: function (response) {
                if (response == "Login Successful"){
                    window.location.href = ('../Dashboard.php');
                   
                }
            }
        });
    });
});
