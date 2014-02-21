<?php if (!Auth::instance()->logged_in()): ?>
    <li>
        <a id="top-nav-login-btn" href="#">Войти</a>
        <script type="text/template" id="top-login-form-template">
            <div class="top-login-errors alert alert-error" style="display: none"></div>
            <div class="top-login-box">
                <input class="span3" id="login-email-field" placeholder="email.." type="text" name="username">
                <input class="span3" id="login-password-field" placeholder="пароль.." type="password" name="password">
                <label class="checkbox">
                    <input type="checkbox" id="top-login-rememberme" name="remember" value="1"> Запомнить меня
                </label>
                <button class="btn-info btn action-login" type="submit">Войти</button>
            </div>
        </script>
    </li>
    <li><a id="top-nav-register-btn" href="#">Регистрация</a></li>
    <script type="text/template" id="top-register-form-template">
        <div class="top-register-errors alert alert-error" style="display: none"></div>
        <div class="top-login-box">
            <input class="span3" id="top-validate-email" name="email" placeholder="ваш email.." type="text">
            <input class="span3" id="top-validate-password" name="password" placeholder="пароль.." type="password">
            <input class="span3" id="top-validate-repeat" name="repeat" placeholder="еще раз пароль.." type="password">
            <input class="span3" id="top-validate-nick" name="full_name" placeholder="ваш ник" type="text">
            <div class="robot-detection"><input type="checkbox" id="check_robot" /> <span>я не робот</span></div>
            <button id="top-register-btn" class="btn btn-info" type="submit">Зарегистрировать</button>
        </div>
    </script>
<?php else: ?>
    <li class="top-menu-profile">
        <i class="top-profile icon-user icon-white"></i>
        <a href="#" class="dropdown-toggle top-account-title" data-toggle="dropdown">Мой аккаунт</a>
        <span class="caret" style="float: left; margin-top: 19px; border-top: 4px solid #fff;"></span>
        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
            <li><a href="#" style="color: #999;">Профиль</a></li>
            <li>
                <a href="<?php echo URL::base(true) ?>auth/logout">Выйти</a>
            </li>
        </ul>
    </li>
<?php endif; ?>