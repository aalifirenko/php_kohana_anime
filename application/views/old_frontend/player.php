<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Test Player Page</title>
    <link rel="stylesheet" href="<?php echo URL::base(true) ?>media/css/style.css" type="text/css" />

    <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/player.js"></script>
    <script type="text/javascript" src="<?php echo URL::base(true) ?>media/player/swfobject.js"></script>
</head>
<body>
    <?php
        $seriesJson = Model::factory('getdata')->getJsonSeries('2', '3');
    ?>
    <div class="container" style="margin-top: 50px; margin-left: 25%;">
    <div id="animenice_player" style="width: 615px; height: 375px">
        <div class="html5-playlist">
            <?php foreach ($seriesJson['html5']['playlist'] as $playlist): ?>
                <span class="playlist-item" data-src="<?php echo $playlist['file']; ?>"><?php echo $playlist['comment']; ?></span>
            <?php endforeach; ?>
        </div>
    </div>
    </div>
    <script type="text/javascript">
        var ua = navigator.userAgent.toLowerCase();
        if(ua.indexOf("iphone") != -1 || ua.indexOf("ipad") != -1 || ua.indexOf("android") != -1){
            $('#animenice_player').append('<video width="615" height="375" controls><source src="<?php echo $seriesJson['html5']['playlist'][0]['file']; ?>" type="video/mp4"></video>');
        }else{
                var flashvars = {m:"video",
                    "pl":'<?php echo $seriesJson['json']; ?>',
                    st: "<?php echo URL::base(true) ?>media/player/style/animenice.txt"
                };
                var params = {bgcolor:"#ffffff", wmode:"window", allowFullScreen:"true", allowScriptAccess:"always"};
                swfobject.embedSWF("<?php echo URL::base(true) ?>media/player/uppod.swf",
                    "animenice_player",
                    "615",
                    "375",
                    "10.0.0.0",
                    false, flashvars, params);
        }
    </script>
</body>
</html>