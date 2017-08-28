<?php

namespace AppBundle\UserCases;

class CreateLanguageRequest
{
    protected $name;
    protected $locale;

    public function __construct($name, $locale)
    {
        $this->checkValidName($name);
        $this->checkValidLocale($locale);

        $this->name = $name;
        $this->locale = $locale;
    }

    public function name()
    {
        return $this->name;
    }

    public function locale()
    {
        return $this->locale;
    }

    private function checkValidName($name)
    {
        if (empty($name)){
            throw new \InvalidArgumentException("Name can't be Empty");
        }
    }

    private function checkValidLocale($locale)
    {
        if (empty($locale)){
            throw new \InvalidArgumentException("Locale can't be Empty");
        }
    }
}