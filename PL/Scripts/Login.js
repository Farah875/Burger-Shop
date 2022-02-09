$(document).ready(function () {

    $('#login').validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            pass: {
                required: true,
                minlength: 7,
                maxlength: 15
            }
        },


        messages: {
            email: {
                required: "Please provide an email",
                email: "Please enter a valid email address"
            },
            pass: {
                required: "Please provide a password",
                minlength: "password can't be shorter than 7 characters",
                maxlength: "password can't be greater than 15 characters"
            }
        },
        submitHandler: function (form) {

            //submitting values
            $('#login').submit(function (event) {


                console.log("Form login submit started ");
                $('#name + .throw_error').empty(); //Clear the messages first
                $('#success').empty();

                var postLoginForm = {//Fetch login form data
                    'email': $('input[name=email]').val(), //Store username field value
                    'password': $('input[name=pass]').val(), //store password field value
                    'action': 'LOGIN'
                };

                $.ajax({//Process the form using $.ajax()
                    type: 'POST', //Method type
                    url: '../PHP/Login.php', //Your form processing file url
                    data: postLoginForm, //Forms name


                    beforeSend: function (xhr) {
                        $("#SubmitButtonLogIn").attr("disabled", "disabled");
                        $("#divLoader").show();
                        console.log("Ajax call initiated");
                    },


                    success: function (data) {
                        var dataR = JSON.parse(data);
                        if (!dataR.success) { //If fails
                            if (dataR.errors.name) {
                                alert(dataR.errors.name);
                            }
                        } else {
                            alert('Welcome back!!');
                            window.location.replace('../Views/index.php');
                        }

                        console.log("Ajax call success");
                    },
                    error: function (argumnets, error) {
                        console.log("Ajax call error: " + error);
                        alert("System  currently unavailable, try again later.");
                        console.log("Ajax call error");
                    },

                    complete: function () {
                        $("#submitbtn").removeAttr("disabled");
                        $("#divLoader").hide();


                        console.log("Ajax call completed");
                    }

                });

                event.preventDefault(); //Prevent the default submit
                console.log("Form submit event ended");



            });
        }
    });
});


