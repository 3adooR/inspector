<?php

namespace Tests\Feature;

use App\Http\Controllers\Sites\SitesDeleteController;
use Tests\TestCase;

/**
 * Class SitesDeleteControllerTest
 * @package Tests\Feature
 * @group controllers
 * @group sites
 */
class SitesDeleteControllerTest extends TestCase
{
    public function testSitesDeleteControllerHasMethodInvoke()
    {
        $this->assertTrue(
            method_exists(SitesDeleteController::class, '__invoke'),
            'SitesDeleteController class does not have method __invoke'
        );
    }
}
