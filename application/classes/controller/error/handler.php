<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Error_Handler extends Controller_Template {

    public $template = 'error';

    public function before()
    {
        parent::before();

        $this->template->page = URL::site(rawurldecode(Request::$initial->uri()));

        // Если внутренний запрос
        if (Request::$initial !== Request::$current)
        {
            if ($message = rawurldecode($this->request->param('message')))
            {
                $this->template->message = $message;
            }
        }
        else
        {
            $this->request->action(404);
        }

        // устанавливаем HTTP статус
        $this->response->status((int) $this->request->action());
    }

    public function action_404()
    {
        $this->template->title = '404 Страница не найдена';

        // тут мы проверяем пришли попали ли мы на 404 страницу с нашего сайта
        if (isset ($_SERVER['HTTP_REFERER']) AND strstr($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) !== FALSE)
        {
            // устанавливаем влаг о том что 404 ошибка была с внутренней сслки
            $this->template->local = TRUE;
        }

        // устанавливаем HTTP статус
        $this->response->status(404);
    }

    public function action_503()
    {
        $this->template->title = 'Сервис недоступен';
    }

    public function action_500()
    {
        $this->template->title = 'Внутренняя ошибка сервера';
    }

} // End Error_Handler