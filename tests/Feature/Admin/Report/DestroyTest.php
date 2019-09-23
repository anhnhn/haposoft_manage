<?php

namespace Tests\Feature\Admin\Report;

use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyTest extends TestCase
{
    use RefreshDatabase;

    public function testDestroySuccessFully()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $user = parent::createUser();
        $report = parent::createReport();
        $task = factory(Task::class)->create();
        $data = [
            'name' => $report->name,
            'content' => $report->content,
            'user_id' => $report->user_id,
        ];
        $response = $this->call('delete', route('reports.destroy', $report->id));
        $this->assertSoftDeleted('reports', $data);
        $this->assertDatabaseMissing('report_task', [
            'report_id' => $report->id,
        ]);
        $this->assertSoftDeleted('reports', $data);
        $response->assertRedirect(route('reports.index'));
    }

    public function testDestroyfail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $customer = parent::createCustomer();
        $project = parent::createProject();
        $user = parent::createUser();
        $report = parent::createReport();
        $task = factory(Task::class)->create();
        $response = $this->call('delete', route('reports.destroy', $report->id+1));
        $response->assertStatus(404);
    }
}
