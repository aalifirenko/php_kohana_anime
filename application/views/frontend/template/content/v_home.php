<div class="homepage-content">

    <div class="homepage-aninice-about inset-box-shadow">
        <span>
            AniNice - Это кинотеатр онлайн аниме сериалов. Здесь можно посмотреть новые аниме сериалы а также давно забытые хиты прошлых лет, в озвучке от лучших релизеров Рунета.
            Смотри также аниме онлайн на устройствах с Android и iOS
        </span>

        <div class="home-block">
            <div class="home-block-left span8">
                <div class="popular-anime span8">
                    <a class="home-anime-label" href="#">Популярное аниме</a>
                    <?php if ($popular_anime) echo $popular_anime; ?>
                </div>

                <div class="find-anime-panel no-loaded-pane">
                    <div class="find-panel-loader">
                        <img src="<?php echo URL::base(true); ?>media/image/loader.gif" />
                    </div>
                </div>

                <div class="bottom-seo-text">
                    Аниме- это то, что живет в наших сердцах! :)
                    Вы любите аниме онлайн ? Вы готовы смотреть его в любом месте и в любое время? Если да, то aninice.ru вам в этом поможет :)
                    У нас вы найдете как новинки аниме, так и аниме шедевры прошлых лет ;) На нашем сайте вы можете посмотреть свое любимое аниме онлайн совершенно бесплатно.
                    Создавая сайт, мы учитывали последние тенденции и ваши желания. Основная идея нашего онлайн аниме кинотеатра заключается в простоте и удобстве использования. Сделано все для комфортного просмотра любимых аниме сериалов, без лишних и ненужных элементов, и в дальнейшем будем добавлять только полезный и удобный функционал. У нас есть своя команда релизеров AniNice, поэтому на сайте очень быстро выкладываются новые серии.
                    Видеотека аниме находится в режиме постоянного пополнения. Вы можете посмотреть аниме онлайн любого жанра на устройствах с Android и iOS .
                    Желаем вам приятного просмотра :)
                </div>
            </div>

            <div class="home-block-right span3">
                <?php if (isset($rating)) echo $rating; ?>

                <?php if (isset($hot_ten)) echo $hot_ten; ?>

                <div class="banner">
                    <img src="/media/image/banner.gif" alt="лучшие аниме сериалы онлайн" />
                </div>
            </div>
        </div>
    </div>

</div>