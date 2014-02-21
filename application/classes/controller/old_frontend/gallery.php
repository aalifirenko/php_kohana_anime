<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Gallery extends Controller_Template {

    public $template = "frontend/v_gallery";

    public function action_index()
    {
        $this->template->pictures = ORM::factory('pictures')
            ->order_by('id', 'DESC')
            ->find_all();
    }

}