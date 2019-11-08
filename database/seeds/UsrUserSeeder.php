<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsrUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        $data = [
            [
                'user_id'=>-1000,
                'user_type_code_abbr'=>'ADMIN',
                'email_login'=>'adminjeff@example.com',
                'effective_start_date'=>'2015-10-22',
                'effective_end_date'=>null
            ]
        ];

        for ($i = 0; $i < count($data); $i++) {
            $item = $data[$i];
            $exist_count = DB::table('usr_user')->where('user_id', $item['user_id'])->count();
            if ($exist_count == 0) {
                $item['password_encrypted'] = Hash::make('secret123');
                $item = \App\Utility::addWhoColumn($item, '-1000', '-1000', true, '2015-10-22');
                DB::table('usr_user')->insert($item);

            }
        };
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
