<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan("db:seed");
    }

    /** @test */
    public function super_admin_can_create_admins()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\Admin')->create());
        $admin = [
            'name' => 'John Doe',
            'email' => 'john@novavera.com',
            'role_id' => 1
        ];

        $this->post('/dashboard/admins', $admin)
            ->assertStatus(200);
    }
}
