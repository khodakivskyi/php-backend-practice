<?php

namespace models;

/**
 * Class UserModel
 *
 * Simple user model class.
 *
 * @package models
 */
class UserModel
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