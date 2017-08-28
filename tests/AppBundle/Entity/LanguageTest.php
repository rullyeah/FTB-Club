<?php

namespace Tests\AppBundle\Entity;

use AppBundle\Entity\Language;
use PhpUnit\Framework\TestCase;

class LanguageTest extends TestCase
{
    protected $id;
    protected $name;
    protected $locale;

    protected function setUp()
    {
        $this->id = 'esId';
        $this->name = 'Español';
        $this->locale = 'es/es';
    }

    public function testNew()
    {
        $language = new Language($this->id, $this->name, $this->locale);
        $this->assertInstanceOf(Language::class, $language);
    }

    public function testChangeName()
    {
        $language = new Language($this->id, $this->name, $this->locale);
        $otherName = 'English';
        $language->changeName($otherName);

        $this->assertEquals($otherName, $language->name());
    }

    public function testChangeLocale()
    {
        $language = new Language($this->id, $this->name, $this->locale);
        $otherLocale = 'EN/US';
        $language->changeLocale($otherLocale);

        $this->assertEquals($otherLocale, $language->locale());
    }
}