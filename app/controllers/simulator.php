<?php

require_once 'pub/lib/essentials.php';

class Simulator extends Controller
{
    
    public function index( $data='' ){
        $this->view('simulator/index', []);
    }
    public function execute( $data='' ){
        $this->view('simulator/execute', []);
    }
    public function simhistory( $data='' ){
        $this->view('simulator/simhistory', []);
    }
    public function stepbystepguide( $data='' ){
        $this->view('simulator/stepbystepguide', []);
    }
}