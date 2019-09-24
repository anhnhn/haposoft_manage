<?php

namespace Tests\Feature\Admin\Project;

use App\Models\Customer;
use App\Models\Project;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexSuccessFully()
    {
        parent::loginAdmin();
        factory(Customer::class, 5)->create();
        factory(Project::class, 10)->create();
        $response = $this->call('get', route('projects.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('admin.project.index');
        $response->assertViewHas('projects');
    }
}
