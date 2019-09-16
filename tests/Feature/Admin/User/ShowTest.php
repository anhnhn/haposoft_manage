<?php

namespace Tests\Feature\Admin\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    public function testShowSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $response = $this->call('get', route('users.show', $user->id));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.user.show');
        $response->assertViewHas('user');
        $response->assertViewHas('url');
    }

    public function testShowFail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $response = $this->call('get', route('users.show', $user->id+1));
        $this->assertEquals(404, $response->status());
    }
}
