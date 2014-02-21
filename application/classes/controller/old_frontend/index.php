<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Index extends Controller_Template {

    public $template = "frontend/v_page";
    protected $content = array();
    protected $additional_css = array();
    protected $additional_script = array();
    protected $ayah = null;

    public function before()
    {
        parent::before();
        $currentHour = date('g');
        $poster = ORM::factory('poster')->where('hour', '=', $currentHour)->find();
        $serials = ORM::factory('serial')
            ->order_by('title_rus')
            ->find_all();

        $rememberSerial = Cookie::get('serial');
        if ($rememberSerial) {
            $rememberSerialModel = ORM::factory('serial', $rememberSerial);
            $this->template->rememberserial = $rememberSerialModel->title_rus;
            $this->template->rememberseriallink = Route::url('view_serial_with_name', array('serial_id' => $rememberSerialModel->id,'serial_name' => strtolower(str_replace(" ", "_", $rememberSerialModel->title_orig))));;
        }

        $this->template->poster = $poster->filename;
        $this->template->sidebar = View::factory('frontend/v_sidebar', array(
            'allSerials' => $serials
        ))->render();

        $this->template->top_menu_auth = View::factory('frontend/auth/topmenu')->render();

        array_push($this->additional_script, URL::base(true) . "media/js/auth.js");
    }

    public function action_index()
	{
        $this->template->title = "Anime Nice :: Смотри любимые сериалы с удовольствием";
        $this->template->keyword = "Аниме онлайн, смотреть аниме онлайн, все для комфортного просмотра любомого аниме";
        $this->template->description = "Все для комфортного просмотра любимого аниме";

        $newAnime = Model::factory('getdata')->getNewAnime();

        array_push($this->content, View::factory('frontend/block/v_slider', array(
            'slides' => ORM::factory('slider')
                ->where("day", "=", date('D'))
                ->find_all())
        )->render());

        array_push($this->content, View::factory('frontend/block/v_news', array(
                'news' => ORM::factory('news')->find_all())
        )->render());

        array_push($this->content, View::factory('frontend/block/v_newanime', array(
                'model' => $newAnime
        ))->render());

        array_push($this->content, View::factory('frontend/block/v_social', array())->render());
	}

    public function action_serial()
    {
        $serial_id = (int)$this->request->param('serial_id');

        if (is_integer($serial_id) && $serial_id > 0) {

            $serialModel = ORM::factory('serial', $serial_id);
            if ($serialModel->loaded()) {

                // SEO INFO
                $this->template->title = "Anime Nice :: " . $serialModel->title_rus;
                $this->template->keyword = "Аниме онлайн, смотреть аниме онлайн, смотреть {$serialModel->title_rus} онлайн, {$serialModel->title_rus} новые серии,";
                $this->template->keyword .= " смотреть {$serialModel->title_orig} онлайн, {$serialModel->title_orig} новые серии";
                $this->template->description = "Новый сезон {$serialModel->title_rus}, новые серии {$serialModel->title_rus}, смотреть онлайн {$serialModel->title_rus},";
                $this->template->description = " Новый сезон {$serialModel->title_orig}, новые серии {$serialModel->title_orig}, смотреть онлайн {$serialModel->title_orig}";

                $seasonModel = ORM::factory('season');
                $seasonId = Request::$current->param('season_id') ? Request::$current->param('season_id')
                    : $seasonModel->where('serial_id', '=', $serial_id)->limit(1)->find()->id;


                array_push($this->content, View::factory('frontend/block/v_serial', array(
                        'serial' => ORM::factory('serial', $serial_id),
                        'seasons' => ORM::factory('season')->where('serial_id', '=', $serial_id)->find_all(),
                        'comments' => ORM::factory('comment')
                            ->where('serial_id', "=", $serial_id)
                            ->where('season_id', "=", $seasonId)
                            ->limit(15)
                            ->order_by('id', 'DESC')
                            ->find_all()
                ))->render());
            }
            else
                Request::$current->redirect(URL::base(true));

        } else
            Request::$current->redirect(URL::base(true));
    }

    public function action_relise()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Релизы";
        $this->template->keyword = "Аниме онлайн, смотреть аниме онлайн, дата выхода новых серий аниме";
        $this->template->description = "Аниме онлайн, смотреть аниме онлайн, дата выхода новых серий аниме";

        array_push($this->content, View::factory('frontend/block/v_relise', array(
            'relise' => ORM::factory('relise', 1),
        ))->render());
    }

    public function action_newanime()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Новинки";
        $this->template->keyword = "Аниме онлайн, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
        $this->template->description = "Аниме онлайн, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

        array_push($this->content, View::factory('frontend/block/v_newanime_page', array(
                'model' => Model::factory('getdata')->getAllNewAnime(),
        ))->render());
    }

    public function action_aboutus()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: О Нас";
        $this->template->keyword = "Аниме онлайн, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме, о проекте Anime Nice";
        $this->template->description = "Аниме онлайн, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме, о проекте Anime Nice";

        array_push($this->content, View::factory('frontend/v_about_us', array())->render());
    }

    public function action_popular()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Популярное";
        $this->template->keyword = "Аниме онлайн, популярное аниме, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
        $this->template->description = "Аниме онлайн, популярное аниме, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

        array_push($this->content, View::factory('frontend/page/filterable', array(
            'serials' => Model::factory('getdata')->getPopularAnime(),
            'title' => 'Популярное Аниме'
        ))->render());
    }

    public function action_hits()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Хиты";
        $this->template->keyword = "Аниме онлайн, хиты аниме, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
        $this->template->description = "Аниме онлайн, хиты аниме, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

        array_push($this->content, View::factory('frontend/page/filterable', array(
            'serials' => Model::factory('getdata')->getHitsAnime(),
            'title' =>  'Аниме Хиты'
        ))->render());
    }

    public function action_ongoing()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Онгоинг";
        $this->template->keyword = "Аниме онлайн, онгоинг, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
        $this->template->description = "Аниме онлайн, онгоинг, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

        array_push($this->content, View::factory('frontend/page/filterable', array(
            'serials' => Model::factory('getdata')->getOngoingAnime(),
            'title' => 'Аниме Онгоинги'
        ))->render());
    }

    public function action_rating()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Найти Аниме по Рейтингу";
        $this->template->keyword = "Найти аниме по рейтингу";
        $this->template->description = "Найти аниме по рейтингу";

        array_push($this->additional_css, "http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css");
        array_push($this->additional_script, "http://code.jquery.com/ui/1.10.3/jquery-ui.js");
        array_push($this->additional_script, URL::base(true) . "media/js/rating.js");

        array_push($this->content, View::factory('frontend/page/rating', array(

        ))->render());
    }

    public function action_allanime()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Все аниме сериалы";
        $this->template->keyword = "Аниме онлайн, все аниме сериалы, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
        $this->template->description = "Аниме онлайн, все аниме сериалы, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

        $totalItem = ORM::factory('serial')->count_all();
        $pagination = Pagination::factory(array('total_items' => $totalItem));
        $serials = Model::factory('getdata')->getAllAnime($pagination->items_per_page, $pagination->offset);

        array_push($this->additional_css, URL::base(true) . "media/css/filters.css");

        array_push($this->content, View::factory('frontend/page/filterable', array(
            'serials' => $serials,
            'pagination' => $pagination,
            'filter_genre' => View::factory('frontend/filters/genre')->render(),
        ))->render());
    }

    public function action_search()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Поиск";
        $this->template->keyword = "Аниме онлайн, все аниме сериалы, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
        $this->template->description = "Аниме онлайн, все аниме сериалы, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

        $query = htmlspecialchars($_GET['query'], ENT_QUOTES);

        $totalItem = ORM::factory('serial')
            ->where('title_rus', 'LIKE', "%{$query}%")
            ->or_where('title_orig', 'LIKE', "%{$query}%")
            ->count_all();

        $pagination = Pagination::factory(array('total_items' => $totalItem));
        $serials = Model::factory('getdata')->getSearch($query, $pagination->items_per_page, $pagination->offset);

        array_push($this->content, View::factory('frontend/page/filterable', array(
            'title' => 'Найдено',
            'serials' => $serials,
            'pagination' => $pagination,
        ))->render());
    }

    public function action_serialblog()
    {
        if ($this->request->param('serial_id')) {
        $serialId = $this->request->param('serial_id');
        // SEO INFO
        $serialName = ORM::factory('serial', $serialId)->title_rus;
        $this->template->title = "Anime Nice :: Блог " . $serialName;
        $this->template->keyword = "Аниме онлайн, аниме блог, блоги сериалов, все аниме сериалы, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
        $this->template->description = "Аниме онлайн, аниме блог, блоги сериалов, все аниме сериалы, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        $totalItem = ORM::factory('blog')
            ->where('serial_id', '=', $serialId)
            ->count_all();
        $pagination = Pagination::factory(array('total_items' => $totalItem));

        array_push($this->content, View::factory('frontend/page/v_blog', array(
            'pagination' => $pagination,
            'blogs' => ORM::factory('blog')
                ->where('serial_id', '=', $serialId)
                ->limit($pagination->items_per_page)
                ->offset($pagination->offset)
                ->find_all(),
            'title' => "Блог " . $serialName,

        ))->render());
        } else
            $this->request->redirect('/');
    }

    public function action_allblog()
    {
        // SEO INFO
        $this->template->title = "Anime Nice :: Блоги аниме сериалов";
        $this->template->keyword = "Аниме онлайн, аниме блог, блоги сериалов, все аниме сериалы, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
        $this->template->description = "Аниме онлайн, аниме блог, блоги сериалов, все аниме сериалы, аниме, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        $totalItem = ORM::factory('blog')->count_all();
        $pagination = Pagination::factory(array('total_items' => $totalItem));

        array_push($this->content, View::factory('frontend/page/v_blog', array(
            'pagination' => $pagination,
            'blogs' => ORM::factory('blog')
                ->order_by('id', 'DESC')
                ->limit($pagination->items_per_page)
                ->offset($pagination->offset)
                ->find_all(),
            'is_allanime' => true,
            'title' => "Страничка аниме блогов",
        ))->render());
    }

    public function action_blogpost()
    {
        if ($this->request->param('post_id')) {
        // SEO INFO
        $postId = (int) $this->request->param('post_id');
        $model = ORM::factory('blog', $postId);
        if ($model->loaded()) {
            $this->template->keyword = "Аниме онлайн, хиты аниме, смотреть аниме онлайн, дата выхода новых серий аниме, смотреть новинки аниме";
            $this->template->description = "Аниме онлайн, хиты аниме, смотреть аниме онлайн, дата выхода новых серий аниме, новинки аниме, новые серии аниме";

            array_push($this->additional_css, URL::base(true) . "media/css/blog.css");
            $this->template->title = "Anime Nice :: " . $model->title;

            array_push($this->content, View::factory('frontend/page/v_post', array(
                'model' => $model
            ))->render());
         }
        } else
            $this->request->redirect('/');
    }

        public function after()
    {
        $this->template->content = $this->content;
        $this->template->additional_css = $this->additional_css;
        $this->template->additional_script = $this->additional_script;
        parent::after();
    }

}