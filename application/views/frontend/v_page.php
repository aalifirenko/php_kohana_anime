<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title><?php if (isset($title)) echo $title; ?></title>

    <?php if (isset($meta)) echo $meta; ?>

    <link rel="stylesheet" type="text/css" href="<?php echo URL::base(true) ?>media/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo URL::base(true) ?>media/css/style.css" />
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <?php if (isset($additional_css)): ?>
        <?php foreach ($additional_css as $style): ?>
            <?php echo HTML::style($style); ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($script_list == 'serial'): ?>
        <script type="text/javascript" src="/media/js/jquery.js"></script>
    <?php endif; ?>

    <script type="text/javascript" data-main="/media/js/frontend/loader" src="<?php echo URL::base(true) ?>media/js/require/require-min.js"></script>
    <script type="text/javascript">
        window.baseUrl = "<?php echo URL::base(true); ?>";
        window.scriptList = "<?php if (isset($script_list)) echo $script_list; ?>";
    </script>
</head>
<body id="body">
<?php if (isset($content)) echo $content; ?>
<?php if (isset($footer)) echo $footer; ?>

<?php if (isset($plugins)) echo $plugins; ?>
</body>
</html>