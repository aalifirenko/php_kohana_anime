<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Frontend_Index extends Controller_Template {

    public $template = "frontend/v_page";
    protected $content = array();
    protected $additional_css = array();
    protected $additional_script = array();

    public function before()
    {
        parent::before();
        $this->template->plugins = View::factory('frontend/head/v_plugins')->render();
        $this->template->footer = View::factory('frontend/template/v_footer')->render();
    }

    public function action_index()
    {
        $this->template->title = "Смотреть аниме, аниме смотреть онлайн, бесплатно и без регистрации | AniNice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "Аниме онлайн, смотреть аниме онлайн, все для комфортного просмотра любомого аниме",
            "description" => "Все для комфортного просмотра любимого аниме"
        ))->render();

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            "slider"   => View::factory('frontend/template/head/v_slider')->render(),
            'base_content' => View::factory('frontend/template/content/v_home', array(
                'popular_anime' => View::factory('frontend/template/content/bloks/popularAnime', array(
                    'serials' => Model::factory('getdata')->getPopularAnime(),
                ))->render(),
                'rating' => View::factory('frontend/template/content/bloks/rating', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render(),
                'hot_ten' => View::factory('frontend/template/content/bloks/hot_ten', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render()
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "home";
    }

    public function action_aboutus()
    {
        // SEO INFO
        $this->template->title = "о проекте anime nice | AniNice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "проект aninice",
            "description" => "о проекте aninice"
        ))->render();

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            //"slider"   => View::factory('frontend/template/head/v_slider')->render(),
            'base_content' => View::factory('frontend/template/content/v_about', array(
                'about_text' => View::factory('frontend/template/content/pages/v_about_us', array())->render(),
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "about_us";
    }

    public function action_allblog()
    {
        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        // SEO INFO
        $this->template->title = "Аниме блог | AniNice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "аниме, блог, anime, blog",
            "description" => "аниме блоги, anime blog"
        ))->render();

        $totalItem = ORM::factory('blog')->count_all();
        $pagination = Pagination::factory(array('total_items' => $totalItem));

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            "slider"   => View::factory('frontend/template/head/v_slider')->render(),
            'base_content' => View::factory('frontend/template/content/v_blogs', array(
                'blogs' => View::factory('frontend/template/content/pages/v_blog', array(
                    'pagination' => $pagination,
                    'blogs' => ORM::factory('blog')
                        ->order_by('id', 'DESC')
                        ->limit($pagination->items_per_page)
                        ->offset($pagination->offset)
                        ->find_all(),
                    'is_allanime' => true,
                    'title' => "Страничка аниме блогов",
                ))->render(),
                'rating' => View::factory('frontend/template/content/bloks/rating', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render()
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "blog";
    }

    public function action_blogpost()
    {
        if ($this->request->param('post_id')) {
            array_push($this->additional_css, URL::base(true) . "media/css/blog.css");
            $postId = (int) $this->request->param('post_id');
            $model = ORM::factory('blog', $postId);
            if ($model->loaded()) {
                // SEO INFO
                $this->template->title = "Блог " . $model->title . ", аниме блог | AniNice";
                $this->template->meta = View::factory('frontend/head/v_meta', array(
                    "keyword" => "anime, blog, аниме, блог, " . $model->title,
                    "description" => "аниме блог " . $model->title
                ))->render();

                $this->template->content = View::factory('frontend/template/v_content', array(
                    "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
                    "slider"   => View::factory('frontend/template/head/v_slider')->render(),
                    'base_content' => View::factory('frontend/template/content/v_about', array(
                        'about_text' => View::factory('frontend/template/content/pages/v_post', array(
                            'model' => $model
                        ))->render(),
                    ))->render(),
                ))->render();

                // Set script list
                $this->template->script_list = "blog";
            }
        } else
            $this->request->redirect('/');
    }

    public function action_serial()
    {
        $serial_id = (int)$this->request->param('serial_id');

        if (is_integer($serial_id) && $serial_id > 0) {

            array_push($this->additional_css, URL::base(true) . "media/css/serial.css");

            $serialModel = ORM::factory('serial', $serial_id);
            if ($serialModel->loaded()) {
                // SEO INFO
                $this->template->title = "смотреть онлайн " . $serialModel->title_rus . ", бесплатно | AniNice";
                if ($this->request->param('season_id')) {
                    $seasonTitle = ORM::factory('season', (int)Request::$current->param('season_id'));
                    $this->template->title .= " " . $seasonTitle->title;
                }
                $this->template->meta = View::factory('frontend/head/v_meta', array(
                    "keyword" => "Аниме онлайн, смотреть аниме онлайн, смотреть {$serialModel->title_rus} онлайн",
                    "description" => "Новый сезон {$serialModel->title_rus}, новые серии {$serialModel->title_rus}"
                ))->render();

                $seasonModel = ORM::factory('season');
                $seasonId = Request::$current->param('season_id') ? Request::$current->param('season_id')
                    : $seasonModel->where('serial_id', '=', $serial_id)->limit(1)->find()->id;

                $this->template->content = View::factory('frontend/template/v_content', array(
                    "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
                    'base_content' => View::factory('frontend/template/content/v_about', array(
                        'about_text' => View::factory('frontend/template/content/pages/v_serial', array(
                            'serial' => ORM::factory('serial', $serial_id),
                            'seasons' => ORM::factory('season')->where('serial_id', '=', $serial_id)->find_all(),
                        ))
                            ->render()
                    ))->render(),
                ))->render();

                // Set script list
                $this->template->script_list = "serial";
            }
        }
    }

    public function action_search()
    {
        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        // SEO INFO
        $this->template->title = "AniNice :: Поиск";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "поиск аниме",
            "description" => "аниме, поиск"
        ))->render();

        $query = htmlspecialchars($_GET['query'], ENT_QUOTES);

        $totalItem = ORM::factory('serial')
            ->where('title_rus', 'LIKE', "%{$query}%")
            ->or_where('title_orig', 'LIKE', "%{$query}%")
            ->count_all();

        $pagination = Pagination::factory(array('total_items' => $totalItem));

        $serials = ORM::factory('serial')
            ->where('title_rus', 'LIKE', "%{$query}%")
            ->or_where('title_orig', 'LIKE', "%{$query}%")
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->order_by('title_rus', 'ASC')
            ->find_all();

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            'base_content' => View::factory('frontend/template/content/v_search', array(
                'serials' => View::factory('frontend/template/content/pages/v_search', array(
                    'pagination' => $pagination,
                    'serials' => $serials,
                ))->render(),
                'rating' => View::factory('frontend/template/content/bloks/rating', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render()
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "search";
    }

    public function action_allanime()
    {
        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        // SEO INFO
        $this->template->title = "Смотреть все аниме, все аниме онлайн, бесплатно и без регистрации | AniNice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "все аниме",
            "description" => "аниме, все аниме"
        ))->render();

        $totalItem = ORM::factory('serial')
            ->count_all();

        $pagination = Pagination::factory(array('total_items' => $totalItem));

        $serials = ORM::factory('serial')
            ->limit($pagination->items_per_page)
            ->offset($pagination->offset)
            ->order_by('title_rus', 'ASC')
            ->find_all();

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            'base_content' => View::factory('frontend/template/content/v_search', array(
                'serials' => View::factory('frontend/template/content/pages/v_category', array(
                    'pagination' => $pagination,
                    'serials' => $serials,
                    'categoryTitle' => "Все Аниме"
                ))->render(),
                'rating' => View::factory('frontend/template/content/bloks/rating', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render()
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "all_anime";
    }

    public function action_popular()
    {
        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        // SEO INFO
        $this->template->title = "Смотреть популярное аниме онлайн, бесплатно и без регистрации | AniNice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "популярное аниме",
            "description" => "аниме, популярное аниме"
        ))->render();

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            'base_content' => View::factory('frontend/template/content/v_search', array(
                'serials' => View::factory('frontend/template/content/pages/v_categoryArr', array(
                    'serials' => Model::factory('getdata')->getPopularAnime(),
                    'categoryTitle' => "Популярное Аниме"
                ))->render(),
                'rating' => View::factory('frontend/template/content/bloks/rating', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render()
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "popular";
    }

    public function action_newanime()
    {
        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        // SEO INFO
        $this->template->title = "Смотреть аниме новинки, смотреть новинки онлайн | AniNice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "популярное аниме",
            "description" => "аниме, популярное аниме"
        ))->render();

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            'base_content' => View::factory('frontend/template/content/v_search', array(
                'serials' => View::factory('frontend/template/content/pages/v_categoryArr', array(
                    'serials' => Model::factory('getdata')->getAllNewAnime(),
                    'categoryTitle' => "Новинки Аниме"
                ))->render(),
                'rating' => View::factory('frontend/template/content/bloks/rating', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render()
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "new_anime";
    }

    public function action_hits()
    {
        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        // SEO INFO
        $this->template->title = "Смотреть хиты аниме, смотреть аниме хиты онлайн | AniNice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "хиты аниме",
            "description" => "аниме, хиты аниме"
        ))->render();

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            'base_content' => View::factory('frontend/template/content/v_search', array(
                'serials' => View::factory('frontend/template/content/pages/v_categoryArr', array(
                    'serials' => Model::factory('getdata')->getHitsAnime(),
                    'categoryTitle' => "Новинки Аниме"
                ))->render(),
                'rating' => View::factory('frontend/template/content/bloks/rating', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render()
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "new_anime";
    }

    public function action_ongoing()
    {
        array_push($this->additional_css, URL::base(true) . "media/css/blog.css");

        // SEO INFO
        $this->template->title = "Онгоинги аниме, смотреть аниме онгоинги онлайн | AniNice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "аниме онгоинги",
            "description" => "аниме, аниме онгоинги"
        ))->render();

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            'base_content' => View::factory('frontend/template/content/v_search', array(
                'serials' => View::factory('frontend/template/content/pages/v_categoryArr', array(
                    'serials' => Model::factory('getdata')->getOngoingAnime(),
                    'categoryTitle' => "Аниме Онгоинги"
                ))->render(),
                'rating' => View::factory('frontend/template/content/bloks/rating', array(
                    'serials' => Model::factory('getdata')->getTopAnime()
                ))->render()
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "new_anime";
    }

    public function action_aboutaninice()
    {
        // SEO INFO
        $this->template->title = "Команда Aninice";
        $this->template->meta = View::factory('frontend/head/v_meta', array(
            "keyword" => "команда aninice",
            "description" => "о команде aninice"
        ))->render();

        array_push($this->additional_css, URL::base(true) . "media/css/about_aninice.css");

        $this->template->content = View::factory('frontend/template/v_content', array(
            "top_menu" => View::factory('frontend/template/head/v_topmenu')->render(),
            'base_content' => View::factory('frontend/template/content/v_about', array(
                'about_text' => View::factory('frontend/template/content/pages/v_about_aninice', array())->render(),
            ))->render(),
        ))->render();

        // Set script list
        $this->template->script_list = "about_us";
    }

    public function after()
    {
        $this->template->additional_css = $this->additional_css;
        $this->template->additional_script = $this->additional_script;
        parent::after();
    }

}