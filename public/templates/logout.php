<?php
require_once '../../app/core/App.php';
App::init();

Auth::logout();
Redirect::redirect('index.php');