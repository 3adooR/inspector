<?php

namespace Tests\Feature;

use App\Http\Controllers\AppController;
use Tests\TestCase;

/**
 * Class AppControllerTest
 * @package Tests\Feature
 * @group controllers
 * @group app
 */
class AppControllerTest extends TestCase
{
    public function testAppControllerHasMethodInvoke()
    {
        $this->assertTrue(
            method_exists(AppController::class, '__invoke'),
            'AppController class does not have method __invoke'
        );
    }
}
