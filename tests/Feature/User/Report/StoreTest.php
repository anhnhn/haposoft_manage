<?php

namespace Tests\Feature\User\Report;

use App\Models\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreSuccessFully()
    {
        parent::createDepartment();
        $user = parent::loginUser();
        parent::createCustomer();
        parent::createProject();
        factory(Task::class, 5)->create();
        $response = $this->call('post', route('user-reports.store'), [
            'name' => str_repeat('a', 50),
            'content' => str_repeat('a', 500),
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('reports', [
            'name' => str_repeat('a', 50),
            'content' => str_repeat('a', 500),
            'user_id' => $user->id,
        ]);
        $response->assertRedirect(route('users.showReport', $user->id));
    }

    public function testStoreFail()
    {
        parent::createDepartment();
        $user = parent::loginUser();
        parent::createCustomer();
        parent::createProject();
        factory(Task::class, 5)->create();
        $data = [
            'name' => str_repeat('a', 101),
            'content' => str_repeat('a', 1010),
            'user_id' => 'abc',
        ];
        $response = $this->call('post', route('user-reports.store'), $data);
        $errors = [
            'name' => 'The name may not be greater than 100 characters.',
            'content' => 'The content may not be greater than 1000 characters.',
            'user_id' => 'The user\'s name must be a number.',
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
