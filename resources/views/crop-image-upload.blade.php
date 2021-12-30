<!DOCTYPE html>
<html>

<head>
    <title>Laravel Cropper js - Crop Image Before Upload - Tutsmake.com</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
</head>
<style type="text/css">
    img {
        display: block;
        max-width: 100%;
    }

    .preview {
        overflow: hidden;
        width: 160px;
        height: 160px;
        margin: 10px;
        border: 1px solid red;
    }

    .modal-lg {
        max-width: 1000px !important;
    }

</style>

<body>
    <form action="{{ url('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container mt-5">
            <div class="card">
                <h2 class="card-header">Laravel Cropper Js - Crop Image Before Upload - Tutsmake.com</h2>
                <div class="card-body">
                    <h5 class="card-title">Please Selete Image For Cropping</h5>
                    <input type="file" name="image" class="image">
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Laravel Cropper Js - Crop Image Before Upload -
                            Tutsmake.com
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="img-container">
                            <div class="row">
                                <div class="col-md-8">
                                    <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                                </div>
                                <div class="col-md-4">
                                    <div class="preview"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-success" id="roated">Rote 90deg</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="crop">Crop</button>

                        <button sub type="submit" class="btn btn-warning">Store</button>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        var $modal = $('#modal');
        var image = document.getElementById('image');
        var cropper;
        $("body").on("change", ".image", function(e) {
            var files = e.target.files;
            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };
            var reader;
            var file;
            var url;
            if (files && files.length > 0) {
                file = files[0];
                if (URL) {
                    // console.log(URL.createObjectURL)

                    done(URL.createObjectURL(file));
                } else if (FileReader) {
                    console.log(FileReader)
                    reader = new FileReader();
                    reader.onload = function(e) {
                        done(reader.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
        });
        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 2,
                preview: '.preview',
                zoomOnWheel: true,
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#roated').click(function() {
            cropper.rotate(90)
        });


        $("#crop").click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 500,
                height: 500,
            });
            toDataURL('image/jpeg')
            // canvas.console.log(canvas)
            // canvas.toBlob(function(blob) {
            //     url = URL.createObjectURL(blob);
            //     var reader = new FileReader();
            //     reader.readAsDataURL(blob);
            //     reader.onloadend = function() {
            //         var base64data = reader.result;
            //         $.ajax({
            //             type: "POST",
            //             dataType: "json",
            //             url: "crop-image-upload",
            //             data: {
            //                 '_token': $('meta[name="_token"]').attr('content'),
            //                 'image': base64data
            //             },
            //             success: function(data) {
            //                 console.log(data);
            //                 $modal.modal('hide');
            //                 alert("Crop image successfully uploaded");
            //             }
            //         });


            //     }
            // });
        })





        // $.ajax({
        //     type: "POST",
        //     dataType: "json",
        //     url: "/store",
        //     data: { '_token': $('meta[name="_token"]').attr('content'), 'image': base64data },
        //     success: function (data) {
        //         console.log(data);
        //         $modal.modal('hide');
        //         alert("Crop image successfully uploaded");
        //     }
        // });


    </script>
</body>

</html>
