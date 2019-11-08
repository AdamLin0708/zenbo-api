<?php

use Illuminate\Database\Seeder;

class LookupTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [
                ['type_abbr'=>'USER_TYPE','name'=>'會員種類']
            ];

        for ($i = 0; $i < count($data); $i++) {
            $item = $data[$i];
            $exist_count = DB::table('lookup_type')->where('type_abbr', $item['type_abbr'])->count();
            if ($exist_count == 0) {
                $item = \App\Utility::addWhoColumn($item, '-1000', '-1000', true, '2015-10-22');
                DB::table('lookup_type')->insert($item);
            }
        };

    }
}
