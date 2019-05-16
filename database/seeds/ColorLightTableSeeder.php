<?php

use Illuminate\Database\Seeder;

class ColorLightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('color_light')->insert([
            [
                'alias'         => 'W',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'alias'         => 'R',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'alias'         => 'G',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'alias'         => 'Bu',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'alias'         => 'Vi',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'alias'         => 'Y',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'alias'         => 'Or',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
            [
                'alias'         => 'Am',
                'created_at'    => new \DateTime('now'),
                'updated_at'    => new \DateTime('now'),
                'created_by'    => 'NAUTICA',
                'updated_by'    => 'NAUTICA',
                'is_legacy'     => 0
            ],
        ]);
    }
}
