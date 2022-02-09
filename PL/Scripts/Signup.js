$(document).ready(function () {

    $('#signup').validate({
        rules: {
            username: {
                required: true,
                minlength: 3,
                maxlength: 25
            },
            password: {
                required: true,
                minlength: 7,
                maxlength: 15
            },
            emailS: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 9,
                maxlength: 9
            },
            conpass: {
                equalTo: "#password"
            }


        },


        messages: {
            username: {
                required: "Please provide a username",
                minlength: "username can't be shorter than 3 characters",
                maxlength: "username can't be longer than 25 characters"
            },
            emailS: {
                required: "Please provide an email",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please provide a password",
                minlength: "password can't be shroter than 7 characters",
                maxlength: "password can't be greater than 15 characters"
            },
            phone: {
                required: "Please provide a phone number",
                minlength: "please enter a valid phone number (9 digits) ex: 123456789",
                maxlength: "please enter a valid phone number (9 digits) ex: 123456789"
            },
            conpass:{
                equalTo: "passwords should match"
            }

        },
        submitHandler: function (form) {

            //submitting values
            $('#signup').submit(function (event) {

                console.log("Form submit event started");

                $('#name + .throw_error').empty();
                $('#success').empty();


                console.log("username: "+$('input[name=usernameS]').val());

                var postForm ={
                    'username': $('input[name=username]').val(),
                    'password': $('input[name=password]').val(),
                    'email': $('input[name=emailS]').val(),
                    'phone': $('input[name=phone]').val(),
                    'action': 'signup'
                };

                console.log(postForm);


                $.ajax({//Process the form using $.ajax()
                    type: 'POST', //Method type
                    url: '../PHP/signUP.php', //Your form processing file url
                    data: postForm,



                    beforeSend: function () {
                        $("#SubmitButtonLogIn").attr("disabled", "disabled");
                        $("#divLoader").show();
                        console.log("before send:  " + this.data);
                        console.log("Ajax call initiated");
                    },


                    success: function (data) {
                        alert(data);

                        var dataR = JSON.parse(data);
                        if (!dataR.success) { //If fails
                            if (dataR.errors.name) { //Returned if any error from process.php
                                alert(dataR.errors.name);
                            }
                        } else {
                            alert('Please follow the link in your inbox to validate email');
                            window.location.replace('../Views/LoginForm.html');
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
