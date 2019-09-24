<?php

namespace Tests\Feature\User\User;

use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexSuccessFully()
    {
        parent::createDepartment();
        parent::loginUser();
        parent::createCustomer();
        factory(Project::class, 5)->create();
        $response = $this->call('get', route('user-users.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('user.home');
        $response->assertViewHas('projects');
    }
}
