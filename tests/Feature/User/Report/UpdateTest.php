<?php

namespace Tests\Feature\User\Report;

use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateSuccessFully()
    {
        $department = factory(Department::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user, 'web');
        $report = $this->createReport();
        parent::createCustomer();
        parent::createProject();
        factory(Task::class, 2)->create();
        $data = [
            'name' => str_repeat('a', 49),
            'content' => str_repeat('a', 500),
            'user_id' => $user->id,
        ];
        $response = $this->call('put', route('user-reports.update', $report->id), $data);
        $this->assertDatabaseHas('reports', [
            'name' => str_repeat('a', 49),
            'content' => str_repeat('a', 500),
            'user_id' => $user->id,
        ]);
        $response->assertRedirect(route('users.showReport', $user->id));
    }

    public function testUpdateFail()
    {
        $department = factory(Department::class)->create();
        $user = factory(User::class)->create();
        $this->actingAs($user, 'web');
        $report = $this->createReport();
        parent::createCustomer();
        parent::createProject();
        factory(Task::class, 2)->create();
        $data = [
            'name' => str_repeat('a', 101),
            'content' => str_repeat('a', 1001),
            'user_id' => 'abc',
        ];
        $response = $this->call('put', route('user-reports.update', $report->id), $data);
        $errors = [
            'name' => 'The name may not be greater than 100 characters.',
            'content' => 'The content may not be greater than 1000 characters.',
            'user_id' => 'The user\'s name must be a number.'
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
