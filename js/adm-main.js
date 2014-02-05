function closeAlert(e) {
    e.parent().fadeOut();
}
function _onDeleteProfile() {
    $("#modalLabel").html("Are you sure you want to delete your profile?");
    $("#modalBody").html("If you want to delete your profile type your password. <br /><br /> <div class='col-xs-5'><input type='password' id='deleteProfilePassword' class='form-control'/></div><br /><br />");
    $("#modalFooter").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button><button type='button' onClick='onConfirmDeleteProfile();' class='btn btn-danger'>Delete</button>");
}
function onConfirmDeleteProfile() {
    var url = document.location.href + "/deleteProfile",
        password = "password=" + $("#deleteProfilePassword").val();
    $.ajax({
        type: "POST",
        url: url,
        data: password,
        success: function(XMLHttpRequest) {
            if (XMLHttpRequest === "fail") {
                $("#modalError").html("<strong>Oh sheet!</strong> The password is incorrect!");
                $("#modalError").removeClass("hidden");
            } else {
                window.location.href = XMLHttpRequest;
            }
        }
    });
    return false;
}
$(document).ready(function() {
    $("#onDeleteProfile").on("click", _onDeleteProfile);
});