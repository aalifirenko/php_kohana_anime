<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Ulogin extends Controller {

    public function action_index()
    {
        Ulogin::factory()->login();
        Session::instance()->set('user_avatar', Auth::instance()->get_user()->avatar);
        Session::instance()->set('user_name', Auth::instance()->get_user()->full_name);
        $this->request->redirect(URL::base(true));
    }

    public function action_logout()
    {
        Auth::instance()->logout();
        $this->request->redirect(URL::base(true));
    }

    public function action_userblock()
    {
        if ($this->request->post('operation')) {
            Session::instance()->set('userblock', $this->request->post('operation'));
        }
    }

}