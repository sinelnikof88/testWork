<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application;

/**
 * Description of App
 * Делаем из класса синглтон - 
 * нам потребуеться конфиг который будем передовать глобально
 * в методе getInstance будем получать экземпляр приложения
 * @author sinelnikof
 */
class App extends \Symfony\Component\Console\Application {

    public $config = [];
    private static $instances = [];

    /**
     * 
     * @throws \Exception
     */
    public function __wakeup() {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * запрешаем клонирование - должен быть один объект
     * * @throws \Exception
     */
    protected function __clone() {
        throw new \Exception("Cannot clone a singleton.");
    }

    /**
     *  тут будем получать сам инстанс- если нет создадим новый
     * @return \application\App
     */
    public static function getInstance(): App {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }

}
