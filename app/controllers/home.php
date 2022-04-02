<?php

require_once 'pub/lib/essentials.php';

class Home extends Controller
{
    
    public function index( $data='' ){
        $this->view('home/index', []);
    }
    public function notes( $data='' ){
        $this->view('home/notes', []);
    }
    public function exercises( $data='' ){
        $this->view('home/exercises', []);
    }
    
    public function simulation( $data='' ){
        $this->view('home/simulation', []);
    }
    public function simhistory( $data='' ){
        $this->view('home/simhistory', []);
    }

    public function stepbystepguide( $data='' ){
        $this->view('home/stepbystepguide', []);
    }

    public function forum( $data='' ){
        $this->view('home/forum', []);
    }

    public function settings( $data='' ){
        $this->view('home/settings', []);
    }

    public function signup( $data='' ){
        $this->view('home/signup', []);
    }
    public function login( $data='' ){
        $this->view('home/login', []);
    }
}