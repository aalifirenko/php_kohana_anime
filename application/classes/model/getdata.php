<?php

class Model_Getdata extends Model {

    public function getJsonSeries($serialId, $seasonId)
    {
        $seriesModel = ORM::factory('series')
            ->where('serial_id', '=', $serialId)
            ->where('season_id', '=', $seasonId)
            ->order_by('num')
            ->find_all();

        $jsonArray = array();
        $num = 1;

        foreach ($seriesModel as $series) {
            $jsonArray['playlist'][] = array(
                'comment' => "Серия " . $num,
                'file'    => $series->file_url,
            );
            $num++;
        }
        return array(
            'json'  => json_encode($jsonArray),
            'html5' => $jsonArray,
        );
    }

    public function getNewAnime()
    {
        $query = DB::select('series.num', 'series.serial_id', 'series.season_id', 'serials.title_rus', 'serials.title_orig', 'serials.img', 'seasons.title')
            ->from('series')
            ->join('serials', 'LEFT')
            ->on('series.serial_id', '=', 'serials.id')
            ->join('seasons', 'LEFT')
            ->on('series.season_id', '=', 'seasons.id')
            ->limit(6)
            ->order_by('series.id', 'DESC');
        $result = $query->execute();

        return $result;
    }

    public function getAllNewAnime()
    {
        $query = DB::select('series.num', 'serials.id', 'series.serial_id', 'series.season_id', 'serials.title_rus', 'serials.title_orig', 'serials.img', 'seasons.title')
            ->from('series')
            ->join('serials', 'LEFT')
            ->on('series.serial_id', '=', 'serials.id')
            ->join('seasons', 'LEFT')
            ->on('series.season_id', '=', 'seasons.id')
            ->group_by('serials.id')
            ->limit(21)
            ->order_by('series.id', 'DESC');
        $result = $query->execute();

        return $result;
    }

    public function getPopularAnime()
    {
        $query = DB::select('serial_category.serial_id', 'serial_category.popular', 'serials.*')
            ->from('serial_category')
            ->join('serials', 'LEFT')
            ->on('serial_category.serial_id', '=', 'serials.id')
            ->where('serial_category.popular', '=', '1')
            ->limit(8)
            ->order_by('serials.title_rus', 'ASC');

            $result = $query->execute();
            return $result;
    }

    public function getHitsAnime()
    {
        $query = DB::select('serial_category.serial_id', 'serial_category.hits', 'serials.*')
            ->from('serial_category')
            ->join('serials', 'LEFT')
            ->on('serial_category.serial_id', '=', 'serials.id')
            ->where('serial_category.hits', '=', '1')
            ->order_by('serials.title_rus', 'ASC');

        $result = $query->execute();
        return $result;
    }

    public function getTopTen()
    {
        $query = DB::select('serial_category.serial_id', 'serial_category.hits', 'serials.*')
            ->from('serial_category')
            ->join('serials', 'LEFT')
            ->on('serial_category.serial_id', '=', 'serials.id')
            ->where('serial_category.top_10', '=', '1')
            ->order_by('serials.title_rus', 'ASC');

        $result = $query->execute();
        return $result;
    }

    public function getOngoingAnime()
    {
        $query = DB::select('serial_category.serial_id', 'serial_category.ongoing', 'serials.*')
            ->from('serial_category')
            ->join('serials', 'LEFT')
            ->on('serial_category.serial_id', '=', 'serials.id')
            ->where('serial_category.ongoing', '=', '1')
            ->order_by('serials.title_rus', 'ASC');

        $result = $query->execute();
        return $result;
    }

    public function getAllAnime($limit, $offset)
    {
        $query = DB::select('serials.*')
            ->from('serials')
            ->limit($limit)
            ->offset($offset)
            ->order_by('serials.title_rus', 'ASC');

        $result = $query->execute();
        return $result;
    }

    public function getAllAnimeFiltered($genre)
    {
        $query = DB::select('serial_category.*', 'serials.*')
            ->from('serial_category')
            ->join('serials', 'LEFT')
            ->on('serial_category.serial_id', '=', 'serials.id')
            ->order_by('serials.title_rus', 'ASC');

        if ($genre == 'false')
            $query
                ->where('serial_category.popular', '=', '1');
        else
            $query
                ->where('serial_category.' . $genre, '=', '1');

        $result = $query->execute();
        return $result;
    }

    public function getSearch($query, $limit, $offset)
    {
        $query = DB::select('serials.*')
            ->from('serials')
            ->where('title_rus', 'LIKE', "%{$query}%")
            ->or_where('title_orig', 'LIKE', "%{$query}%")
            ->limit($limit)
            ->offset($offset)
            ->order_by('serials.title_rus', 'ASC');

        $result = $query->execute();
        return $result;
    }

    public function getSerialByRating($first, $last)
    {
        $query = DB::select('rating.*','serials.*')
                ->from('rating')
                ->join('serials', 'LEFT')
                ->on('rating.serial_id', '=', 'serials.id')
                ->where(DB::expr('floor(rating.sum/rating.count)'), '>=', $first)
                ->where(DB::expr('floor(rating.sum/rating.count)'), '<=', $last)
                ->order_by('serials.title_rus', 'ASC');

        $result = $query->execute();
        return $result;
    }

    public function getTopAnime()
    {
        $query = DB::select('rating.*','serials.*', array(DB::expr('rating.sum/rating.count') , 'item_rating'))
            ->from('rating')
            ->join('serials', 'LEFT')
            ->on('rating.serial_id', '=', 'serials.id')
            ->limit(10)
            ->order_by('item_rating', 'DESC');

        $result = $query->execute();
        return $result;
    }

    public function getVKLike()
    {
        $domen = URL::base(true);

        if ($domen == 'http://aninice.ru/' || $domen == 'http://www.aninice.ru/') {
            return '<script type="text/javascript" src="//vk.com/js/api/openapi.js?98"></script>

                    <script type="text/javascript">
                        VK.init({apiId: 3805144, onlyWidgets: true});
                    </script>

                    <!-- Put this div tag to the place, where the Like block will be -->
                    <div id="vk_like"></div>
                    <script type="text/javascript">
                        VK.Widgets.Like("vk_like", {type: "mini"});
                    </script>';
        } else if ($domen == 'http://anime-nice.ru/' || $domen == 'http://www.anime-nice.ru/') {
            return '
                <script type="text/javascript" src="//vk.com/js/api/openapi.js?98"></script>

                <script type="text/javascript">
                  VK.init({apiId: 3805166, onlyWidgets: true});
                </script>

                <!-- Put this div tag to the place, where the Like block will be -->
                <div id="vk_like"></div>
                <script type="text/javascript">
                VK.Widgets.Like("vk_like", {type: "mini"});
                </script>';
        } else if ($domen == 'http://animenice.ru/' || $domen == 'http://www.animenice.ru/') {
                return '<script type="text/javascript" src="//vk.com/js/api/openapi.js?98"></script>
                    <script type="text/javascript">
                      VK.init({apiId: 3805172, onlyWidgets: true});
                    </script>
                    <div id="vk_like"></div>
                    <script type="text/javascript">
                    VK.Widgets.Like("vk_like", {type: "mini"});
                    </script>';
        }
    }

}