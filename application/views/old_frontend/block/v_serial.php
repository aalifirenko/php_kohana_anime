<?php if (isset($serial)): ?>
<div class="serial-box">
    <span class="serial-box-title"><h4 class="color-black"><?php echo $serial->title_rus ?> (<?php echo $serial->title_orig ?>)</h4></span>
    <?php if (Request::$current->param('season_id')): ?>
        <?php $seasonTitle = ORM::factory('season', (int)Request::$current->param('season_id')); ?>
        <span class="serial-box-seaon-title"><h4><?php echo $seasonTitle->title; ?></h4></span>
    <?php endif; ?>
    <div style="margin-top: 20px">
        <div class="serial-preview">
            <img src="<?php echo $serial->img ?>" width="220" />
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
        <div class="serial-desc">
            <span class="serial-important-info"><strong class="color-black">Оригинал: </strong><?php echo $serial->title_orig; ?></span>
            <span class="serial-desc-text"><?php echo $serial->description; ?></span>

            <div style="margin-top: 20px; float: left">
            <span class="serial-important-info"><strong class="color-black">Режиссер: </strong><?php echo $serial->producer; ?></span>
            <span class="serial-important-info"><strong class="color-black">Автор: </strong><?php echo $serial->author; ?></span>
            <span class="serial-important-info"><strong class="color-black">Жанр: </strong><?php echo $serial->genre; ?></span>
            <span class="serial-important-info"><strong class="color-black">Озвучил: </strong><?php echo $serial->relizer; ?></span>
            </div>
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
            <button type="button" class="newbtn newbtn-primary" id="remember-serial" data-serial="<?php echo $serial->id; ?>">Запомнить сериал</button>
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
                var ua = navigator.userAgent.toLowerCase();
                if(ua.indexOf("iphone") != -1 || ua.indexOf("ipad") != -1 || ua.indexOf("android") != -1){
                    $('#animenice_player').append('<video width="560" height="375" controls><source src="<?php echo $seriesJson['html5']['playlist'][0]['file']; ?>" type="video/mp4"></video>');
                }else{
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
    <div class="serial-comment">
        <input type="hidden" id="serial_id" value="<?php echo Request::$current->param('serial_id'); ?>" />
        <input type="hidden" id="season_id" value="<?php echo $seasonId; ?>" />
        <h4>Комментарии</h4>
        <div class="comment-list">
            <?php if (isset($comments)):  ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="comment-item">
                        <span style="float:left;"><img src="<?php echo $comment->avatar; ?>" width="80" /></span>
                        <div class="comment-item-head">
                            <span class="item-nick"><?php echo $comment->name; ?></span>
                            <span class="item-date"><?php echo $comment->created; ?></span>
                        </div>
                        <div class="comment-item-body">
                            <?php echo $comment->text; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="comment-add">
            <?php if (Auth::instance()->logged_in()): ?>
                <?php
                    $userName = Auth::instance()->get_user()->full_name;
                    $userAvatar = isset(Auth::instance()->get_user()->avatar) ? Auth::instance()->get_user()->avatar : URL::base(true) . "media/image/user/default.png";
                ?>
                <input type="hidden" id="comment-name" value="<?php echo $userName; ?>" />
                <input type="hidden" id="comment-avatar" value="<?php echo $userAvatar; ?>" />
                <label>Ваш комментарий: <em style="color: red">*</em></label>
                <textarea id="comment-add"></textarea>
                <div id="comment-status" style="float: left;"></div>
                <button id="comment-add-action" class="btn btn-primary">Добавить</button>
            <?php else: ?>
                <p>Чтобы оставлять комментарии вам нужно авторизоватся
                </p>
            <?php endif; ?>
        </div>
    </div>
    </div>
<?php endif; ?>