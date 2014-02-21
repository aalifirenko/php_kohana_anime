<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Other extends Controller_Template {

    public $template = 'admin/v_page';

    public function before()
    {
        parent::before();

        if (!Auth::instance()->logged_in('admin'))
            Request::$initial->redirect(URL::base(true));
    }

    public function action_categoryserials()
    {
        if ($this->request->method() == "POST") {
            $data = $this->request->post();
            $serial_id = $data['serial_id'];
            $model = ORM::factory('serialcategory')->where('serial_id', '=', $serial_id)->find();

            if (!$model->loaded()) {
                $model = ORM::factory('serialcategory');
            } else {
                $model->delete();

                $model = ORM::factory('serialcategory');
            }

            $model->values($data);

            try {
                $model->save();
                Session::instance()->set('add_category', '1');
            } catch (Exception $e) {
                Session::instance()->set('add_category', '0');
            }
        }


        $this->template->title = "Категории сериалов";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_category_serials', array(
                'serials' => ORM::factory('serial')
                    ->order_by('id', 'DESC')
                    ->find_all()
            ))->render()
        ))->render();
    }

    public function action_getcategoryserials()
    {
        $id = $this->request->post('id');

        if ($id) {
            $getSerial = ORM::factory('serialcategory')
                ->where("serial_id", "=", $id)
                ->find();

            echo View::factory('admin/forms/v_category_serial_options', array('options' => $getSerial))->render();
        }

    }
}