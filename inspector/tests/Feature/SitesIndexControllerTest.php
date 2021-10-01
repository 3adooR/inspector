<?php

namespace Tests\Feature;

use App\Http\Controllers\Sites\SitesIndexController;
use Tests\TestCase;

/**
 * Class SitesIndexControllerTest
 * @package Tests\Feature
 * @group controllers
 * @group sites
 */
class SitesIndexControllerTest extends TestCase
{
    public function testSitesIndexControllerHasMethodInvoke()
    {
        $this->assertTrue(
            method_exists(SitesIndexController::class, '__invoke'),
            'SitesIndexController class does not have method __invoke'
        );
    }
}
