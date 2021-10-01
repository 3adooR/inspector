<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class EnvTest
 * @package Tests\Feature
 * @group app
 */
class EnvTest extends TestCase
{
    public function testEnvParameterCrmAccessUrlIsNotEmpty()
    {
        $this->markAsRisky();
        $this->assertNotEmpty(
            env('CRM_ACCESS_URL'),
            'CRM_ACCESS_URL parameter is empty or undefined'
        );
    }

    public function testEnvParameterDbNameHasTestSuffix()
    {
        $this->markTestIncomplete();
        $this->assertTrue(
            str_contains(env('DB_DATABASE'), '_test'),
            'DB_DATABASE parameter must have _test suffix'
        );
    }

    public function testEnvParameterAppNameIsNotEmpty()
    {
        $this->assertNotEmpty(
            env('APP_NAME'),
            'APP_NAME parameter is empty or undefined'
        );
    }
}
