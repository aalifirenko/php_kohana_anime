<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Ajax extends Controller {

    public function action_getSeasonSelectBox()
	{
        $serial_id = $this->request->post('serial_id');
        echo View::factory('admin/selects/vs_season', array(
            'seasons' => ORM::factory('season')->where('serial_id', '=', $serial_id)->find_all(),
        ))->render();
	}

    public function action_getFileUpload()
    {
        echo View::factory('admin/selects/vs_fileupload')->render();
    }

    public function action_getSeasonSeries()
    {
        $post = $this->request->post();

        echo View::factory('admin/forms/v_list_series', array(
            'serial_id' => $post['serial_id'],
            'season_id' => $post['season_id'],
        ))->render();
    }

    public function action_savecomment()
    {
        $commentId = $this->request->post('id');
        $model = ORM::factory('comment', $commentId);
        $model->check = '0';
        $model->save();
    }

    public function action_deletecomment()
    {
        $commentId = $this->request->post('id');
        $model = ORM::factory('comment', $commentId);
        $model->delete();
    }

    public function action_deletenews()
    {
        $newsId = $this->request->post('id');
        $model = ORM::factory('news', $newsId);
        $model->delete();
    }

    public function action_deleteSeries()
    {
        $Id = $this->request->post('id');
        $model = ORM::factory('series', $Id);
        $model->delete();
    }

}