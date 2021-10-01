<?php

namespace Tests\Feature;

use App\Models\Inspector\Site;
use App\Models\User;
use App\Services\Routes\Providers\Sites\SitesRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\App;
use Tests\TestCase;

/**
 * Class SitesRoutesTest
 * @package Tests\Feature
 * @group routes
 * @group sites
 */
class SitesRoutesTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->make();
    }

    /** HAS ROUTES **/
    public function testSitesRoutesHasRouteIndex()
    {
        $this->assertNotEmpty(
            SitesRoutes::ROUTE_SITES_INDEX,
            'SitesRoutes has not got ROUTE_SITES_INDEX'
        );
    }

    public function testSitesRoutesHasRouteCreate()
    {
        $this->assertNotEmpty(
            SitesRoutes::ROUTE_SITES_CREATE,
            'SitesRoutes has not got ROUTE_SITES_CREATE'
        );
    }

    public function testSitesRoutesHasRouteDelete()
    {
        $this->assertNotEmpty(
            SitesRoutes::ROUTE_SITES_DELETE,
            'SitesRoutes has not got ROUTE_SITES_DELETE'
        );
    }

    /** ROUTES HAS CORRECT VALUE **/
    public function testSitesRoutesRouteIndexIsSitesIndex()
    {
        $this->assertEquals(
            'sites.index',
            SitesRoutes::ROUTE_SITES_INDEX,
            'SitesRoutes ROUTE_INDEX value is not sites.index'
        );
    }

    public function testSitesRoutesRouteLoginIsSitesCreate()
    {
        $this->assertEquals(
            'sites.create',
            SitesRoutes::ROUTE_SITES_CREATE,
            'SitesRoutes ROUTE_LOGIN value is not sites.create'
        );
    }

    public function testSitesRoutesRouteLogoutIsSitesDelete()
    {
        $this->assertEquals(
            'sites.delete',
            SitesRoutes::ROUTE_SITES_DELETE,
            'SitesRoutes ROUTE_LOGOUT value is not sites.delete'
        );
    }

    /** ROUTES RETURNS **/
    public function testSitesRoutesRouteIndexReturn_302WithNoUser()
    {
        $response = $this->get(
            route(SitesRoutes::ROUTE_SITES_INDEX, ['lang' => App::getLocale()])
        );
        $response->assertStatus(302);
    }

    public function testSitesRoutesRouteCreateReturn_302WithNoUser()
    {
        $response = $this->post(
            route(SitesRoutes::ROUTE_SITES_CREATE, ['lang' => App::getLocale()])
        );
        $response->assertStatus(302);
    }

    public function testSitesRoutesRouteDeleteReturn_302WithNoUser()
    {
        $response = $this->get(
            route(SitesRoutes::ROUTE_SITES_DELETE, ['id' => 0, 'lang' => App::getLocale()])
        );
        $response->assertStatus(302);
    }

    public function testSitesRoutesRouteIndexReturn_200WithUser()
    {
        $response = $this->actingAs($this->user)->get(
            route(SitesRoutes::ROUTE_SITES_INDEX, ['lang' => App::getLocale()])
        );
        $response->assertStatus(200);
    }

    public function testSitesRoutesRouteIndexReturnCorrectViewWithUser()
    {
        $response = $this->actingAs($this->user)->get(
            route(SitesRoutes::ROUTE_SITES_INDEX, ['lang' => App::getLocale()])
        );
        $response->assertViewIs('sites.index');
    }

    public function testSitesRoutesRouteIndexReturnSitesInViewWithUser()
    {
        $response = $this->actingAs($this->user)->get(
            route(SitesRoutes::ROUTE_SITES_INDEX, ['lang' => App::getLocale()])
        );
        $response->assertViewHas('sites');
    }

    public function testSitesRoutesRouteCreateReturnRedirectToSitesIndexRouteOnSuccessWithUser()
    {
        $response = $this->actingAs($this->user)->post(
            route(SitesRoutes::ROUTE_SITES_CREATE, ['lang' => App::getLocale()]),
            ['siteUrl' => 'https://mediart.pro']
        );
        $response->assertRedirect(route(SitesRoutes::ROUTE_SITES_INDEX, ['lang' => App::getLocale()]));
    }

    public function testSitesRoutesRouteCreateAddedNewRecordToSitesWithUser()
    {
        $this->actingAs($this->user)->post(
            route(SitesRoutes::ROUTE_SITES_CREATE, ['lang' => App::getLocale()]),
            ['siteUrl' => 'https://mediart.pro']
        );
        $this->assertNotEmpty(Site::where(['host' => 'mediart.pro'])->first());
    }

    public function testSitesRoutesRouteDeleteReturn_404ForUnknownIdWithUser()
    {
        $response = $this->actingAs($this->user)->get(
            route(SitesRoutes::ROUTE_SITES_DELETE, ['id' => 0, 'lang' => App::getLocale()])
        );
        $response->assertStatus(404);
    }

    public function testSitesRoutesRouteDeleteReturnRedirectToSitesIndexRouteOnSuccessWithUser()
    {
        $site = Site::factory()->create();
        $response = $this->actingAs($this->user)->get(
            route(SitesRoutes::ROUTE_SITES_DELETE, ['id' => $site->id, 'lang' => App::getLocale()])
        );
        $response->assertRedirect(route(SitesRoutes::ROUTE_SITES_INDEX, ['lang' => App::getLocale()]));
    }
}
