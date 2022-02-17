<?php

require_once 'pub/lib/essentials.php';

class Home extends Controller
{
    
    public function index( $data='' ){
        $this->view('home/index', []);
    }
    public function notes( $data='' ){
        $this->view('pg_notes/index', []);
    }
    public function exercises( $data='' ){
        $this->view('pg_exercises/index', []);
    }
    
    public function results( $data='' ){
        $this->view('pg_results/index', []);
    }

    public function forum( $data='' ){
        $this->view('pg_forum/index', []);
    }

    public function settings( $data='' ){
        $this->view('pg_settings/index', []);
    }
}