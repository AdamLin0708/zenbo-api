<?php

use App\Utility;
use Illuminate\Database\Seeder;

class LookupCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * 新增時，要和之前一組的預留約30-50個空間
         * 如ADDRESS_TYPE為 -10000 ~ -10005
         * 因此要新增APPROVAL_REQ_TYPE時
         * 必須將第一筆設為 -10050
         */
        $data =[

            ['code_id'=>-10000,'code_abbr'=>'ADMIN','name'=>'後台管理人員','type_abbr'=>'USER_TYPE'],
            ['code_id'=>-10001,'code_abbr'=>'ZAPP','name'=>'Zenbo使用者','type_abbr'=>'USER_TYPE'],
        ];

        for ($i = 0; $i < count($data); $i++) {
            $item = $data[$i];
            $exist_count = DB::table('lookup_code')->where('code_id', $item['code_id'])->count();
            if ($exist_count == 0) {
                $item = Utility::addWhoColumn($item, '-1000', '-1000', true, '2015-10-22');
                DB::table('lookup_code')->insert($item);
            }
        };
    }
}
