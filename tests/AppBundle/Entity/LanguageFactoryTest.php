<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\LanguageFactory;
use AppBundle\Entity\Language;
use PHPUnit\Framework\TestCase;

class LanguageFactoryTest extends TestCase
{
    protected $name;
    protected $locale;

    public function testBuild()
    {
        $language = LanguageFactory::build($this->name, $this->locale);

        $this->assertInstanceOf(Language::class, $language);
        $this->assertFalse(empty($language->id()));
        $this->assertEquals($this->name, $language->name());
        $this->assertEquals($this->locale,$language->locale());

    }
}