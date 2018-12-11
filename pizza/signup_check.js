$(document).ready(function () {

    let pwdRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
    let phoneRegex = /^[1-9]{1}\d{9}$/;
    // $("#password").focus(function () {
    //     $(this).parent().parent().next().removeClass().addClass("info").text("").show();
    // })

    $("#password").blur(function(){

        if( $(this).val()==null || $(this).val()==""){

            $("#password").next().hide();
        }
        else if(pwdRegex.test($(this).val())){
        }
        else $("#password").next().removeClass().addClass("alert alert-danger").text("Your password must contain 6 or more characters that are of at least one number, and one uppercase and lowercase letter.").show();
    });


    $("#mobile").blur(function(){

        if( $(this).val()==null || $(this).val()==""){

            $("#mobile").next().hide();
        }
        else if(phoneRegex.test($(this).val())){
            $("#mobile").next().hide();
        }
        else $("#mobile").next().removeClass().addClass("alert alert-danger").text("please enter valid phone number.").show();
    });


    //email
    let emailRegex = /^[A-Za-z0-9]*\@[A-Za-z0-9]*\.[A-Za-z0-9]{3}$/;
    $("#email").focus(function () {
        // $(this).next().removeClass().addClass("info").text("infoMessage").show();
    });
    $("#email").blur(function(){

        if( $(this).val()==null || $(this).val()==""){
            $("#email").next().hide();
        }
        else if(emailRegex.test($(this).val())){
            // alert("333333");
            // $("#email").next().removeClass().addClass("ok").text("ok").show();
        }
        else {
            $("#email").next().removeClass().addClass("alert alert-danger").text("Please enter a valid email address").show();
            // alert("1111111");
        }

    });

    let checkbox = $("#gridCheck");
    let formInput = $(".form-control");
    $("button").on("click", function () {
        let fnameForm = $("#firstname");
        let lnameForm = $("#lastname");
        let emailForm = $("#email");
        let pwdForm = $("#password");
        let cPwdForm = $("#ConfirmPassword");
        let error = $("#error");
        let usernameForm = $('#username');
        let mobileForm = $('#mobile');

        // alert("111111");
        // console.log(fname);

        nullTest(fnameForm, error);
        nullTest(lnameForm, error);
        nullTest(emailForm, error);
        nullTest(pwdForm, error);
        nullTest(cPwdForm, error);
        nullTest(usernameForm, error);
        nullTest(mobileForm,error);
        equalTest(pwdForm,cPwdForm, error);

    });

    formInput.on("change", function () {
        $(this).removeClass("alert alert-danger").siblings("p").text("");
    });

    checkbox.on("change", function () {
        $(this).removeClass("alert alert-danger").siblings("p").text("");
    });

    function nullTest(valueForm, error) {
        let value=valueForm.val();
        if(value==null || value==""){
            // alert("22222")
            event.preventDefault();
            valueForm.addClass("is-invalid").siblings("p").text("Please fill the form").addClass("invalid-feedback");
            error.text("The highlighted elements have validation errors, please do it again!");
        }
    }

    function equalTest(valueForm1, valueForm2, error){
        let value1 = valueForm1.val();
        let value2 = valueForm2.val();
        if(value1!=value2){
            event.preventDefault();
            valueForm1.addClass("is-invalid").siblings("p").text("Please enter equal password").addClass("invalid-feedback");
            valueForm2.addClass("is-invalid").siblings("p").text("Please enter equal password").addClass("invalid-feedback");
            error.text("The highlighted elements have validation errors, please do it again!");
        }

    }

});

