<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_order()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/orders', [
            'pickup_address' => 'Test Pickup',
            'delivery_address' => 'Test Delivery',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['id', 'pickup_address', 'delivery_address', 'status']);

        $this->assertDatabaseHas('orders', ['pickup_address' => 'Test Pickup']);
    }

    public function test_unauthenticated_user_cannot_create_order()
    {
        $response = $this->postJson('/api/orders', [
            'pickup_address' => 'No Auth Pickup',
            'delivery_address' => 'No Auth Delivery',
        ]);

        $response->assertStatus(401);
    }
}
