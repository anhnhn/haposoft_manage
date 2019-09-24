<?php

namespace Tests\Feature\Admin\User;

use Illuminate\Http\UploadedFile;
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
        $user = parent::createUser();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'birth_day' => $user->birth_day,
            'address' => $user->address,
            'phone' => $user->phone,
            'role_name' => 'user',
            'department_id' => $department->id,
        ];
        $response = $this->call('delete', route('users.destroy', $user->id));
        $this->assertSoftDeleted('users', $data);
        $response->assertRedirect(route('users.index'));
    }

    public function testDestroyfail()
    {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $response = $this->call('delete', route('users.destroy', $user->id+1));
        $response->assertStatus(404);
    }
}
