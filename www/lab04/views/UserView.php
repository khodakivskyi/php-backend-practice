<?php

namespace views;

/**
 * Class UserView
 *
 * Responsible for rendering user-related output.
 *
 * @package views
 */
class UserView
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