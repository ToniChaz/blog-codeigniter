var Main = {
    Post: function() {
        $("#charsLeft").text(170 - $("#postDescription").val().length);
        $("#postDescription").keyup(function() {
            $("#charsLeft").text(170 - $(this).val().length);
        });
        $("#title").keyup(function() {
            $("#slug").val(convertToSlug($(this).val()));
        });        
        tinymce.init({
            selector: "textarea.mceEditor",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste responsivefilemanager"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager",
            image_advtab: true,
            autosave_ask_before_unload: true,
            external_filemanager_path: "../../plugin/filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": "../filemanager/plugin.min.js"}
        });
    },
    User: function() {
        this.currentFormId;
        $(".onDeleteUser").on("click", _onDeleteUser);
    },
    Profile: function() {
        $("#onDeleteProfile").on("click", _onDeleteProfile);
    }
};

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
    var password = "password=" + $("#deleteProfilePassword").val();
    $.ajax({
        type: "POST",
        url: window.location.origin + "/larutadelgintonic/profile/deleteProfile",
        data: password,
        success: function(XMLHttpRequest) {
            if (XMLHttpRequest === "false") {
                $("#modalErrorP").html("<strong>Oh sheet!</strong> The password is incorrect!");
                $("#modalError").removeClass("hidden");
            } else {
                window.location.href = XMLHttpRequest;
            }
        }
    });
    return false;
}
function onConfirmDeleteUser() {
    var safeUser = $("#safeUser").val(),
            data = $("#" + currentFormId).serialize();
    debugger;
    $.ajax({
        type: "POST",
        url: window.location.origin + "/larutadelgintonic/users/deleteUser",
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
function ajaxSendData(type, url, data){
    $.ajax({
        type: type ? type : "POST",
        url: window.location.origin + "/larutadelgintonic/users/deleteUser",
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
function convertToSlug(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to = "aaaaeeeeiiiioooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

    return str;
}