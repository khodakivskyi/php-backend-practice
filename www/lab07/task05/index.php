<?php

require_once('Response.php');
use task05\Response;

$response = new Response();

$response
    ->setStatus(200)
    ->addHeader("Content-Type: text/html; charset=UTF-8")
    ->send("<h1>Hello</h1>");