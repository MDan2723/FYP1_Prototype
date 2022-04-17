<?php

class Includes extends Controller
{
    public function index( $data='' ){ $this->view('includes/index.inc', []); }
    public function account( $data='' ){ $this->view('includes/account.inc', []); }
    public function forum( $data='' ){ $this->view('includes/forum.inc', []); }
    public function rating( $data='' ){ $this->view('includes/rating.inc', []); }
    public function deletePost( $data='' ){ $this->view('includes/deletePost.inc', []); }
}