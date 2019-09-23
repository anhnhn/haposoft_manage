<?php

namespace Tests\Feature\Admin\User;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexSuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $data[] = factory(User::class, 5)->create();
        $response = $this->call('get', route('users.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.user.index');
        $response->assertViewHas('users');
    }
}
