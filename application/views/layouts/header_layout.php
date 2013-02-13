<!DOCTYPE html>
<html lang="ro-RO">
<head>
    <meta charset="utf-8">
    <title><?php echo !empty($title) ? $title : 'sedic' ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="<?php echo css_path('libs/codemirror.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_path('style_base.css') ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo css_path('libs/jquery-ui/jquery-ui-1.10.0.custom.min.css') ?>" rel="stylesheet" type="text/css">
    <script src="<?php echo js_path('libs/jquery-1.9.0.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo js_path('libs/jquery-ui-1.10.0.custom.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo js_path('libs/jquery.jscrollpane.min.js') ?>" type="text/javascript"></script>
    <script src="<?php echo js_path('libs/codemirror-compressed.js') ?>" type="text/javascript"></script>
    <script src="<?php echo js_path('scripts.js') ?>" type="text/javascript"></script>
</head>
<body>
    <div id="body" class="">
        <div id="wraper" class="">
            <a href="<?php echo base_url() ?>">
                <div id="header"> <p>Plante Medicinale si afectiuni tratate - sedic</p> </div>
            </a>
            <?php $this->load->view('layouts/top_nav_layout') ?>
