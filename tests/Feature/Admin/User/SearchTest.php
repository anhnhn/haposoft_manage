<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    public function testSearchSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $users = factory(User::class, 5)->create();
        $data = [
            'userName' => $users->first()->name,
        ];
        $response = $this->call('get', route('users.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.user.index');
        $response->assertViewHas('users');
    }

    public function testSearchNullFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $users = factory(User::class, 5)->create();
        $data = [
            'userName' => '',
        ];
        $response = $this->call('get', route('users.search'), $data);
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.user.index');
        $response->assertViewHas('users');
    }
}
