<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <link rel="stylesheet" href="<?php echo base_url() ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>css/adm-main.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>plugin/tinymce/skins/lightgray/skin.min.css">
</head>
<body>    
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel"></h4>
                </div>
                <div class="modal-body" id="modalBody"></div>
                <div class="alert alert-danger alert-dismissable hidden" id="modalError">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <p id="modalErrorP"></p>
                </div>
                <div class="modal-footer" id="modalFooter"></div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="container theme-showcase">