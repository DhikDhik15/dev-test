<?php

namespace App\Extensions;

class ResponseExtension
{
    private $redirect;

    public function __construct()
    {
        $this->redirect = back();
    }

    public function to($route, $parameters = [])
    {
        $this->redirect = redirect()->route($route, $parameters);

        return $this;
    }

    public function success(string $message)
    {
        return $this->redirect->with('message', [
            'type' => 'success',
            'content' => $message,
        ]);
    }

    public function error(string $message)
    {
        return $this->redirect->with('message', [
            'type' => 'danger',
            'content' => $message,
        ]);
    }
}
