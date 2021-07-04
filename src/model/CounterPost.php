<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace sinelnikof\model;

/**
 * Description of CounterPost
 * класс логики подсчета данных 
 * @author sinelnikof
 */
class CounterPost {

    /**
     * 
     * @param type $arrayPosts - входящий массив моделей Post
     * @param type $row - поле которе будем считать
     * @param type $modifiedRow - поле котое будем модифицировать после пересчета
     */
    public function coincidenceCount(&$arrayPosts, $row, $modifiedRow) {
        $_counter = [];
        foreach ($arrayPosts as $value) {
            $fieldValue = $value->{$row};
            if (isset($_counter[$fieldValue])) {
                $_counter[$fieldValue] ++;
            } else {
                $_counter[$fieldValue] = 1;
            }
        }
        foreach ($arrayPosts as &$value) {
            $fieldValue = $value->{$row};
            $value->{$modifiedRow} = $_counter[$fieldValue];
        }
    }

}
