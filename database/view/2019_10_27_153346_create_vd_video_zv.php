<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVdVideoZv extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public static $table_name = 'vd_video_zv';
    public function up()
    {
        //DB::statement('DROP VIEW IF EXISTS '. self::$table_name);
        $view_name = self::$table_name;
        $sql = <<<EOF
create or replace view $view_name as
select
	vd_video.video_id,
	vd_video.name as video_name,
	vd_video.description as video_description,
	vd_video.url_link as video_url_link
from vd_video
EOF;

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
