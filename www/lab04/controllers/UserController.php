<?php

namespace controllers;

/**
 * Class UserController
 *
 * Handles the user logic and coordinates between model and view.
 *
 * @package controllers
 */
class UserController
{
    /**
     * Displays a message with the class name.
     *
     * @return void
     */
    public function index(): void
    {
        echo 'it is ' . get_class($this);
    }
}