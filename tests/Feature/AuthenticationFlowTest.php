<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationFlowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test 1: Non-authenticated user can access login page
     */
    public function test_unauthenticated_user_can_access_login_page()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /**
     * Test 2: Root redirects to login
     */
    public function test_root_redirects_to_login()
    {
        $response = $this->get('/');
        $response->assertRedirect('/login');
    }

    /**
     * Test 3: Authenticated user cannot access login page
     */
    public function test_authenticated_user_cannot_access_login_page()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/login');

        // Should redirect to dashboard
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test 4: Unauthenticated user cannot access dashboard
     */
    public function test_unauthenticated_user_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');

        // Should redirect to login
        $response->assertRedirect('/login');
    }

    /**
     * Test 5: Authenticated user can access dashboard
     */
    public function test_authenticated_user_can_access_dashboard()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    }

    /**
     * Test 6: Logout works correctly
     */
    public function test_logout_redirects_to_login()
    {
        $user = User::factory()->create();

        // Login first
        $this->actingAs($user);

        // Then logout
        $response = $this->post('/logout');

        // Should redirect to login
        $response->assertRedirect('/login');

        // User should be logged out
        $this->assertGuest();
    }

    /**
     * Test 7: Session persists after login
     */
    public function test_session_persists_after_login()
    {
        $user = User::factory()->create();

        // Login
        $this->actingAs($user);

        // Access dashboard
        $response = $this->get('/dashboard');
        $response->assertStatus(200);

        // User should still be authenticated
        $this->assertAuthenticatedAs($user);
    }

    /**
     * Test 8: User cannot access logout without being authenticated
     */
    public function test_unauthenticated_user_cannot_logout()
    {
        $response = $this->post('/logout');

        // Should redirect to login
        $response->assertRedirect('/login');
    }

    /**
     * Test 9: Google login route requires guest middleware
     */
    public function test_authenticated_user_cannot_access_google_login()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/auth/google');

        // Should redirect to dashboard
        $response->assertRedirect('/dashboard');
    }

    /**
     * Test 10: Login page view has expected content
     */
    public function test_login_page_has_expected_content()
    {
        $response = $this->get('/login');

        // Should see the page
        $response->assertStatus(200);

        // Should contain "Connexion avec Google" button
        $response->assertSee('Connexion avec Google');

        // Should extend auth layout
        $response->assertViewIs('auth.login');
    }
}
