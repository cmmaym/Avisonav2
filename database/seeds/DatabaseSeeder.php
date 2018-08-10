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
        DB::statement('TRUNCATE TABLE novelty_type;');
        DB::statement('TRUNCATE TABLE novelty_type_lang;');
        DB::statement('TRUNCATE TABLE zone;');
        DB::statement('TRUNCATE TABLE zone_lang;');
        DB::statement('TRUNCATE TABLE location;');
        DB::statement('TRUNCATE TABLE color_light;');
        DB::statement('TRUNCATE TABLE color_light_lang;');
        DB::statement('TRUNCATE TABLE aid_color_light;');
        DB::statement('TRUNCATE TABLE color_structure;');
        DB::statement('TRUNCATE TABLE color_structure_lang;');
        DB::statement('TRUNCATE TABLE aid_color_structure;');
        DB::statement('TRUNCATE TABLE light_class;');
        DB::statement('TRUNCATE TABLE light_class_lang;');
        DB::statement('TRUNCATE TABLE character_type;');
        DB::statement('TRUNCATE TABLE character_type_lang;');
        DB::statement('TRUNCATE TABLE chart;');
        DB::statement('TRUNCATE TABLE chart_edition;');
        DB::statement('TRUNCATE TABLE report_source;');
        DB::statement('TRUNCATE TABLE reporting_user;');
        DB::statement('TRUNCATE TABLE catalog_ocean_coast;');
        DB::statement('TRUNCATE TABLE light_list;');
        DB::statement('TRUNCATE TABLE notice;');
        DB::statement('TRUNCATE TABLE notice_lang;');
        DB::statement('TRUNCATE TABLE coordinate;');
        DB::statement('TRUNCATE TABLE aid_type;');
        DB::statement('TRUNCATE TABLE aid_type_lang;');
        DB::statement('TRUNCATE TABLE top_mark;');
        DB::statement('TRUNCATE TABLE top_mark_lang;');
        DB::statement('TRUNCATE TABLE aid_type_form;');
        DB::statement('TRUNCATE TABLE aid_type_form_lang;');
        DB::statement('TRUNCATE TABLE aid;');
        DB::statement('TRUNCATE TABLE aid_lang;');
        DB::statement('TRUNCATE TABLE form_type;');
        DB::statement('TRUNCATE TABLE aid_chart;');
        DB::statement('TRUNCATE TABLE notice_aid;');
        DB::statement('TRUNCATE TABLE notice_chart_edition;');
        DB::statement('TRUNCATE TABLE permission;');
        DB::statement('TRUNCATE TABLE role;');
        DB::statement('TRUNCATE TABLE role_permission;');
        DB::statement('TRUNCATE TABLE user;');

        $this->call(LanguageTableSeeder::class);
        $this->call(NoveltyTypeTableSeeder::class);
        $this->call(NoveltyTypeLangTableSeeder::class);
        $this->call(ZoneTableSeeder::class);
        $this->call(ZoneLangTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(ColorLightTableSeeder::class);
        $this->call(ColorLightLangTableSeeder::class);
        $this->call(ColorStructureTableSeeder::class);
        $this->call(ColorStructureLangTableSeeder::class);
        $this->call(LightClassTableSeeder::class);
        $this->call(LightClassLangTableSeeder::class);
        $this->call(CharacterTypeTableSeeder::class);
        $this->call(CharacterTypeLangTableSeeder::class);
        // $this->call(ChartTableSeeder::class);
        // $this->call(ChartEditionTableSeeder::class);
        $this->call(ReportSourceTableSeeder::class);
        $this->call(ReportingUserTableSeeder::class);
        $this->call(CatalogOceanCoastTableSeeder::class);
        $this->call(LightListTableSeeder::class);
        // $this->call(NoticeTableSeeder::class);
        // $this->call(NoticeLangTableSeeder::class);
        // $this->call(CoordinateTableSeeder::class);
        $this->call(AidTypeTableSeeder::class);
        $this->call(AidTypeLangTableSeeder::class);
        $this->call(AidTypeFormTableSeeder::class);
        $this->call(AidTypeFormLangTableSeeder::class);
        $this->call(TopMarkTableSeeder::class);
        $this->call(TopMarkLangTableSeeder::class);
        // $this->call(AidTableSeeder::class);
        // $this->call(AidLangTableSeeder::class);
        // $this->call(FormTypeTableSeeder::class);
        // $this->call(AidChartTableSeeder::class);
        // $this->call(AidColorStructureTableSeeder::class);
        // $this->call(AidColorLightTableSeeder::class);
        // $this->call(NoticeAidTableSeeder::class);
        // $this->call(NoticeChartEditionTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(RolePermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}