<?php if (isset($serial)): ?>
<div class="serial">
    <div class="serial-left-block">
        <div class="serial-image-box">
            <img src="<?php echo $serial->img ?>" alt="смотреть аниме сериал онлайн" width="172" />
        </div>
        <div class="serial-rating">
            <?php if (Cookie::get('serial_' . $serial->id)): ?>
                <?php
                $ratingModel = ORM::factory('rating', $serial->id);
                $calcRating = round($ratingModel->sum / $ratingModel->count, 2);
                ?>
                <span class="calc-rating badge badge-orange">Рейтинг сериала: <?php echo $calcRating; ?></span>
            <?php else: ?>
                <span class="serial-rating-title">Ваша оценка сериалу</span>
                <span class="rating-block badge" data-serial="<?php echo $serial->id; ?>" data-rating="1">1</span>
                <span class="rating-block badge" data-serial="<?php echo $serial->id; ?>" data-rating="2">2</span>
                <span class="rating-block badge" data-serial="<?php echo $serial->id; ?>" data-rating="3">3</span>
                <span class="rating-block badge" data-serial="<?php echo $serial->id; ?>" data-rating="4">4</span>
                <span class="rating-block badge" data-serial="<?php echo $serial->id; ?>" data-rating="5">5</span>
                <span class="calc-rating badge badge-orange" style="display: none"></span>
            <?php endif; ?>
        </div>
    </div>
    <div class="serial-right-block">
        <h1 class="serial-title">
            <?php echo $serial->title_rus ?> (<?php echo $serial->title_orig ?>)

            <?php if (Request::$current->param('season_id')): ?>
                <?php $seasonTitle = ORM::factory('season', (int)Request::$current->param('season_id')); ?>
                <span class="serial-box-seaon-title"><h4><?php echo $seasonTitle->title; ?></h4></span>
            <?php endif; ?>
        </h1>

        <h3 class="serial-additional-title">Смотреть аниме онлайн, бесплатно и без регистрации</h3>

        <h2 class="serial-description">
            <?php echo $serial->description; ?>
        </h2>

        <div class="serial-params">
            <div class="serial-param-line">
                <span class="serial-param-title">Оригинал: </span>
                <span class="serial-param-val"><?php echo $serial->title_orig; ?></span>
            </div>

            <div class="serial-param-line">
                <span class="serial-param-title">Режиссер: </span>
                <span class="serial-param-val"><?php echo $serial->producer; ?></span>
            </div>

            <div class="serial-param-line">
                <span class="serial-param-title">Автор: </span>
                <span class="serial-param-val"><?php echo $serial->author; ?></span>
            </div>

            <div class="serial-param-line">
                <span class="serial-param-title">Жанр: </span>
                <span class="serial-param-val"><?php echo $serial->genre; ?></span>
            </div>

            <div class="serial-param-line">
                <span class="serial-param-title">Озвучил: </span>
                <span class="serial-param-val"><?php echo $serial->relizer; ?></span>
            </div>
        </div>

        <div class="see-anime-on-device">
            Смотри аниме онлайн на iPhone,iPad и на устройствах с Android.
            <img src="<?php echo URL::base(true) ?>media/image/serial-device.png" alt="смотри  <?php echo $serial->title_rus ?> (<?php echo $serial->title_orig ?>) онлайн на iphone,android" />
        </div>

        <?php if ($seasons): ?>
            <div class="serial-season-box">
                <?php foreach ($seasons as $season): ?>
                    <a href="<?php echo Route::url('view_serial_with_name', array(
                        'serial_id' => $serial->id,
                        'season_id' => $season->id,
                        'serial_name' => strtolower(str_replace(" ", "_", $serial->title_orig))
                    )); ?>
                " class="newbtn newbtn-default serial-season-item"><?php echo $season->title; ?></a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <?php if ($serial && $seasons): ?>
        <div class="animenice-player">
            <?php
            $seasonId = Request::$current->param('season_id') ? Request::$current->param('season_id')
                : ORM::factory('season')->where('serial_id', '=', $serial->id)->limit(1)->find()->id;
            $seriesJson = Model::factory('getdata')->getJsonSeries($serial->id, $seasonId);
            ?>
            <?php if (count($seriesJson['html5']) > 0): ?>
            <div id="animenice_player" style="width: 580px; height: 390px">
                <div class="html5-playlist">
                    <?php foreach ($seriesJson['html5']['playlist'] as $playlist): ?>
                        <span class="playlist-item" data-src="<?php echo $playlist['file']; ?>"><?php echo $playlist['comment']; ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function player_init() {
                var ua = navigator.userAgent.toLowerCase();
                if(typeof(navigator.plugins)!="undefined" && typeof(navigator.plugins["Shockwave Flash"])=="object"){
                    var flashvars = {m:"video",
                        "uid": "animenice_player",
                        "pl":'<?php echo $seriesJson['json']; ?>',
                        st: "<?php echo URL::base(true) ?>media/player/style/animenice.txt"
                    };
                    var params = {bgcolor:"#ffffff", wmode:"window", allowFullScreen:"true", allowScriptAccess:"always"};
                    swfobject.embedSWF("<?php echo URL::base(true) ?>media/player/uppod.swf",
                        "animenice_player",
                        "680",
                        "390",
                        "10.0.0.0",
                        false, flashvars, params);
                }else{
                    $('#animenice_player').append('<video width="560" height="375" controls><source src="<?php echo $seriesJson['html5']['playlist'][0]['file']; ?>" type="video/mp4"></video>');
                }
            }
        </script>
    <?php endif; ?>
        <div class="serial-like">
            <div class="vk-like">
                <?php echo Model::factory('getdata')->getVKLike(); ?>
            </div>
            <div class="facebook-like">
                <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo URL::base(true) . substr($_SERVER['REQUEST_URI'], 1); ?>;width=350&amp;height=21&amp;colorscheme=light&amp;layout=button_count&amp;action=like&amp;show_faces=true&amp;send=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:350px; height:21px;" allowTransparency="true"></iframe>
            </div>
            <div class="google-plus-like">
                <!-- Place this tag where you want the +1 button to render. -->
                <div class="g-plusone" data-annotation="inline" data-width="300"></div>

                <!-- Place this tag after the last +1 button tag. -->
                <script type="text/javascript">
                    window.___gcfg = {lang: 'ru'};

                    (function() {
                        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                        po.src = 'https://apis.google.com/js/plusone.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                    })();
                </script>
            </div>
        </div>
    </div>
    <?php endif; ?>
    </div>
<div class="serial-comment">
    <div id="mc-container"></div>
    <script type="text/javascript">
        var mcSite = '26172';
        (function() {
            var mc = document.createElement('script');
            mc.type = 'text/javascript';
            mc.async = true;
            mc.src = '//cackle.me/mc.widget-min.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(mc);
        })();
    </script>
    <a id="mc-link" href="http://cackle.me">Социальные комментарии <b style="color:#4FA3DA">Cackl</b><b style="color:#F65077">e</b></a>
</div>
</div>
<?php endif; ?>