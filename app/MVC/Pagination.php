<?php

namespace App\MVC;

class Pagination
{
    protected int $countPages;//Количество страниц в зависимости от входящих параметров
    protected int $currentPage;//Номер текущей страницы
    protected string $uri;//Ссылка страницы

    public function __construct(
        protected int    $perPage = 1,//Кол-во записей на странице
        protected int    $totalRecords = 1,//Общее количество записей
        protected int    $midSize = 2,//Кол-во записей слева и справа
        protected int    $maxPages = 7,//Макс кол-во страниы
        protected string $tpl = 'pagination/base'//Шаблон вывода
    )
    {
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage();
        $this->uri = $this->getParams();
        $this->midSize = $this->getMidSize();
    }

    protected function getCountPages(): int
    {
        return (int)ceil($this->totalRecords / $this->perPage) ?: 1;
    }

    protected function getCurrentPage(): int
    {
        $page = (int)request()->get('page', 1);
        if ($page < 1 || $page > $this->countPages) {
            abort(404);
        }

        return $page;
    }

    protected function getParams(): string
    {
        $uri = '';
        $url = request()->uri;
        $url = parse_url($url);
        if (isset($url['query'])) {
            $uri = $url['path'];
            $query = $url['query'];
            if (!empty($query) && !in_array($query, ['&'])) {
                parse_str($query, $params);
                if (isset($params['page'])) {
                    unset($params['page']);
                }

                if (!empty($params)) {
                    $uri .= '?' . http_build_query($params);
                }
            }
        }

        return $uri;
    }

    protected function getMidSize(): int
    {
        return ($this->countPages <= $this->maxPages) ? $this->countPages : $this->midSize;
    }

    public function getOffset(): int
    {
        return ($this->currentPage - 1) * $this->perPage;
    }

}