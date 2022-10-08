<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use Database\Factories\RoleFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_role_can_be_store_to_data_base()
    {
        $response = $this->post('api/role/create', [
            "name" => "client",
            "description" => "role de client"
        ]);
        $response->assertStatus(201);
        $this->assertCount(1, Role::all());
        $response->assertJson([
            'success' => true,
            'message' => "role created",
            "data"    => [
                "id" => 1,
                "role_name" => "client",
                "role_description" => "role de client"
            ]
        ]);
    }

    public function test_name_and_description_role_at_cannot_be_null()
    {
        $response = $this->post('api/role/create', [
            "name" => "",
            "description" => ""
        ]);
        $response->assertStatus(422);
        $response->assertJsonPath("success", false);
    }

    public function test_role_can_be_updated()
    {
        $this->post('api/role/create', [
            "name" => "client",
            "description" => "role de client"
        ]);

        $role = Role::first();

        $response = $this->put('api/role/update/' . $role->id, [
            "name" => "client",
            "description" => "updated role client"
        ]);
        $response->assertOk();
        $this->assertEquals("updated role client", Role::first()->role_description);
    }

    public function test_display_specific_role_by_id()
    {
        $this->post('api/role/create', [
            "name" => "client",
            "description" => "role de client"
        ]);

        $role = Role::first();

        $response = $this->get('api/role/' . $role->id);

        $response->assertOk();
        $response->assertJson([
            'success' => true,
            'message' => "role id:" . $role->id,
            "data"    => [
                "id" => $role->id,
                "role_name" => $role->role_name,
                "role_description" => $role->role_description
            ]
        ]);
    }

    public function test_display_collection_role()
    {
        $this->post('api/role/create', [
            "name" => "client",
            "description" => "role de client"
        ]);

        $role = Role::first();

        $response = $this->get('role/get/all');

        $response->assertOk();
    }
}
