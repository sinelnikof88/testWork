<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\model;

/**
 * интерфейс для моделей
 * @author sinelnikof
 */
interface Imodel {

    /**
     *  каждая модель cодежит в себе часть  url
     */
    public static function getUrlPath();
}
