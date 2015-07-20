<?php

namespace Sun\Http;

class Request
{
    /**
     * To know request method type
     *
     * @return string
     */
    public function method()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            return 'POST';
        }

        if($_SERVER['REQUEST_METHOD'] == 'GET') {

            return 'GET';
        }
    }

    /**
     * To check request type
     *
     * @param $name
     *
     * @return bool
     */
    public function isMethod($name)
    {
        if($this->method() === strtoupper($name)) {
            return true;
        }

        return false;
    }

    /**
     * To check request is ajax
     *
     * @return bool
     */
    public function isAjax()
    {
        $headers = apache_request_headers();
        $is_ajax = (isset($headers['X-Requested-With']) && $headers['X-Requested-With'] == 'XMLHttpRequest');

        return $is_ajax ? true : false;
    }

    /**
     * To get value from a request
     *
     * @param $fieldName
     *
     * @return mixed
     */
    public function input($fieldName)
    {
        if($this->isMethod('post')) {
            return $_POST[$fieldName];
        }

        if($this->isMethod('get')) {
            return $_GET[$fieldName];
        }
    }

    /**
     * To get all values from a request
     *
     * @return mixed
     */
    public function all()
    {
        if($this->isMethod('POST')) {
            return $_POST;
        }

        if($this->isMethod('GET')) {
            return $_GET;
        }
    }

    /**
     * To get file from a request
     *
     * @param $name
     *
     * @return mixed
     */
    public function file($name)
    {
        return $_FILES[$name];
    }
}
