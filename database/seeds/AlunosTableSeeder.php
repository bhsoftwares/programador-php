<?php

use App\Alunos;
use Illuminate\Database\Seeder;

class AlunosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Alunos::class, 20)->create();
    }
}
