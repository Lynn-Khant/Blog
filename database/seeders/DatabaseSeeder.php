<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::truncate();
        User::truncate();
        Blog::truncate();

        User::factory(10)->create();
        $mgmg=User::factory()->create(['name'=>'MgMg','username'=>'mg_mg']);
        $aungaung=User::factory()->create(['name'=>'AungAung','username'=>'aung_aung']);

        $frontend=Category::factory()->create(['name'=>'frontend','slug'=>'front_end']);
        $backend=Category::factory()->create(['name'=>'backend','slug'=>'back_end']);

        Blog::factory()->create(['category_id'=>$frontend->id,'user_id'=>$mgmg->id]);
        Blog::factory()->create(['category_id'=>$backend->id,'user_id'=>$mgmg->id]);
        Blog::factory()->create(['category_id'=>$frontend->id,'user_id'=>$aungaung->id]);
        Blog::factory()->create(['category_id'=>$backend->id,'user_id'=>$aungaung->id]);
    }
}
