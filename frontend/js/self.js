$("#formRegister").validate({
    rules: {
        username: {
            required: true,
            minlength: 3
        },
        passwd1: {
            required: true,
            minlength: 6,
            maxlength: 25
        },
        passwd2: {
            required: true,
            equalTo: '#passwd1'
        },
        mailer: {
            required: true,
            email: true
        }
    },
    messages: {
        username: {
            required: "Bitte geben Sie einen Benutzernamen ein.",
            minlength: "Bitte geben Sie mindestens 3 Zeichen ein."
        },
        passwd1: {
            required: "Bitte geben Sie ein Passwort ein.",
            minlength: "Passwort muss mindestens 6 Zeichen lang sein.",
            maxlength: "Passwort darf nicht gr&ouml;&szlig;er als 25 Zeichen sein."
        },
        passwd2: {
            required: "Bitte wiederholen Sie das Passwort.",
            equalTo: "Das passwort stimmt nicht &uuml;berein."
        },
        mailer: {
            required: "Bitte geben Sie eine g&uuml;ltige Email-Adresse ein."
        }
    },
    submitHandler: submitForm
});

function submitForm() {
    var data = $("#formRegister").serialize();
    
    $.ajax({
        type: "POST",
        url: "./frontend/pages/register.php",
        data: data,
        beforeSend: function() {
            $("#error").fadeOut();
            $("#sendRegister").html('<span class="glyphicon glyphicon-transfer"></span> &nbsp; Daten werden gesendet...');
        },
        success: function(data) {
            if(data == 1) {
                //Benutzer ist vergeben
                $("#error").fadeOut(250);
                $("#error").fadeIn(1300, function() {
                    $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; Benutzername bereits vergeben!</div>');
                    $("#sendRegister").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Account Erstellen');
                });
            } else if(data == 2) {
                //Mail bereits vergeben
                $("#error").fadeOut(250);
                $("#error").fadeIn(1300, function() {
                    $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; Email-Adresse bereits vergeben!</div>');
                    $("#sendRegister").html('<span class="glyphicon glyphicon-log-in"></span> &nbsp; Account Erstellen');
                });
            } else if(data == "success") {
                //Registrierung abgeschlossen
                $("#error").fadeOut(250);
                $("#error").fadeIn(1300, function() {
                    $("#error").html('<div class="alert alert-success"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; Registrierung erfolgreich!</div>');
                    $("#sendRegister").removeClass('btn-success').addClass('btn-primary').html('Einloggen').attr('data-toggle', 'modal').attr('data-dismiss', 'modal').attr('data-target', '#login');
                    $("#loggedin").hide();
                });
                setTimeout(function() {
                    $("#formRegister").fadeOut(200, function() {
                        $(".modal-header button").fadeOut(50, function() {
                            $(this).click();
                            window.location.href = "./index.php";
                        });
                    });
                }, 5000);
            } else {
                //Allgemeiner Fehler
            }
        }
    });
    
    return false;
};