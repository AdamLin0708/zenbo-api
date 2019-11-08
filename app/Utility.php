<?php

namespace App;


class Utility
{
    public static function addWhoColumn($item, $who_user_id, $program_who_user_id, $is_created = false, $time = null){

        $info = array();
        if(is_null($time)){
            $now = date('Y-m-d H:i:s');
        } else {
            $now = $time;
        }

        if($is_created){
            $info = [
                'created_by' => $who_user_id,
                'created_at' => $now,
                'updated_by' => $who_user_id,
                'updated_at' => $now,
                'program_created_by' => $program_who_user_id,
                'program_created_at' => $now,
                'program_updated_by' => $program_who_user_id,
                'program_updated_at' => $now,
            ];
        } else {
            $info = [
                'updated_by' => $who_user_id,
                'updated_at' => $now,
                'program_updated_by' => $program_who_user_id,
                'program_updated_at' => $now,
            ];
        }
        $item = array_merge($item, $info);
        return $item;

    }
}
