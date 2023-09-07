<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Support\Arr;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = config('projects');
        $type_ids = Type::pluck('id')->toArray();
        $technology_ids = Technology::pluck('id')->toArray();
        foreach ($projects as $project) {
            $newproject = new Project();
            $newproject->title = $project['title'];
            $newproject->link = $project['link'];
            $newproject->type_id = Arr::random($type_ids);
            $newproject->description = $project['description'];
            $newproject->save();
            $project_technologies = [];
            foreach ($technology_ids as $technology_id) {
                if (rand(0, 1)) $project_technologies[] = $technology_id;
            }
            $newproject->technologies()->attach($project_technologies);
        }
    }
}
