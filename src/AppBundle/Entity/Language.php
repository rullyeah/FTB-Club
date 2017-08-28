<?php

namespace AppBundle\Entity;

class Language
{
    protected $id;
    protected $name;
    protected $locale;

    function __construct($id, $name, $locale)
    {
        $this->id = $id;
        $this->name = $name;
        $this->locale = $locale;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function locale()
    {
        return $this->locale;
    }

    public function changeName($name)
    {
        $this->name = $name;
    }

    public function changeLocale($locale)
    {
        $this->locale = $locale;
    }
}