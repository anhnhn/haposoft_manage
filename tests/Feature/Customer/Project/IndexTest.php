<?php

namespace Tests\Feature\Customer\Project;

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
        parent::loginCustomer();
        factory(Project::class, 5)->create();
        $response = $this->call('get', route('customer-projects.index'));
        $this->assertEquals(200, $response->status());
        $response->assertViewIs('customer.project.index');
        $response->assertViewHas('customer');
        $response->assertViewHas('projects');
    }
}
