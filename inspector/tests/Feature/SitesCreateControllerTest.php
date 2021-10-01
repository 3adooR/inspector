<?php

namespace Tests\Feature;

use App\Http\Controllers\Sites\SitesCreateController;
use Tests\TestCase;

/**
 * Class SitesCreateControllerTest
 * @package Tests\Feature
 * @group controllers
 * @group sites
 */
class SitesCreateControllerTest extends TestCase
{
    public function testSitesCreateControllerHasMethodInvoke()
    {
        $this->assertTrue(
            method_exists(SitesCreateController::class, '__invoke'),
            'SitesCreateController class does not have method __invoke'
        );
    }
}
