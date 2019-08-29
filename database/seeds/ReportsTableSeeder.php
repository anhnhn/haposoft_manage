<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ReportsTableSeeder extends Seeder
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
        $tasks = App\Models\Task::all();
        factory(App\Models\Report::class, 30)->create();
        App\Models\Report::all()->each(function ($report) use ($tasks) {
            $report->tasks()->attach( $tasks->random()->id,
                ['report_id' => $this->faker->numberBetween(1, 30)]
            );
        });
    }
}
