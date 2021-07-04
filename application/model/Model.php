<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\model;

/**
 * Description of Model
 *
 * @author sinelnikof
 */
abstract class Model implements Imodel {

    /**
     *  переопределение конструктора поможет создававть классы 
     * переданным масивом если ключи массива  = название полей класса
     * @param type $data
     */
    public function __construct($data) {
        $this->init();
        foreach ($data as $fieldName => $value) {
            if (property_exists($this, $fieldName)) {
                $this->{$fieldName} = $value;
            }
        }
    }

    /**
     * Вспомогательный метод то бы не грузить конструктор при необходимости
     */
    public function init() {
        
    }

    /**
     *  Логика позаимстованна с yii - используется для загрузки массива в коллекцию обектов
     * @param type $data
     * @param type $callAfterFind
     * @param type $index
     * @return type
     */
    public function populateRecords($data, $callAfterFind = true, $index = null) {
        $records = array();
        foreach ($data as $attributes) {
            if (($record = $this->populateRecord($attributes, $callAfterFind)) !== null) {
                if ($index === null)
                    $records[] = $record;
                else
                    $records[$record->$index] = $record;
            }
        }
        return $records;
    }

    /**
     * загрузка одного класса в обьект
     * @param type $attributes
     * @param type $callAfterFind
     * @return type
     */
    public function populateRecord($attributes, $callAfterFind = true) {
        if ($attributes !== false) {
            $record = $this->instantiate($attributes);
            $record->init();
            foreach ($attributes as $name => $value) {
                if (property_exists($record, $name))
                    $record->$name = $value;
            }
            return $record;
        } else
            return null;
    }

    /**
     * создаем новый экземпляр обьекта из класса
     * @param type $attributes
     * @return \application\model\class
     */
    protected function instantiate($attributes) {
        $class = get_class($this);
        $model = new $class(null);
        return $model;
    }

    /**
     * определение атрибутов только публичных
     * @return type
     */
    public function attributes() {
        $class = new ReflectionClass($this);
        $names = [];
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $names[] = $property->getName();
            }
        }

        return $names;
    }

}
