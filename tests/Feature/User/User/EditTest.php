<?php

namespace Tests\Feature\User\User;

use App\Models\Department;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    public function testEditSuccessFully()
    {
        factory(Department::class, 5)->create();
        $user = parent::loginUser();
        $response = $this->call('get', route('user-users.edit', $user->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.update');
        $response->assertViewHas('user');
        $response->assertViewHas('url');
    }

    public function testEditFail()
    {
        parent::createDepartment();
        $user = parent::loginUser();
        factory(Department::class, 5)->create();
        $response = $this->call('get', route('user-users.edit', $user->id+1));
        $this->assertEquals(404, $response->status());
    }
}
