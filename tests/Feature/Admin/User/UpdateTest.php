<?php

namespace Tests\Feature\Admin\User;

use App\Models\Department;
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
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $data =  [
            'name' => str_repeat('a', 49),
            'email' => 'namanh@gmail.com',
            'password' => '123456',
            'birth_day' => '2016-05-24',
            'address' => 'Ha Noi',
            'phone' => str_repeat('1', 11),
            'avatar' => UploadedFile::fake()
                ->image('avatar.png', 400, 400)->size(500),
            'role_name' => 'user',
            'department_id' => $department->id,
        ];
        $response = $this->call('put', route('users.update', $user->id), $data);
        $this->assertDatabaseHas('users', [
            'name' => str_repeat('a', 49),
            'email' => 'namanh@gmail.com',
            'birth_day' => '2016-05-24',
            'address' => 'Ha Noi',
            'phone' => str_repeat('1', 11),
            'role_name' => 'user',
            'department_id' => $department->id,
        ]);
        $response->assertRedirect(route('users.index'));
    }

    public function testUpdateFail() {
        parent::loginAdmin();
        $department = parent::createDepartment();
        $user = parent::createUser();
        $data = [
            'name' => str_repeat('a', 51),
            'email' => 'namanh01@gmail.com',
            'password' => '12345',
            'birth_day' => Carbon::tomorrow(),
            'address' => '',
            'phone' => str_repeat('1', 9),
            'avatar' => UploadedFile::fake()
                ->image('avatar.png', 400, 400)->size(6000),
            'role_name' => 'user',
            'department_id' => '',
        ];
        $dateNow = Carbon::today();
        $response = $this->call('post', route('users.store'), $data);
        $errors = [
            'name' => 'The name may not be greater than 50 characters.',
            'password' => 'The password must be at least 6 characters.',
            'address' => 'The address field is required.',
            'phone' => 'The phone must be between 10 and 15 digits.',
            'avatar' => 'The avatar may not be greater than 5120 kilobytes.',
            'department_id' => 'The department\'s name field is required.',
            'birth_day' => __('validation.before', [
                'attribute' => 'birth day',
                'date' => $dateNow,
            ])
        ];
        $response->assertStatus(302)
            ->assertSessionHasErrors($errors);
    }
}
