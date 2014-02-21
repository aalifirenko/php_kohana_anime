<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Login extends Controller_Template {

    public $template = 'admin/v_page';

    public function action_index()
	{
        $this->template->title = "Login to Anime-nice admin panel";
        $this->template->body = View::factory('admin/forms/v_login')->render();
	}

    public function action_login()
    {
        $data = $this->request->post();
        $auth = Auth::instance();

        if (HTTP_Request::POST == $this->request->method())
        {
            $statusAuth = $auth->login($data['username'], $data['password']);
            if (!$statusAuth) {
                Session::instance()->set('auth_error', '1');
                Request::factory()->redirect(URL::base() . "adminka");
            } else {
                Request::factory()->redirect(URL::base() . "admin");
            }
        }
    }

}