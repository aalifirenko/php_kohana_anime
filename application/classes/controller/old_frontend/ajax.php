<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Ajax extends Controller {

    public function action_filterbygenre()
    {
        if ($this->request->is_ajax()) {
            $genre = $this->request->post('genre');
            $genre = htmlspecialchars($genre, ENT_QUOTES);

            $totalItem = ORM::factory('serialcategory')
                ->where($genre, '=', '1')
                ->count_all();
            $pagination = Pagination::factory(array('total_items' => $totalItem));
            $serials = Model::factory('getdata')->getAllAnimeFiltered($genre, $pagination->items_per_page, $pagination->offset);

            $html = View::factory('frontend/page/filterable', array(
                'serials' => $serials,
                //'pagination' => $pagination,
            ))->render();

            echo $html;
        }
    }


    public function action_rememberserial()
    {
        if ($this->request->is_ajax()) {
            $id = (int)$this->request->post('id');

            if ($id) {
                Cookie::set('serial', $id, Date::YEAR);
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

    public function action_findbyrating()
    {
        if ($this->request->is_ajax()) {
            $data = $this->request->post();
            if ($data['first'] && $data['last']) {
                $data['first'] = (int) $data['first'];
                $data['last'] = (int) $data['last'];
                $serials = Model::factory('getdata')->getSerialByRating($data['first'], $data['last']);

                $html = View::factory('frontend/page/filterable', array(
                    'serials' => $serials,
                    'is_rating' => true,
                ))->render();

                echo $html;
            }
        }
    }

    public function action_addcomment()
    {
        if ($this->request->is_ajax()) {
            $serial_id = (int)$this->request->post('serial_id');
            $season_id = (int)$this->request->post('season_id');
            $name = $this->request->post('name');
            $avatar = $this->request->post('avatar');
            $text = $this->request->post('text');

            if ((strtolower($name) == 'aninice' || strtolower($name) == 'animenice' || strtolower($name) == 'anime nice')
                && !Auth::instance()->logged_in('admin')) {
                echo "bad_nick";
                return;
            }

            if (is_integer($serial_id) && $serial_id > 0 && is_integer($season_id) && $season_id > 0) {
                $name = $this->_stripSomeTags($name);
                $text = $this->_stripSomeTags($text);
                $name = htmlspecialchars($name, ENT_QUOTES);
                $text = htmlspecialchars($text, ENT_QUOTES);
                $date = date('Y-m-d H:i:s');

                $model = ORM::factory('comment');
                $model->serial_id = $serial_id;
                $model->season_id = $season_id;
                $model->name = $name;
                $model->avatar = $avatar;
                $model->text = $text;
                $model->created = $date;
                $model->check = '1';

                try {
                    $model->save();
                    COOKIE::set('name', $name, 99999999);
                    $renderComment  = '<div class="comment-item">';
                    $renderComment .= '<span style="float:left;"><img src=" '. $avatar .'" width="80" /></span>';
                    $renderComment .= '<div class="comment-item-head">';
                    $renderComment .= '<span class="item-nick">' . $name . '</span>';
                    $renderComment .= '<span class="item-date">' . $date . '</span>';
                    $renderComment .= '</div><div class="comment-item-body">';
                    $renderComment .= $text . '</div></div>';
                    echo $renderComment;
                }
                catch (Exception $e) {
                    echo "false";
                }
            } else {
                echo "false";
            }
        }
    }

    private function _stripSomeTags($input)
    {
      $taglist=array( "iframe", "script", "style", "embed", "object" );
      $output=$input;
      foreach ($taglist as $thistag) {
        if (preg_match('/^[a-z]+$/i', $thistag)) {
          $patterns=array(
            '/' . "<".$thistag."\/?>" . '/',
            '/' . "<\/".$thistag.">" . '/'
          );
        } else
        if (preg_match('/^<[a-z]+>$/i', $thistag)) {
            $patterns=array(
                '/' . str_replace('>', "?>", $thistag) . '/',
                '/' . str_replace('<', "<\/?", $thistag) . '/'
            );
        }
        else {
            $patterns=array();
        }
            $output=preg_replace($patterns, "", $output);
        }
        return $output;
    }

}