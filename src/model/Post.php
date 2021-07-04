<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof\model;

/**
 * Description of Post
 *
 * @author sinelnikof
 */
class Post extends \application\model\Model {

    public $id, $userId, $title, $body;
    public $coincidenceCount = 0; // введено специальное поле для подсчета совпадений - считать будем в другом классе

    /**
     *  определяем часть url для соеденения с апи
     * @return string
     */

    public static function getUrlPath() {
        return 'posts';
    }

    /**
     * в этом методе вернем датапровайдер - он будет заниматься общением с апи
     * @return \application\activeRecord\UrlDataProvider
     */
    public static function find() {

        return new \application\activeRecord\UrlDataProvider(get_called_class());
    }

}
