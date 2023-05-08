<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include('./template/head.php');
        ?>
        <title>Add item to store</title>
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
        <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="../js/admin.js"></script>
    </head>
    <body style="background: #2b2a33;" onload="loadPageControl(); loadAdminPageControl(); setVariables();">
                <?php
                    include('./template/webloader_o.php');
                ?>
                <?php
                    include('./template/common.php');
                ?>
                <div class="col py-3">
                    <input type="file" class="filepond" name="filepond" accept="image/png, image/jpeg, image/webp"/><br>
                    <div class="">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Item Name:</span>
                            <input type="text" id="itemName" class="form-control" aria-label="Name of the item." aria-describedby="inputGroup-sizing-default" />
                        </div>
                        <br>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Item Description:</span>
                            <textarea rows=10 id="itemDesc" class="form-control" aria-label="Description of the item." aria-describedby="inputGroup-sizing-default"></textarea>
                        </div>
                        <br>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Item Price: €</span>
                            <input type="number" id="itemPrice" class="form-control" aria-label="Price of the item." aria-describedby="inputGroup-sizing-default" / >
                        </div>
                        <br>
                        <div class="d-grid gap-2">
                            <input class="btn btn-primary" type="submit" onclick="submitNewItem();" value="Submit"></input><br>
                        </div>
                    </div>
                </div>
            </div>

        <script>
        FilePond.registerPlugin(
        FilePondPluginFileEncode,
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform
        );

        FilePond.create(
            document.querySelector('input'),
            {
                labelIdle: `Drag & Drop a picture`,
                imagePreviewHeight: 400,
                imagePreviewWidth: 400,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 300,
                imageResizeTargetHeight: 300,
                stylePanelLayout: 'compact',
                styleLoadIndicatorPosition: 'center bottom',
                styleButtonRemoveItemPosition: 'center bottom',
                allowFileEncode: true,
            }
        );
        </script>
                <?php
                    include('./template/webloader_e.php');
                ?>
    </body>
</html>
