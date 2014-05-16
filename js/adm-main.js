var Main = {
    ServiceUrl: "http://localhost/larutadelgintonic/",
    deletePost: function() {
        $(".onDeletePost").on("click", _onDeletePost);
    },
    post: function() {
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
            entity_encoding : "raw",
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | responsivefilemanager",
            image_advtab: true,
            autosave_ask_before_unload: true,
            relative_urls:false,
            external_filemanager_path: Main.ServiceUrl + "plugin/filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": Main.ServiceUrl + "plugin/filemanager/plugin.min.js"}
        });
    },
    user: function() {
        $(".onDeleteUser").on("click", _onDeleteUser);
    },
    profile: function() {
        $("#onDeleteProfile").on("click", _onDeleteProfile);
    }
};
//Inflate modal windows if delete profile
function _onDeleteProfile() {
    var id = $(this).data("id");
    var confirmBtn = $("<button/>", {
        text: "Delete",
        type: "button",
        class: "btn btn-danger",
        click: function() {
            onConfirmDeleteData(id, "profile/deleteProfile");
        }
    });
    $("#modalLabel").html("Are you sure you want to delete your profile?");
    $("#modalBody").html("If you want to delete your profile type your password. <br /><br /> <div class='col-xs-5'><input type='password' id='safeInput' class='form-control'/></div><br /><br />");
    $("#modalFooter").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>").append(confirmBtn);
}
//Inflate modal windows if delete user
function _onDeleteUser() {
    var id = $(this).data("id");
    var confirmBtn = $("<button/>", {
        text: "Delete",
        type: "button",
        class: "btn btn-danger",
        click: function() {
            onConfirmDeleteData(id, "users/deleteUser");
        }
    });
    $("#modalLabel").html("Are you sure you want to delete this user?");
    $("#modalBody").html("If you want to delete this user type he username. <br /><br /> <div class='col-xs-5'><input type='text' id='safeInput' class='form-control'/></div><br /><br />");
    $("#modalFooter").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>").append(confirmBtn);
}
//Inflate modal windows if delete post
function _onDeletePost() {
    var id = $(this).data("id");
    var confirmBtn = $("<button/>", {
        text: "Delete",
        type: "button",
        class: "btn btn-danger",
        click: function() {
            onConfirmDeleteData(id, "post/deletePost");
        }
    });
    $("#modalLabel").html("Are you sure you want to delete this post?");
    $("#modalBody").html("If you want to delete this post type your username. <br /><br /> <div class='col-xs-5'><input type='text' id='safeInput' class='form-control'/></div><br /><br />");
    $("#modalFooter").html("<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>").append(confirmBtn);
}
//Ajax call for delete data
function onConfirmDeleteData(id, service) {
    var safeInput = $("#safeInput").val();
    $.ajax({
        type: "POST",
        url: Main.ServiceUrl + service,
        data: "id=" + id + "&safeInput=" + safeInput,
        success: function(XMLHttpRequest) {
            if (XMLHttpRequest === "false") {
                $("#modalErrorP").html("<strong>Oh sheet!</strong> The parameter is incorrect!");
                $("#modalError").removeClass("hidden");
            } else {
                location.reload();
            }
        }
    });
    return false;
}

//Generate clean slug
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