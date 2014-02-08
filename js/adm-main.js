//Global variables
var currentFormId;

function _onDeleteProfile() {
    $("#modalLabel").html("Are you sure you want to delete your profile?");
    $("#modalBody").html("If you want to delete your profile type your password. <br /><br /> <div class='col-xs-5'><input type='password' id='deleteProfilePassword' class='form-control'/></div><br /><br />");
    $("#modalFooter").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button><button type='button' onClick='onConfirmDeleteProfile();' class='btn btn-danger'>Delete</button>");
}
function _onDeleteUser() {
    currentFormId = $(this).parents().siblings("form").attr('id');
    $("#modalLabel").html("Are you sure you want to delete this user?");
    $("#modalBody").html("If you want to delete this user type he username. <br /><br /> <div class='col-xs-5'><input type='user' id='safeUser' class='form-control'/></div><br /><br />");
    $("#modalFooter").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button><button type='button' onClick='onConfirmDeleteUser();' class='btn btn-danger'>Delete</button>");
}
function onConfirmDeleteProfile() {
    var url = document.location.href + "/deleteProfile",
            password = "password=" + $("#deleteProfilePassword").val();
    $.ajax({
        type: "POST",
        url: url,
        data: password,
        success: function(XMLHttpRequest) {
            if (XMLHttpRequest === "false") {
                $("#modalError").html("<strong>Oh sheet!</strong> The password is incorrect!");
                $("#modalError").removeClass("hidden");
            } else {
                window.location.href = XMLHttpRequest;
            }
        }
    });
    return false;
}
function onConfirmDeleteUser() {
    var url = document.location.href + "/deleteUser",
            safeUser = $("#safeUser").val(),
            data = $("#" + currentFormId).serialize();
    $.ajax({
        type: "POST",
        url: url,
        data: data + "&safeUser=" + safeUser,
        success: function(XMLHttpRequest) {
            if (XMLHttpRequest === "false") {
                $("#modalErrorP").html("<strong>Oh sheet!</strong> The username is incorrect!");
                $("#modalError").removeClass("hidden");
            } else {
                location.reload();
            }
        }
    });
    return false;
}
$(document).ready(function() {
    $("#onDeleteProfile").on("click", _onDeleteProfile);
    $(".onDeleteUser").on("click", _onDeleteUser);
});