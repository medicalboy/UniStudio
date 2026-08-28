<?php echo form_open_multipart('upload/do_upload');?>
<html>
        <head>
            <title>INFS3202 Demo</title>
            <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css">
            <script src="<?php echo base_url(); ?>assets/js/jquery-3.6.0.min.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        </head>
<h3></h3>
<div class="main">
    <div class="modal modal-sheet position-static d-block bg-secondary py-5" tabindex="-1" role="dialog" id="modalSheet">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-6 shadow">
        <div class="modal-header border-bottom-0">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body py-0">
            <p>This is a modal sheet, a variation of the modal that docs itself to the bottom of the viewport like the newer share sheets in iOS.</p>
        </div>
        <div class="modal-footer flex-column border-top-0">
            <label for="files" class="btn">Select Image</label>
            <input type="file" class="btn btn-lg btn-primary w-100 mx-0 mb-2" />
            <input type="submit" class="btn btn-lg btn-light w-100 mx-0" data-bs-dismiss="modal" value="upload"/>
        </div>
        </div>
    </div>
    </div>
</div>
<?php echo form_close(); ?>
</html>