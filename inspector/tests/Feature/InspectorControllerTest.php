<?php

namespace Tests\Feature;

use App\Http\Controllers\Inspector\InspectorController;
use App\Models\Inspector\Site;
use App\Services\Inspector\MenuService;
use App\Services\LogService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class InspectorControllerTest
 * @package Tests\Feature
 * @group controllers
 * @group inspector
 */
class InspectorControllerTest extends TestCase
{
    use RefreshDatabase;

    public function makeController(): InspectorController
    {
        return new InspectorController(new MenuService, new LogService);
    }

    public function makeSite()
    {
        return Site::firstOrCreate(['host' => 'mediart.pro', 'https' => true]);
    }

    public function testInspectorControllerHasMethodConstruct()
    {
        $this->assertTrue(
            method_exists(InspectorController::class, '__construct'),
            'InspectorController class does not have method __construct'
        );
    }

    public function testInspectorControllerHasMethodIndex()
    {
        $this->assertTrue(
            method_exists(InspectorController::class, 'index'),
            'InspectorController class does not have method index'
        );
    }

    public function testInspectorControllerHasMethodGetContent()
    {
        $this->assertTrue(
            method_exists(InspectorController::class, 'getContent'),
            'InspectorController class does not have method getContent'
        );
    }

    public function testInspectorControllerCurrentMenuItemByDefaultIsInfo()
    {
        $this->assertEquals(
            'info',
            $this->makeController()->currentMenuItem,
            'InspectorController current menu item by default is info'
        );
    }

    public function testInspectorControllerSiteIsEmptyByDefault()
    {
        $this->assertEmpty(
            $this->makeController()->site,
            'InspectorController site parameter is empty by default'
        );
    }

    public function testInspectorControllerIndexMethodChangeCurrentMenuItemToServer()
    {
        $inspector = $this->makeController();
        $inspector->index($this->makeSite()->id, 'server');
        $this->assertNotEquals(
            'info',
            $inspector->currentMenuItem,
            'InspectorController current menu item change to server by index method'
        );
    }

    public function testInspectorControllerIndexMethodReturnNotEmpty()
    {
        $this->assertNotEmpty(
            $this->makeController()->index($this->makeSite()->id),
            'InspectorController index method return not empty'
        );
    }

    public function testInspectorControllerIndexMethodSetSiteNotEmpty()
    {
        $inspector = $this->makeController();
        $inspector->index($this->makeSite()->id);
        $this->assertNotEmpty(
            $inspector->site,
            'InspectorController index method set site parameter is not empty'
        );
    }
}
