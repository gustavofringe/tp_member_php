<?php
class Home extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_view('home');

    }
}
