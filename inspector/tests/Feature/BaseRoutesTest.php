<?php

namespace Tests\Feature;

use App\Services\Routes\Providers\BaseRoutes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class BaseRoutesTest
 * @package Tests\Feature
 * @group routes
 * @group app
 */
class BaseRoutesTest extends TestCase
{
    use RefreshDatabase;

    /** HAS ROUTES **/
    public function testBaseRoutesHasRouteIndex()
    {
        $this->assertNotEmpty(
            BaseRoutes::ROUTE_INDEX,
            'BaseRoutes has not got ROUTE_INDEX'
        );
    }

    public function testBaseRoutesHasRouteLogin()
    {
        $this->assertNotEmpty(
            BaseRoutes::ROUTE_LOGIN,
            'BaseRoutes has not got ROUTE_LOGIN'
        );
    }

    public function testBaseRoutesHasRouteLogout()
    {
        $this->assertNotEmpty(
            BaseRoutes::ROUTE_LOGOUT,
            'BaseRoutes has not got ROUTE_LOGOUT'
        );
    }

    /** ROUTES HAS CORRECT VALUE **/
    public function testBaseRoutesRouteIndexIsIndex()
    {
        $this->assertEquals(
            'index',
            BaseRoutes::ROUTE_INDEX,
            'BaseRoutes ROUTE_INDEX value is not index'
        );
    }

    public function testBaseRoutesRouteLoginIsAppLogin()
    {
        $this->assertEquals(
            'app-login',
            BaseRoutes::ROUTE_LOGIN,
            'BaseRoutes ROUTE_LOGIN value is not app-login'
        );
    }

    public function testBaseRoutesRouteLogoutIsAppLogout()
    {
        $this->assertEquals(
            'app-logout',
            BaseRoutes::ROUTE_LOGOUT,
            'BaseRoutes ROUTE_LOGOUT value is not app-logout'
        );
    }

    /** ROUTES RETURNS **/
    public function testBaseRoutesRouteIndexReturnSuccessful()
    {
        $response = $this->get(route(BaseRoutes::ROUTE_INDEX));
        $response->assertSuccessful();
    }

    public function testBaseRoutesRouteIndexGetReturn_200()
    {
        $response = $this->get(route(BaseRoutes::ROUTE_INDEX));
        $response->assertStatus(200);
    }

    public function testBaseRoutesRouteLoginGetReturn_404ByDefault()
    {
        $response = $this->get(route(BaseRoutes::ROUTE_LOGIN));
        $response->assertStatus(404);
    }

    public function testBaseRoutesRouteLoginPostReturn_401WithNoParameters()
    {
        $response = $this->post(route(BaseRoutes::ROUTE_LOGIN));
        $response->assertStatus(401);
    }

    public function testBaseRoutesRouteLoginPostReturnErrorForKeyLengthWithIncorrectParameters()
    {
        $response = $this->postJson(
            route(BaseRoutes::ROUTE_LOGIN),
            ['key' => 0]
        );
        $response->assertJsonValidationErrors(
            ['key' => 'The key must be 10 characters.']
        );
    }

    public function testBaseRoutesRouteLoginPostReturnErrorForKeyTypeWithIncorrectParameters()
    {
        $response = $this->postJson(
            route(BaseRoutes::ROUTE_LOGIN),
            ['key' => 0]
        );
        $response->assertJsonValidationErrors(
            ['key' => 'The key must be a string.']
        );
    }

    public function testBaseRoutesRouteLoginPostReturn_202WithCorrectParameters()
    {
        $key = env('CRM_ACCESS_KEY');
        if (empty($key)) {
            $this->markTestSkipped();
        } else {
            $response = $this->post(
                route(BaseRoutes::ROUTE_LOGIN),
                ['key' => $key]
            );
            $response->assertStatus(202);
        }
    }

    public function testBaseRoutesRouteLoginPostReturnSuccessAndRedirectWithCorrectParameters()
    {
        $key = env('CRM_ACCESS_KEY');
        if (empty($key)) {
            $this->markTestSkipped();
        } else {
            $response = $this->post(
                route(BaseRoutes::ROUTE_LOGIN),
                ['key' => $key]
            );
            $response->assertJsonStructure(['success', 'redirect']);
        }
    }

    public function testBaseRoutesRouteLogoutGetReturn_302ByDefault()
    {
        $response = $this->get(route(BaseRoutes::ROUTE_LOGOUT));
        $response->assertStatus(302);
    }
}
