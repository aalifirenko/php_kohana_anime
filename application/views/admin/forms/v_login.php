<div class="admin-login-box">
    <?php if (Session::instance()->get_once('auth_error') == '1'): ?>
        <div class="alert alert-error">
            Логин или пароль неверный!
        </div>
    <?php endif; ?>
    <form class="form-horizontal" action="<?php echo URL::base(true) ?>adminka/login" method="POST">
        <div class="control-group">
            <label class="control-label" for="inputEmail">Логин</label>
            <div class="controls">
                <input type="text" id="inputEmail" name="username" placeholder="логин">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Пароль</label>
            <div class="controls">
                <input type="password" name="password" id="inputPassword" placeholder="пароль">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn">Войти</button>
            </div>
        </div>
    </form>
</div>