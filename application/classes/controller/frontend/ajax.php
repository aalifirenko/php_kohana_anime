<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Ajax extends Controller {

    public function action_getserialbygenre()
    {
        if ($this->request->is_ajax()) {
            $genre = $this->request->post('genre');
            $genre = htmlspecialchars($genre, ENT_QUOTES);

            $serials = Model::factory('getdata')->getAllAnimeFiltered($genre);

            $html = View::factory('frontend/template/content/bloks/findAnimeSerials', array(
                'serials' => $serials
            ))->render();

            echo $html;
        }
    }

    public function action_getNewAnime()
    {
        if ($this->request->is_ajax()) {
            $newAnime = Model::factory('getdata')->getNewAnime();

            $html = View::factory('frontend/template/content/bloks/lineNewAnime', array(
                'model' => $newAnime
            ))->render();

            echo $html;
        }
    }

    public function action_getSerialDesc()
    {
        if ($this->request->is_ajax()) {
            $serialId = (int) $this->request->post('serial_id');

            if ($serialId) {
                $model = ORM::factory('serial', $serialId);
                echo UTF8::substr($model->description, 0, 300) . "...";
            }
        }
    }

    public function action_addrating()
    {
        if ($this->request->is_ajax()) {
            $data = $this->request->post();
            if ($data['serial_id'] && $data['rating']) {
                $serial_id = (int) $data['serial_id'];
                $rating = (int) $data['rating'];
                if ($serial_id == 0)
                    die('Bad param');
                $model = ORM::factory('rating', $serial_id);
                if (!$model->loaded()) {
                    $model = ORM::factory('rating');
                    $model->sum = $rating;
                    $model->count = 1;
                } else {
                    $model->sum += $rating;
                    $model->count++;
                }

                $model->serial_id = $data['serial_id'];
                $response = array();
                try {
                    $model->save();
                    $response['status'] = 'success';
                    $response['sum'] = $model->sum;
                    $response['count'] = $model->count;
                    COOKIE::set('serial_' . $serial_id, '1', 99999999);
                    echo json_encode($response);
                } catch (Exception $e) {
                    $response['status'] = 'error';
                    echo json_encode($response);
                }


            }
        }
    }
}