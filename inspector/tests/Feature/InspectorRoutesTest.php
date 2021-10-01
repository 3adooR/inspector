<?php

namespace Tests\Feature;

use App\Models\Inspector\Site;
use App\Models\User;
use App\Services\Routes\Providers\Inspector\InspectorRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

/**
 * Class InspectorRoutesTest
 * @package Tests\Feature
 * @group routes
 * @group inspector
 */
class InspectorRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $site;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
        $this->site = Site::factory()->create();
    }

    public function testInspectorRoutesHasRouteIndex()
    {
        $this->assertNotEmpty(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            'InspectorRoutes has not got ROUTE_INSPECTOR_INDEX'
        );
    }

    public function testInspectorRoutesRouteIndexIsInspectorIndex()
    {
        $this->assertEquals(
            'inspector.index',
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            'InspectorRoutes ROUTE_INSPECTOR_INDEX value is not inspector.index'
        );
    }

    public function testInspectorRoutesRouteIndexReturn_302WithNoUser()
    {
        $response = $this->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertStatus(302);
    }

    public function testInspectorRoutesRouteIndexReturn_200WithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertStatus(200);
    }

    public function testInspectorRoutesRouteIndexReturn_200WithUserAndMenu()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'menu' => 'info', 'lang' => App::getLocale()]
        ));
        $response->assertStatus(200);
    }

    public function testInspectorRoutesRouteIndexCorrectViewWithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertViewIs('layouts.inspector');
    }

    public function testInspectorRoutesRouteIndexViewHasMenuWithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertViewHas('menu');
    }

    public function testInspectorRoutesRouteIndexViewHasCurrentMenuWithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertViewHas('currentMenu');
    }

    public function testInspectorRoutesRouteIndexViewHasSiteIdWithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertViewHas('siteID');
    }

    public function testInspectorRoutesRouteIndexViewHasCorrectSiteIdWithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertViewHas('siteID', $this->site->id);
    }

    public function testInspectorRoutesRouteIndexViewHasSiteWithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertViewHas('site');
    }

    public function testInspectorRoutesRouteIndexViewHasCorrectSiteWithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertViewHas('site', $this->site);
    }

    public function testInspectorRoutesRouteIndexViewHasContentWithUser()
    {
        $response = $this->actingAs($this->user)->get(route(
            InspectorRoutes::ROUTE_INSPECTOR_INDEX,
            ['id' => $this->site->id, 'lang' => App::getLocale()]
        ));
        $response->assertViewHas('content');
    }
}
