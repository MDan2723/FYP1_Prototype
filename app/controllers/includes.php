<?php

class Includes extends Controller
{
    public function account( $data='' ){ $this->view('includes/account.inc', []); }
    public function forum( $data='' ){ $this->view('includes/forum.inc', []); }
}