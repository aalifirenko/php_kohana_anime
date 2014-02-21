<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Auth extends Controller {

    public function action_checkEmail()
    {
        if ($this->request->is_ajax()) {
            $email = $this->request->post('email');
            $userModel = ORM::factory('user');

            echo $userModel
                ->where('email', '=', $email)
                ->count_all();
        }
    }

    public function action_login()
    {
        $data = $this->request->post();
        $auth = Auth::instance();

        if ($this->request->is_ajax())
        {
            $statusAuth = $auth->login($data['email'], $data['password'], $data['rememberme']);
            if (!$statusAuth) {
                echo "false";
            } else
                echo "success";
        }
    }

    public function action_logout()
    {
        $auth = Auth::instance();
        $auth->logout();
        $this->request->redirect(Route::get('default')->uri());
    }

    public function action_register()
    {
        if ($this->request->is_ajax()) {
            $post = $this->request->post();

            // Array for database
            $data = array(
                'username'      => $post['email'],
                'email'          => $post['email'],
                'password'          => $post['password'],
                'password_confirm'  => $post['confirm_password'],
                'full_name' => $post['nick']
            );
            // Set server validation
            $dataValidate = Validation::factory($data);
            $dataValidate->rule('email', 'not_empty');
            $dataValidate->rule('email', 'max_length', array(':value', '100'));
            $dataValidate->rule('password', 'not_empty');
            $dataValidate->rule('password', 'min_length', array(':value', '6'));
            $dataValidate->rule('password', 'max_length', array(':value', '64'));
            $dataValidate->rule('full_name', 'max_length', array(':value', '200'));

            if (isset($post['check_robot']) && $post['check_robot'] == 'on') {
                if ($dataValidate->check()) {
                    try{
                        $users = ORM::factory('user');
                        $users->create_user($data, array(
                            'email',
                            'password',
                            'username',
                            'full_name'
                        ));
                        $role = ORM::factory('role')->where('name', '=', 'login')->find();
                        $users->add('roles', $role);

                        // Authorization new user
                        $auth = Auth::instance();
                        $auth->login($data['email'], $data['password'], false);

                        echo "true";
                    } catch (ORM_Validation_Exception $e) {
                        echo "failed create user";
                    }
                } else {
                    echo "false validate";
                }
            } else {
                echo "false check robot";
            }
        }
    }

}