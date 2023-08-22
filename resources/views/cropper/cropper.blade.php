<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
<link rel="stylesheet" href="{{ url('cropper/css/cropper.min.css') }}">
<link rel="stylesheet" href="{{ url('cropper/css/main.css') }}">
<script src="{{ url('cropper/js/cropper.min.js') }}"></script>
<script src="{{ url('cropper/js/Global.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var urlPath = "{{ Request::route()->getName() }}"
        // alert("{{ Request::route()->getName() }}");
        var result = $('.result'),
            img_result = $('.img-result'),
            img_w = $('.img-w'),
            img_h = $('.img-h'),
            options = $('.options'),
            save = $('.save'),
            cropped = $('.cropped'),
            dwn = $('.download'),
            upload = $('#file-input'),
            cropper = '';
        var roundedCanvas;

        $('#file-input').change(function(e) {
            if (e.target.files.length) {
                // start file reader
                var reader = new FileReader();
                reader.onload = function(e) {
                    if (e.target.result) {
                        // create new image
                        var img = document.createElement('img');
                        img.id = 'image';
                        img.src = e.target.result;
                        // clean result before
                        //result.innerHTML = '';
                        result.children().remove();
                        // append new image
                        result.append(img);
                        // show save btn and options
                        // save.removeClass('hide');
                        options.removeClass('hide');
                        // init cropper
                        cropper = new Cropper(img);
                        cropper.setAspectRatio(1 / 1); //Set Image Size From Here (Define Ratio)
                        if (urlPath == 'edit-profile' || urlPath == 'admin.user.edit' || urlPath ==
                            'admin.testimonial.create' || urlPath == 'admin.testimonial.edit') {
                            cropper.setAspectRatio(1 / 1); //Set Image Size From Here (Define Ratio)
                        }
                        if (urlPath == 'admin.home-slider.create' || urlPath ==
                            'admin.home-slider.edit') {
                            cropper.setAspectRatio(1920 / 1080);
                        }
                        // cropper.setAspectRatio(2 / 1); //Set Image Size From Here (Define Ratio)

                        // cropper.setminCropBoxWidth(550);
                        // cropper.setminCropBoxHeight(350);
                        // cropbtn setting enabled
                        $('#cropbtn_setting').find('.btn').removeAttr("disabled");
                        $('#btncrop_download').attr("disabled", "true");
                        $('#save_toserver').attr("disabled", "true");
                        save.removeAttr("disabled");
                        // cropper.setCropBoxData({ width: 550, height: 350 });
                        $('#btn_RotateLeft').click(function() {
                            cropper.rotate(90);
                        });
                        $('#btn_RotateRight').click(function() {
                            cropper.rotate(-90);
                        });
                        $('#btn_RotateReset').click(function() {
                            cropper.reset();
                        });
                        $('#btn_Compresed').click(function() {
                            /*     cropper.(UMD, compressed);*/
                        });
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
        $('#save').click(function(e) {
            e.preventDefault();
            // get result to data uri
            var imgSrc = cropper.getCroppedCanvas({
                width: img_w.value // input value
            }).toDataURL();
            // remove hide class of img
            cropped.removeClass('hide');
            img_result.removeClass('hide');
            // show image cropped
            cropped.attr('src', imgSrc);
            dwn.removeClass('hide');
            dwn.download = 'imagename.png';
            dwn.attr('href', imgSrc);
            // download button enabled
            $('#btncrop_download').removeAttr("disabled");
            $('#save_toserver').removeAttr("disabled");
        });

    });

    $(document).ready(function() {
        $(document).on('change', '.btn-file :file', function() {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function(event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function() {
            readURL(this);
        });
    });

    function upload_profile() {
        $('#modal_crop').modal('hide');
        $('.modal-backdrop').removeClass('show').addClass('hide');
        var file = $('#image_frout').attr('src');
        $('#myresultimage').attr('src', file);
        $('#myimage').val(file);
        $('#closeButton').click();
    }
</script>
<div class="col-sm-12">
    <div class="modal" id="modal_crop">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Crop Your Image</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <main class="page">
                        <div class="box">
                            <label for="">Select Image (<small>File Size Only <b>8 MB Max </b>
                                    *</small>)</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="file-input" name="file+"
                                    onchange="ChangeSetImage(this, image_frout, file_text_frount);">
                                <input type="text" id="file_text_frount" class="form-control" style="display: none"
                                    readonly="" name="image">
                            </div>
                            <div class="d-flex">

                            </div>
                            <p class="note_forcrop">

                            </p>
                        </div>
                        <div class="box-2">
                            <div class="result">
                                <img class="cropped" id="image_frout1" src="{{ url('front-end/assets/notfound.gif') }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="box-2 img-result hide">
                            <img class="cropped" id="image_frout" src="" alt="">
                        </div>
                        <div class="box" id="cropbtn_setting">
                            <button class="btn btn-info btn-sm btn-c" disabled="disabled" id="btn_RotateLeft">
                                <i class="mdi mdi-format-rotate-90 basic_icon_margin"></i>Rotate Left
                            </button>
                            <button class="btn btn-warning btn-sm center_btnmargin btn-c" disabled="disabled"
                                id="btn_RotateRight">
                                <i class="mdi mdi-rotate-right basic_icon_margin"></i>Rotate Right
                            </button>
                            <button class="btn btn-danger btn-sm btn-c" disabled="disabled" id="btn_RotateReset">
                                <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Reset
                            </button>
                        </div>
                    </main>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    {{-- <a href="" class="btn btn-default download" disabled="disabled" id="btncrop_download"
                        download="croped_image.png">
                        <i class="mdi mdi-folder-download basic_icon_margin"></i>Download</a> --}}
                    <button type="button" class="btn btn-success save btn-c" id="save" disabled="disabled"><i
                            class="mdi mdi-crop basic_icon_margin"></i>Crop It!
                    </button>
                    <button type="button" onclick="upload_profile();" class="btn btn-primary btn-c" disabled="disabled"
                        id="save_toserver" disabled="disabled"><i
                            class="mdi mdi-account-check basic_icon_margin"></i>Set
                    </button>
                    <button style="display: none;" type="button" id="closeButton" class="btn btn-danger"
                        data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <input type="hidden" name="imageBaseString" id="myimage">
    <div class="col-sm-12">
        <div class="upload_image_box">
            <div class="upload_caption">
                <small><b> Upload photos from your computer</b></small>
            </div>
            <div class="btn-group" data-toggle="modal" data-target="#modal_crop">
                <button type="button" class="btn  btn-info btn-sm res_btn">Browse Photo
                </button>
            </div>
            <hr>
            <div class="upload_caption">
            </div>
            <div class="btn-group" data-toggle="modal" data-target="#modal_crop">
                <img style="height:300px; width:auto" src=" {{ !empty($preview) ? url($preview) : 'https://cdn.dribbble.com/users/1753953/screenshots/3818675/media/b376f45b3edd274a18c6296df22854fb.gif' }}" alt=""
                    id="myresultimage">

            </div>
            <br>
        </div>
    </div>
</div>
