/**
 * Created by INTEL on 09-11-2018.
 */

useBlob = false && window.URL;
var result = $(".result"),
    img_result = $(".img-result"),
    img_w = $(".img-w"),
    img_h = $(".img-h"),
    options = $(".options"),
    save = $(".save"),
    cropped = $(".cropped"),
    dwn = $(".download"),
    //                upload = $('#file-input'),
    cropper = "";

function readPostImage(file) {
    var img_length = Number($(".upimg_box").length);
    if (img_length < 10) {
        var reader = new FileReader();
        var image_src = "";
        reader.addEventListener("load", function() {
            var image = new Image();
            image.addEventListener("load", function() {
                if (useBlob) {
                    image_src = window.URL.revokeObjectURL(image.src);
                }
            });
            image_src = useBlob ?
                window.URL.createObjectURL(file) :
                reader.result;
            var append_image =
                "<div class='upimg_box'>" +
                "<i class='thumb_edit mdi mdi-pencil' data-toggle='modal' data-target='#modal_crop_forpost' " +
                "onclick='EditPostImage(this)'></i>" +
                "<i class='thumb_close mdi mdi-close' onclick='Remove_uploadimg_post(this);'></i>" +
                "<img class='up_img' src='" +
                image_src +
                "' /></div>"; //
            $("#image_preview")
                .find(".video_box")
                .remove();
            $("#image_preview").append(append_image);
            $("#files_block").show();
        });
        //getfilelengthpost();
        reader.readAsDataURL(file);
    } else {
        ShowErrorPopupMsg(
            "You can upload maximam 10 images & 1 video at a time."
        );
    }
}

function removeExtradiv() {
    setTimeout(function() {
        var img_length = Number($(".upimg_box").length);
        if (img_length > 10) {
            ShowErrorPopupMsg(
                "You can upload maximum 10 images & 1 video at a time."
            );
        }
    }, 200);
}

function Remove_uploadimg_post(dis) {
    $(dis)
        .parent()
        .remove();
}

function UploadPostImage(dis) {
    var files = dis.files;
    var errors = "";
    if (!files) {
        errors += "File upload not supported by your browser.";
    }
    if (files && files[0]) {
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            if (/\.(png|jpeg|jpg|gif)$/i.test(file.name)) {
                readPostImage(file);
            } else {
                errors += file.name + " Unsupported Image extension\n";
            }
        }
    }
    if (errors) {
        alert(errors);
    }
    $(dis).val("");
    removeExtradiv();
}

function EditPostImage(dis) {
    debugger;
    var getimag_src = $(dis)
        .parent()
        .find(".up_img")
        .attr("src");
    $(".up_img").removeClass("edit_this");
    $(dis)
        .parent()
        .find(".up_img")
        .addClass("edit_this");
    // $('#image_frout').attr('src', img_src);

    var img = document.createElement("img");
    img.id = "image";
    img.src = getimag_src;
    // clean result before
    //result.innerHTML = '';
    result.children().remove();
    // append new image
    result.append(img);
    // show save btn and options
    // save.removeClass('hide');
    options.removeClass("hide");
    $("#image_frout").attr("src", "");
    // $('.cropped').attr('src', getimag_src);
    cropper = new Cropper(img);

    // cropbtn setting enabled
    $("#cropbtn_setting")
        .find(".btn")
        .removeAttr("disabled");
    $("#btncrop_download").hide();
    $("#btncrop_download").attr("disabled", "true");
    $("#save_toserver").attr("disabled", "true");
    save.removeAttr("disabled");
    $("#btn_RotateLeft").click(function() {
        cropper.rotate(90);
    });
    $("#btn_RotateRight").click(function() {
        cropper.rotate(-90);
    });
    $("#btn_RotateReset").click(function() {
        cropper.reset();
    });
    $("#btn_Compresed").click(function() {
        /*     cropper.(UMD, compressed);*/
    });
}

function UpdateImage() {
    var update_imgsrc = $("#image_frout").attr("src");
    $(".edit_this").attr("src", update_imgsrc);
    $(".up_img").removeClass("edit_this");
}

function Cropped_image() {
    var imgSrc = cropper
        .getCroppedCanvas({
            width: img_w.value // input value
        })
        .toDataURL();
    // remove hide class of img
    cropped.removeClass("hide");
    img_result.removeClass("hide");
    // show image cropped
    cropped.attr("src", imgSrc);
    dwn.removeClass("hide");
    //dwn.download = 'imagename.png';
    dwn.attr("href", imgSrc);
    // download button enabled
    $("#btncrop_download").show();
    $("#btncrop_download").removeAttr("disabled");
    $("#save_toserver").removeAttr("disabled");
}

function Submit_post() {
    var adverimg_length = $(".upimg_box").length;
    if (adverimg_length > 10) {
        ShowErrorPopupMsg(
            "You can upload maximam 10 images & 1 video at a time."
        );
    } else {
        ShowSuccessPopupMsg("Post has been uploaded...");
        $("#Modal_NewAdd").modal("hide");
    }
}