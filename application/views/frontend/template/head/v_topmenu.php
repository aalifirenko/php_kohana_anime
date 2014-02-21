<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <ul class="nav top-menu-left-list">
                <li class="logo"><a href="<?php echo URL::base(true); ?>"><img src="<?php echo URL::base(true); ?>media/image/new_design/logo.png" alt="смотреть аниме онлайн" /></a></li>
                <li class="top-menu-item"><a href="<?php echo URL::base(true); ?>">Главная</a></li>
                <li class="top-menu-item"><a href="<?php echo URL::base(true); ?>all-blogs">Блог</a></li>
                <li class="top-menu-item"><a href="<?php echo URL::base(true); ?>about-us">О Нас</a></li>
            </ul>
            <ul class="nav top-menu-right-list">
                <li>
                    <div class="auth-search-block">
                        <span class="top-menu-auth-label login">Войти</span>
                        <span class="top-menu-auth-label">Регистрация</span>
                        <div class="search-box">
                            <form class="form-search top-menu-search" action="<?php echo URL::base(true) ?>search" method="GET">
                                <input type="text" class="sidebar-live-search input-medium search-query" name="query" placeholder="поиск...">
                                <span class="sidebar-icon-search icon-search"></span>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>