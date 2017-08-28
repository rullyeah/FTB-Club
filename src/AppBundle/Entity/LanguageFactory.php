<?php

namespace AppBundle\Entity;

use Ramsey\Uuid\Uuid;

abstract class LanguageFactory
{
    public static function build($name, $locale)
    {
        $id = Uuid::uuid4()->toString();
        return new Language($id, $name, $locale);
    }
}