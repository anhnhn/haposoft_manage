<?php

namespace Tests\Feature\Admin\User;

use App\Models\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateSuccessFully()
    {
        parent::loginAdmin();
        $departments = factory(Department::class, 5)->create();
        $response = $this->call('get', route('users.create'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.user.create');
        $response->assertViewHas('departments');
    }
}
