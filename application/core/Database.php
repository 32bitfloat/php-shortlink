<?php

class Database {

    private $con;

    public function __construct(){
        $this->con = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    }

    public function getShortyFromURL($url){
        $sql = 'SELECT short_slug from '.DB_TABLE.' where original_url = :url';
        $sth = $this->con->prepare($sql);
        $sth->execute(array(':url' => $url));
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        return $row['short_slug'];
    }

    public function getURLfromShorty($shorty){
        $sql = 'SELECT original_url from '.DB_TABLE.' where short_slug = :shorty';
        $sth = $this->con->prepare($sql);
        $sth->execute(array(':shorty' => $shorty));
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        return $row['original_url'];
    }

    public function insertURL($url){
        if(DB_TYPE === 'pgsql'){
            $sql = 'INSERT INTO '.DB_TABLE.' (original_url) VALUES(:url) RETURNING id as newid';
        }else{
            $sql = 'INSERT INTO '.DB_TABLE.' (original_url) VALUES(:url)';
        }

        $sth = $this->con->prepare($sql);
        $sth->execute(array(':url' => $url));
        if(DB_TYPE === 'pgsql'){
            $row = $sth->fetch(PDO::FETCH_ASSOC);
            return $row['newid'];
        }else{
            return $this->con->lastInsertId();
        }

    }

    public function updateShorty($id, $shorty){
        $sql = 'UPDATE '.DB_TABLE.' set short_slug = :shorty where id = :id';
        $sth = $this->con->prepare($sql);
        $sth->execute(array(':id' => $id, ':shorty' => $shorty));
    }

} 