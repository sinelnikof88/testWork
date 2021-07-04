<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace application\activeRecord;

/**
 * Description of UrlDataProvider
 *
 * @author sinelnikof
 */
class UrlDataProvider {

    protected $domain;
    protected $calledClass;
    protected $limit = 50;
    protected $offset = 0;
    protected $is_random;
    protected $client;
    protected $request;

    public function __construct($param) {
        $this->calledClass = $param;
    }

    protected function _buildQuery() {
        $this->client = new \GuzzleHttp\Client();
        $app = \application\App::getInstance();
        $domain = ($app->config['connection']['domain']);
        $path = ($this->calledClass::getUrlPath());
        $this->request = $this->client->request('GET', "$domain/$path");
    }

    protected function _execute() {
        $jsonString = $this->request->getBody();
        $data = json_decode($jsonString, true);
        if ($this->is_random) {
            shuffle($data);
        }
        if ($this->limit) {
            $data = array_slice($data, $this->offset, $this->limit);
        }


        return $data;
    }

    public function setLimit(int $limit, int $offest = 0) {
        $this->limit = (int) $limit;
        $this->offest = (int) $offest;
        return $this;
    }

    public function random() {
        $this->is_random = true;
        return $this;
    }

    public function all() {
        $this->_buildQuery();
        $data = $this->_execute();

        $collection = [];
        foreach ($data as $value) {
            $collection[] = new $this->calledClass($value);
        }
        return $collection;
    }

}
