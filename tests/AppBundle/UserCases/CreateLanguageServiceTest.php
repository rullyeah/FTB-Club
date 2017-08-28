<?php
namespace Tests\AppBundle\UserCases;

use AppBundle\UserCases\CreateLanguageRequest;
use AppBundle\UserCases\CreateLanguageService;
use AppBundle\Entity\Language;
use PHPUnit\Framework\TestCase;

class CreateLanguageServiceTest extends TestCase
{
    public function testNew()
    {
        $createLanguageService = new CreateLanguageService();
        $this->assertInstanceOf(CreateLanguageService::class, $createLanguageService);
    }

    public function testExecute()
    {
        $name = 'Español';
        $locale = 'es/Es';

        $createLanguageService = new CreateLanguageService();
        $createLanguageRequest = new CreateLanguageRequest($name, $locale);

        $language = $createLanguageService->execute($createLanguageRequest);

        $this->assertInstanceOf(Language::class, $language);
        $this->assertFalse(empty($language->id()));
        $this->assertEquals($name, $language->name());
        $this->assertEquals($locale, $language->locale());
    }
}