<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::statement('TRUNCATE TABLE language;');
        DB::statement('TRUNCATE TABLE entity;');
        DB::statement('TRUNCATE TABLE novelty_type;');
        DB::statement('TRUNCATE TABLE novelty_type_lang;');
        DB::statement('TRUNCATE TABLE zone;');
        DB::statement('TRUNCATE TABLE zone_lang;');
        DB::statement('TRUNCATE TABLE location;');
        DB::statement('TRUNCATE TABLE color_type;');
        DB::statement('TRUNCATE TABLE color_type_lang;');
        DB::statement('TRUNCATE TABLE light_type;');
        DB::statement('TRUNCATE TABLE light_type_lang;');
        DB::statement('TRUNCATE TABLE character_type;');
        DB::statement('TRUNCATE TABLE character_type_lang;');
        DB::statement('TRUNCATE TABLE chart;');
        DB::statement('TRUNCATE TABLE chart_edition;');
        DB::statement('TRUNCATE TABLE notice;');
        DB::statement('TRUNCATE TABLE notice_lang;');
        DB::statement('TRUNCATE TABLE coordinate;');
        DB::statement('TRUNCATE TABLE aid_type;');
        DB::statement('TRUNCATE TABLE aid_type_lang;');
        DB::statement('TRUNCATE TABLE aid;');
        DB::statement('TRUNCATE TABLE aid_lang;');
        DB::statement('TRUNCATE TABLE aid_chart;');
        DB::statement('TRUNCATE TABLE notice_aid;');

        // $this->call(UsersTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(EntityTableSeeder::class);
        $this->call(NoveltyTypeTableSeeder::class);
        $this->call(NoveltyTypeLangTableSeeder::class);
        $this->call(ZoneTableSeeder::class);
        $this->call(ZoneLangTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(ColorTypeTableSeeder::class);
        $this->call(ColorTypeLangTableSeeder::class);
        $this->call(LightTypeTableSeeder::class);
        $this->call(LightTypeLangTableSeeder::class);
        $this->call(CharacterTypeTableSeeder::class);
        $this->call(CharacterTypeLangTableSeeder::class);
        $this->call(ChartTableSeeder::class);
        $this->call(ChartEditionTableSeeder::class);
        $this->call(NoticeTableSeeder::class);
        $this->call(NoticeLangTableSeeder::class);
        $this->call(CoordinateTableSeeder::class);
        $this->call(AidTypeTableSeeder::class);
        $this->call(AidTypeLangTableSeeder::class);
        $this->call(AidTableSeeder::class);
        $this->call(AidLangTableSeeder::class);
        $this->call(AidChartTableSeeder::class);
        $this->call(NoticeAidTableSeeder::class);
        // $this->call(AvisoCartaTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}