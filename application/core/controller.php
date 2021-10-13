<?php

class Controller
{
    public $db = null;
    public $model = null;
    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
    }
    public function loadModel($model)
    {
        $this->openDatabaseConnection();
        require APP . "model/$model.php";
        return new $model($this->db);
    }
}
