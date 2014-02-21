<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title><?php if (isset($title)) echo $title; ?></title>
        <link rel="stylesheet" href="<?php echo URL::base(true) ?>media/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo URL::base(true) ?>media/css/admin.css" />
        <link rel="stylesheet" href="<?php echo URL::base(true) ?>media/css/editor.css" />

        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/jquery.1.7.1.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/admin.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/editor.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/editor-plugin.js"></script>
        <script type="text/javascript">
            window.baseUrl = "<?php echo URL::base(true); ?>";
        </script>
    </head>
    <body>
        <?php if (isset($body)) echo $body; ?>
    </body>
</html>