<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Seeders;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Model;
>>>>>>> dev
use Illuminate\Database\Seeder;

class BlogDatabaseSeeder extends Seeder
{
<<<<<<< HEAD
    public function run()
    {
        $this->call([
            SiteSeeder::class,
            ArticleSeeder::class,
        ]);
=======
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
>>>>>>> dev
    }
}
