<?php

namespace Tests\Feature\Admin\User;

use App\Models\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testEditSuccessFully()
    {
        parent::loginAdmin();
        $departments = factory(Department::class, 5)->create();
        $user = parent::createUser();
        $response = $this->call('get', route('users.edit', $user->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.user.update');
        $response->assertViewHas('user');
        $response->assertViewHas('departments');
        $response->assertViewHas('url');
    }

    public function testEditFail()
    {
        parent::loginAdmin();
        $departments = factory(Department::class, 5)->create();
        $user = parent::createUser();
        $response = $this->call('get', route('users.edit', $user->id+1));
        $this->assertEquals(404, $response->status());
    }
}
