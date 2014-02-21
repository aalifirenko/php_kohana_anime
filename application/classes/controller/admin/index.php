<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Index extends Controller_Template {

	public $template = 'admin/v_page';

    public function before()
    {
        parent::before();

        if (!Auth::instance()->logged_in('admin'))
            Request::$initial->redirect(URL::base(true));
    }

    public function action_index()
	{
        $this->template->title = "Admin Panel Anime-nice";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_serials', array(
                'relizers' => ORM::factory('relizer')->find_all(),
                'serials' => View::factory('admin/forms/v_list_serials', array(
                    'serials' => ORM::factory('serial')->find_all()
                )),
            ))->render()
        ))->render();
	}

    public function action_serials()
	{
        $this->template->title = "Сериалы";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_serials', array(
                'relizers' => ORM::factory('relizer')->find_all(),
                'v_serials' => View::factory('admin/forms/v_list_serials', array(
                    'serials' => ORM::factory('serial')->find_all()
                )),
            ))->render()
        ))->render();
	}

    public function action_seasons()
    {
        $this->template->title = "Сезоны";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_season', array(
                'serials' => ORM::factory('serial')->find_all(),
                'list' => View::factory('admin/forms/v_list_season', array(
                    'serials' => ORM::factory('serial')
                        ->order_by('id', 'DESC')
                        ->find_all(),
                ))->render(),
            ))->render()
        ))->render();
    }

    public function action_slider()
    {
        $this->template->title = "Слайдер";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_slider', array(
                'slides' => ORM::factory('slider')->find_all(),
            ))->render()
        ))->render();
    }

    public function action_comments()
    {
        $this->template->title = "Комментарии";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_comments', array(
                'comments' => ORM::factory('comment')
                    ->where('check', '=', '1')
                    ->find_all(),
            ))->render()
        ))->render();
    }

    public function action_addnews()
    {
        if ($this->request->method() == 'POST') {
            $text = $this->request->post('news');
            if ($text) {
                $file_path = $_SERVER['DOCUMENT_ROOT'] . '/media/image/news/';
                if (move_uploaded_file($_FILES['img']['tmp_name'], $file_path . $_FILES['img']['name'])) {
                    $model = ORM::factory('news');
                    $model->set('news', $text);
                    $model->set('img', URL::base(true) . "media/image/news/" . $_FILES['img']['name']);
                    $model->set('date', date('Y-m-d H:i:s'));

                    try {
                        $model->save();
                        Session::instance()->set('add_news', '1');
                    }
                    catch (Exception $e) {
                        Session::instance()->set('add_news', '0');
                    }
                }
            } else {
                Session::instance()->set('add_news', '0');
            }
        }

        $this->template->title = "Новости";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_news', array(
                'news_list' => View::factory('admin/forms/v_list_news', array(
                    'news' => ORM::factory('news')->find_all()
                ))->render()
            ))->render()
        ))->render();
    }

    public function action_blog()
    {
        if ($this->request->method() == 'POST') {
            $data = $this->request->post();
            $data['date'] = date('Y-m-d H:i:s');
            if ($data) {
                $file_path = $_SERVER['DOCUMENT_ROOT'] . '/media/image/blog/';
                if (move_uploaded_file($_FILES['img']['tmp_name'], $file_path . $_FILES['img']['name'])) {
                    $data['img'] = URL::base(true) . "media/image/blog/" . $_FILES['img']['name'];
                    $model = ORM::factory('blog');
                    $model->values($data);

                    try {
                        $model->save();
                        Session::instance()->set('add_news', '1');
                    }
                    catch (Exception $e) {
                        Session::instance()->set('add_news', '0');
                    }
                }
            } else {
                Session::instance()->set('add_news', '0');
            }
        }

        $this->template->title = "Блог";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_blog', array(
                'blog_list' => View::factory('admin/forms/v_list_blog', array(
                    'blogModel' => ORM::factory('blog')->find_all()
                ))->render()
            ))->render()
        ))->render();
    }

    public function action_editblog()
    {
        $blogId = $this->request->param('id');
        if ($blogId) {
        if ($this->request->method() == 'POST') {
            $data = $this->request->post();
            $data['date'] = date('Y-m-d H:i:s');
            if ($data) {
                if (isset($_FILES['img']['name'])) {
                    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/media/image/blog/';
                    if (move_uploaded_file($_FILES['img']['tmp_name'], $file_path . $_FILES['img']['name'])) {
                        $data['img'] = URL::base(true) . "media/image/blog/" . $_FILES['img']['name'];
                    }
                }
                $model = ORM::factory('blog', $blogId);
                $model->values($data);

                try {
                    $model->save();
                    Session::instance()->set('add_news', '1');
                }
                catch (Exception $e) {
                    Session::instance()->set('add_news', '0');
                }
            } else {
                Session::instance()->set('add_news', '0');
            }
        }

        $this->template->title = "Редактировать Блог";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_editblog', array(
                'model' => ORM::factory('blog', $blogId)
            ))->render()
        ))->render();
        }
    }

    public function action_editnews()
    {
        $news_id = $this->request->param('id');
        if ($this->request->method() == 'POST') {
            $text = $this->request->post('news');
            if ($text) {
                $model = ORM::factory('news', $news_id);
                $model->set('news', $text);
                $model->set('date', date('Y-m-d H:i:s'));

                if ($_FILES['img']['name']) {
                    $file_path = $_SERVER['DOCUMENT_ROOT'] . '/media/image/news/';
                    move_uploaded_file($_FILES['img']['tmp_name'], $file_path . $_FILES['img']['name']);
                    $model->set('img', URL::base(true) . "media/image/news/" . $_FILES['img']['name']);
                }

                try {
                    $model->save();
                    Session::instance()->set('add_news', '1');
                }
                catch (Exception $e) {
                    Session::instance()->set('add_news', '0');
                }
            } else {
                Session::instance()->set('add_news', '0');
            }
        }

        $this->template->title = "Редактировать Новости";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_editnews', array(
                'news' => ORM::factory('news', $news_id)
            ))->render()
        ))->render();
    }

    public function action_relise()
    {
        if ($this->request->method() == 'POST') {
            $text = $this->request->post('text');
            if ($text) {
                $model = ORM::factory('relise', 1);
                $model->text = $text;

                try {
                    $model->save();
                    Session::instance()->set('add_relise', '1');
                    Request::$initial->redirect(URL::base(true) . "admin/relise");
                }
                catch (Exception $e) {
                    Session::instance()->set('add_relise', '0');
                    Request::$initial->redirect(URL::base(true) . "admin/relise");
                }
            }
        }


        $this->template->title = "Страницы Релизы";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_relise', array(
                'relise' => ORM::factory('relise', 1)
            ))->render()
        ))->render();
    }

    public function action_seriya()
    {
        $this->template->title = "Серии";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_series', array(
                'serials' => ORM::factory('serial')
                    ->order_by('id', 'DESC')
                    ->find_all(),
            ))->render()
        ))->render();
    }

    public function action_poster()
    {
        $this->template->title = "Постер";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_poster', array(
                'list_posters' => View::factory('admin/forms/v_list_posters', array(
                    'posters' => ORM::factory('poster')
                        ->order_by('hour', 'ASC')
                        ->find_all()
                ))->render()
            ))->render()
        ))->render();
    }

    public function action_relizer()
    {
        $this->template->title = "Добавить релизера";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_relizers', array(
                'list' => View::factory('admin/forms/v_list_relizers', array(
                    'relizers' => ORM::factory('relizer')->find_all()
                ))->render()
            ))->render()
        ))->render();
    }

    public function action_addrelizer()
    {
        $relizer = $this->request->post('relizer');

        if ($relizer) {
            $model = ORM::factory('relizer');
            $model->set('title', $relizer);

            try {
                $model->save();
                Session::instance()->set('add_relizer', '1');
                Request::$initial->redirect(URL::base(true) . "admin/relizer");
            }
            catch (Exception $e) {
                Session::instance()->set('add_relizer', '0');
                Request::$initial->redirect(URL::base(true) . "admin/relizer");
            }
        }
    }

    public function action_addslide()
    {
        $post = $this->request->post();

        if ($post) {
            $file_path = $_SERVER['DOCUMENT_ROOT'] . '/media/slider/';
            if (move_uploaded_file($_FILES['img']['tmp_name'], $file_path . $_FILES['img']['name'])) {
                $model = ORM::factory('slider');
                $model->set('img', URL::base(true) . "media/slider/" . $_FILES['img']['name']);
                if (isset($post['desc']) && $post['desc'] != '')
                    $model->desc = $post['desc'];
                    $model->link = $post['link'];
                    $model->day = $post['day'];

                try {
                    $model->save();
                    Session::instance()->set('add_slide', '1');
                    Request::$initial->redirect(URL::base(true) . "admin/slider");
                }
                catch (Exception $e) {
                    Session::instance()->set('add_slide', '0');
                    Request::$initial->redirect(URL::base(true) . "admin/slider");
                }
            }

        } else {
            Request::$initial->redirect(URL::base(true) . "admin/slider");
        }
    }

    public function action_addseason()
    {
        $post = $this->request->post();

        if ($post) {
            $model = ORM::factory('season');
            $model->set('serial_id', $post['serial']);
            $model->set('title', $post['title']);

            try {
                $model->save();
                Session::instance()->set('add_season', '1');
                Request::$initial->redirect(URL::base(true) . "admin/seasons");
            }
            catch (Exception $e) {
                Session::instance()->set('add_season', '0');
                Request::$initial->redirect(URL::base(true) . "admin/seasons");
            }
        }
    }

    public function action_addposter()
    {
            $file_path = $_SERVER['DOCUMENT_ROOT'] . '/media/posters/';
            if (move_uploaded_file($_FILES['poster']['tmp_name'], $file_path . $_FILES['poster']['name'])) {
                $model = ORM::factory('poster');
                $model->set('filename', $_FILES['poster']['name']);
                $model->set('hour', $this->request->post('hour'));

                try {
                    $model->save();
                    Session::instance()->set('add_poster', '1');
                    Request::$initial->redirect(URL::base(true) . "admin/poster");
                }
                catch (Exception $e) {
                    Session::instance()->set('add_poster', '0');
                    Request::$initial->redirect(URL::base(true) . "admin/poster");
                }
            }
    }

    public function action_delrelizer()
    {
        $relized_id = $this->request->param('id');
        if ($relized_id) {
            $model = ORM::factory('relizer', $relized_id);
            try {
                $model->delete();
                Request::$initial->redirect(URL::base(true) . "admin/relizer");
            }
            catch (Exception $e) {
                Request::$initial->redirect(URL::base(true) . "admin/relizer");
            }
        }
    }

    public function action_delseason()
    {
        $seasonId = $this->request->param('id');
        if ($seasonId) {
            $model = ORM::factory('season', $seasonId);
            try {
                $model->delete();
                Request::$initial->redirect(URL::base(true) . "admin/seasons");
            }
            catch (Exception $e) {
                Request::$initial->redirect(URL::base(true) . "admin/seasons");
            }
        }
    }

    public function action_delposter()
    {
        $poster_id = $this->request->param('id');
        if ($poster_id) {
            $model = ORM::factory('poster', $poster_id);
            try {
                $model->delete();
                Request::$initial->redirect(URL::base(true) . "admin/poster");
            }
            catch (Exception $e) {
                Request::$initial->redirect(URL::base(true) . "admin/poster");
            }
        }
    }

    public function action_delslide()
    {
        $slide_id = $this->request->param('id');
        if ($slide_id) {
            $model = ORM::factory('slider', $slide_id);
            try {
                $model->delete();
                Request::$initial->redirect(URL::base(true) . "admin/slider");
            }
            catch (Exception $e) {
                Request::$initial->redirect(URL::base(true) . "admin/slider");
            }
        }
    }

    public function action_editserial()
    {
        $id = $this->request->param('id');

        if ($this->request->method() == 'POST') {
            $post = $this->request->post();
            $isImage = false;

            // Set and Save data
            $model = ORM::factory('serial', $id);

            if ($_FILES['img']['name']) {
                $img_path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "media" . DIRECTORY_SEPARATOR . "serials_image" . DIRECTORY_SEPARATOR;
                $img_path .= $_FILES['img']['name'];

                if (move_uploaded_file($_FILES['img']['tmp_name'], $img_path)) {
                    $post['img'] = URL::base(true) . "media/serials_image/" . $_FILES['img']['name'];
                    $isImage = true;
                }
            }

            $model->title_rus = $post['title_rus'];
            $model->title_orig = $post['title_orig'];
            $model->genre = $post['genre'];
            $model->producer = $post['producer'];
            $model->author = $post['author'];
            $model->relizer = $post['relizer'];
            $model->description = $post['description'];
            if ($isImage == true)
                $model->img = $post['img'];

            try {
                $model->save();
                Session::instance()->set('add_serial', '1');
            } catch(Exception $e) {
                Session::instance()->set('add_serial', '0');
            }
        }

        $this->template->title = "Редактировать сериал";
        $this->template->body = View::factory('admin/v_layout', array(
            'content' => View::factory('admin/forms/v_edit_serials', array(
                'serial' => ORM::factory('serial', $id),
                'relizers' => ORM::factory('relizer')->find_all(),
            ))->render()
        ))->render();
    }

    public function action_addserial()
    {
        if ($this->request->method() == 'POST') {
            $post = $this->request->post();

            // Set and Save data
            $model = ORM::factory('serial');

            if ($_FILES['img']['name']) {
                $img_path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "media" . DIRECTORY_SEPARATOR . "serials_image" . DIRECTORY_SEPARATOR;
                $img_path .= $_FILES['img']['name'];

                if (move_uploaded_file($_FILES['img']['tmp_name'], $img_path)) {
                    $post['img'] = URL::base(true) . "media/serials_image/" . $_FILES['img']['name'];
                }
            }

            if (isset($post['img'])) {
                $model->title_rus = $post['title_rus'];
                $model->title_orig = $post['title_orig'];
                $model->genre = $post['genre'];
                $model->producer = $post['producer'];
                $model->author = $post['author'];
                $model->relizer = $post['relizer'];
                $model->description = $post['description'];
                $model->img = $post['img'];

                try {
                    $model->save();
                    Session::instance()->set('add_serial', '1');
                    Request::$initial->redirect(URL::base(true) . "admin/serials");
                } catch(Exception $e) {
                    Session::instance()->set('add_serial', '0');
                    Request::$initial->redirect(URL::base(true) . "admin/serials");
                }
            } else {
                Request::$initial->redirect(URL::base(true) . "admin/serials");
            }
        }
    }

    public function action_addseries()
    {
        if ($this->request->method() == 'POST') {
            $post = $this->request->post();
            $seriesModel = ORM::factory('series');
            $serialModel = ORM::factory('serial')->where('id', '=', $post['serial_id'])->find();
            $seasonModel = ORM::factory('season')->where('id', '=', $post['season_id'])->find();;

            if (isset($_FILES['series']['name'])) {
                $file_path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "media" . DIRECTORY_SEPARATOR . "series" . DIRECTORY_SEPARATOR;
                $file_path .= $this->_prepareSerialName($serialModel->title_orig) . DIRECTORY_SEPARATOR;
                $serialDirectory = $file_path;
                $file_path .= str_replace(" ", "_", $this->_translitText($seasonModel->title)) . DIRECTORY_SEPARATOR;
                $seasonDirectory = $file_path;
                $mp4FilePath = $file_path;
                $file_path .= $_FILES['series']['name'];

                $file_url = URL::base(true) . "media" . DIRECTORY_SEPARATOR . "series" . DIRECTORY_SEPARATOR;
                $file_url .= $this->_prepareSerialName($serialModel->title_orig) . DIRECTORY_SEPARATOR;
                $file_url .= str_replace(" ", "_", $this->_translitText($seasonModel->title)) . DIRECTORY_SEPARATOR;
                $mp4Url = $file_url . "series_" . $post['num'] . ".mp4";;
                $file_url .= $_FILES['series']['name'];

                // Create directories
                if (!file_exists($serialDirectory)) {
                    mkdir("media/series/" . $this->_prepareSerialName($serialModel->title_orig), 0777);
                }
                if (!file_exists($seasonDirectory)) {
                    mkdir("media/series/" . $this->_prepareSerialName($serialModel->title_orig) . "/" . str_replace(" ", "_", $this->_translitText($seasonModel->title)), 0777);
                }

                if ($post['mkv'] == 'on') {

                    $mkvFile = $_FILES['series']['tmp_name'];
                    $mp4File = $mp4FilePath . "series_" . $post['num'] . ".mp4";
                    $mp4FileCopy = $mp4FilePath . "copy_series_" . $post['num'] . ".mp4";

                    //$command = "ffmpeg -i " . $mkvFile . " -vcodec copy -acodec copy -absf aac_adtstoasc " . $mp4File;
                    $command = "avconv -i " . $mkvFile . " -strict experimental -vcodec libx264 -preset fast -crf 20 -threads 2 -acodec aac -ab 128k " . $mp4File;
                    $mp4BoxCommand = 'cd ' . $mp4FilePath . ' && MP4Box -add "series_' . $post["num"] . '.mp4" -inter "500" "copy_series_' . $post["num"] . '.mp4"' ;

                    exec($command);
                    exec($mp4BoxCommand);

                    unlink($mp4File);
                    rename($mp4FileCopy, $mp4File);

                    $seriesModel->num = $post['num'];
                    $seriesModel->serial_id = $post['serial_id'];
                    $seriesModel->season_id = $post['season_id'];
                    $seriesModel->file_url = $mp4Url;

                    try {
                        $seriesModel->save();
                        Session::instance()->set('add_series', '1');
                        Request::$initial->redirect(URL::base(true) . "admin/seriya");
                    } catch(Exception $e) {
                        Session::instance()->set('add_series', '0');
                        Request::$initial->redirect(URL::base(true) . "admin/seriya");
                    }

                } else {
                    if (move_uploaded_file($_FILES['series']['tmp_name'], $file_path)) {

                        $seriesModel->num = $post['num'];
                        $seriesModel->serial_id = $post['serial_id'];
                        $seriesModel->season_id = $post['season_id'];
                        $seriesModel->file_url = $file_url;

                        try {
                            $seriesModel->save();
                            Session::instance()->set('add_series', '1');
                            Request::$initial->redirect(URL::base(true) . "admin/seriya");
                        } catch(Exception $e) {
                            Session::instance()->set('add_series', '0');
                            Request::$initial->redirect(URL::base(true) . "admin/seriya");
                        }
                    }
                }
            } else {
                Request::$initial->redirect(URL::base(true) . "admin/seriya");
            }
        }
    }

    private function _translitText($str)
    {
        $tr = array(
            "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
            "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
            "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
            "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
            "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
            "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"YI","Ь"=>"",
            "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
            "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
            "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
            "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
            "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
            "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
            "ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya",
            "."=>".","?"=>"?","/"=>"_","\\"=>"_",
            "*"=>"_",":"=>":","*"=>"_","\""=>"_","<"=>"_",
            ">"=>"_","|"=>"_"
        );
        return strtr($str,$tr);
    }

    private function _prepareSerialName($str)
    {
        return str_replace(" ", "_", $str);
    }

}