<?php

namespace AppBundle\UserCases;

use AppBundle\Entity\LanguageFactory;

class CreateLanguageService
{
    public function execute(CreateLanguageRequest $request)
    {
        $language = LanguageFactory::build($request->name(), $request->locale());
        return $language;
    }
}