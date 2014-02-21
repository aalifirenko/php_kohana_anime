<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
    <head>
        <title><?php if (isset($title)) echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo URL::base(true) ?>media/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL::base(true) ?>media/bootstrap/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo URL::base(true) ?>media/css/style.css" />
        <?php if (isset($additional_css)): ?>
            <?php foreach ($additional_css as $style): ?>
                <?php echo HTML::style($style); ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <link href='http://fonts.googleapis.com/css?family=PT+Sans&subset=latin,cyrillic' rel='stylesheet' type='text/css'>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="<?php if (isset($keyword)) echo $keyword; ?>" />
        <meta name="description" content="<?php if (isset($description)) echo $description; ?>" />
        <link rel="shortcut icon" href="favicon.png" type="image/png">

        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/player.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/player/swfobject.js"></script>
        <script type="text/javascript" src="<?php echo URL::base(true) ?>media/js/frontend.js"></script>
        <?php if (isset($additional_script)): ?>
            <?php foreach ($additional_script as $script): ?>
                <?php echo HTML::script($script); ?>
            <?php endforeach; ?>
        <?php endif; ?>
        <script type="text/javascript">
            window.baseUrl = "<?php echo URL::base(true); ?>";
        </script>
    </head>
    <body id="body" class="poster" style="background-image: url('../../../media/posters/<?php if (isset($poster)) echo $poster; ?>')">

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner aninice-top-menu">
            <div class="container">
            <ul class="nav">
                <li><a href="<?php echo URL::base(true) ?>">Главная</a></li>
                <li><a href="<?php echo URL::base(true) ?>about-us">О Нас</a></li>
                <li><a href="<?php echo URL::base(true) ?>relise">Релизы</a></li>
                <li><a href="<?php echo URL::base(true) ?>all-blogs">Блог</a></li>
            </ul>
            <ul class="nav top-nav-right-list">
                <?php if (isset($top_menu_auth)) echo $top_menu_auth; ?>
            </ul>
            </div>
        </div>
    </div>

    <div class="container main-layout">
            <div class="logo" title="AniNice">
                <a href="<?php echo URL::base(true); ?>"><img src="<?php echo URL::base(true); ?>media/image/logo.png" /></a>
            </div>
            <div class="left-sidebar">
                <?php if (isset($sidebar)) echo $sidebar; ?>
            </div>

            <div class="right-block">
                <div class="social-share-block">
                    <script type="text/javascript">(function() {
                            if (window.pluso)if (typeof window.pluso.start == "function") return;
                            var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                            s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                            s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                            var h=d[g]('head')[0] || d[g]('body')[0];
                            h.appendChild(s);
                        })();</script>
                    <div class="pluso" data-options="medium,square,line,vertical,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print" data-background="transparent"></div>
                </div>
                <div class="right-menu">
                    <a href="<?php echo URL::base(true); ?>all-anime" class="right-menu-item" style="margin-left: 0"><span>По Жанру</span></a>
                    <a href="<?php echo URL::base(true); ?>popular" class="right-menu-item"><span>Популярное</span></a>
                    <a href="<?php echo URL::base(true) ?>new-anime" class="right-menu-item"><span>Новинки</span></a>
                    <a href="<?php echo URL::base(true) ?>hits" class="right-menu-item"><span>Хиты</span></a>
                    <a href="<?php echo URL::base(true) ?>ongoing" class="right-menu-item"><span>Онгоинги</span></a>
                    <a href="<?php echo URL::base(true) ?>rating" class="right-menu-item"><span>По Рейтингу</span></a>
                </div>

                <div class="right-block-content">
                    <?php if (isset($content)): ?>
                        <?php foreach ($content as $block): ?>
                            <div class="right-block-content-item">
                                <?php echo $block; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="right-block-footer">
                    <span>Все права защищены <a href="http://www.aninice.ru">aninice.ru</a> </span>
                    <ul class="footer-menu">
                        <li><a href="<?php echo URL::base(true); ?>">главная</a></li>
                        <li><a href="<?php echo URL::base(true) ?>about-us">о нас</a></li>
                        <li><a href="<?php echo URL::base(true) ?>new-anime">новинки</a></li>
                        <li><a href="<?php echo URL::base(true) ?>relise">релизы</a></li>
                    </ul>
                </div>
            </div>
        </div>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter22033432 = new Ya.Metrika({id:22033432,
                        webvisor:true,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true});
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="//mc.yandex.ru/watch/22033432" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <!-- Reformal -->
    <script type="text/javascript">
        var reformalOptions = {
            project_id: 155223,
            project_host: "aninice.reformal.ru",
            tab_orientation: "left",
            tab_indent: "50%",
            tab_bg_color: "#ed9b28",
            tab_border_color: "#FFFFFF",
            tab_image_url: "http://tab.reformal.ru/T9GC0LfRi9Cy0Ysg0Lgg0L%252FRgNC10LTQu9C%252B0LbQtdC90LjRjw==/FFFFFF/2a94cfe6511106e7a48d0af3904e3090/left/1/tab.png",
            tab_border_width: 2
        };

        (function() {
            var script = document.createElement('script');
            script.type = 'text/javascript'; script.async = true;
            script.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'media.reformal.ru/widgets/v3/reformal.js';
            document.getElementsByTagName('head')[0].appendChild(script);
        })();
    </script>
    <noscript><a href="http://reformal.ru"><img src="http://media.reformal.ru/reformal.png" /></a><a href="http://aninice.reformal.ru">Oтзывы и предложения для AniNice</a></noscript>
    </body>
</html>