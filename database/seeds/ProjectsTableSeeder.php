<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\User;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        $users = App\Models\User::all();
        factory(App\Models\Project::class, 30)->create();
        App\Models\Project::all()->each(function ($project) use ($users) {
            $project->users()->attach( $users->random()->id,
                ['project_id' => $this->faker->numberBetween(1, 30), 'start_date' => now(), 'end_date' => now()]
            );
        });
    }
}
