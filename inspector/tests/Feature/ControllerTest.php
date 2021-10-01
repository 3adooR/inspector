<?php

namespace Tests\Feature;

use App\Http\Controllers\Controller;
use Tests\TestCase;

/**
 * Class ControllerTest
 * @package Tests\Feature
 * @group controllers
 * @group app
 */
class ControllerTest extends TestCase
{
    public function testControllerHasMethodDebug()
    {
        $this->assertTrue(
            method_exists(Controller::class, 'debug'),
            'Controller class does not have method debug'
        );
    }
}
