<?php

namespace Tests\AppBundle\UserCases;

use AppBundle\UserCases\CreateLanguageRequest;
use PHPUnit\Framework\TestCase;

class CreateLanguageRequestTest extends TestCase
{
    protected $name;
    protected $locale;

    protected function setUp()
    {
        $this->name = 'Español';
        $this->locale = 'ES/ES';
    }

    public function testCreateNew()
    {
        $createLanguageRequest = new CreateLanguageRequest($this->name, $this->locale);
        $this->assertInstanceOf(CreateLanguageRequest::class, $createLanguageRequest);
    }

    public function testGetName()
    {
        $createLanguageRequest = new CreateLanguageRequest($this->name, $this->locale);
        $this->assertEquals($this->name, $createLanguageRequest->name());
    }

    public function testGetLocale()
    {
        $createLanguageRequest = new CreateLanguageRequest($this->name, $this->locale);
        $this->assertEquals($this->locale, $createLanguageRequest->locale());
    }

    public function TestWrongNameLaunchException()
    {
        $name = '';
        $this->expectException(\InvalidArgumentException::class);
        new CreateLanguageRequest($name, $this->locale);
    }

    public function TestEmptyLocaleLaunchException()
    {
        $locale = '';
        $this->expectException(\InvalidArgumentException::class);
        new CreateLanguageRequest($this->name, $locale);
    }
}