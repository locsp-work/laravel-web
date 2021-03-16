<?php
require_once 'c:\xampp\htdocs\weblaravel\vendor\autoload.php';
$fb = new \Facebook\Facebook([
  'app_id' => env('FACEBOOK_APP_ID'),
  'app_secret' => env('FACEBOOK_APP_SECRET'),
  'default_graph_version' => 'v7.0',
]);