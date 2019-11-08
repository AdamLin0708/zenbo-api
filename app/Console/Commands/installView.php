<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class installView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'zenbo:installView';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
         * 新增規則
         * (1)將建立好的View，其名稱加入下列的列表之中
         * (2)一般而言，最新新增的要放到最後
         * (3)若是原先的view會使用到即將新增的view，依據dependency，必須將新增的view放到原先的view之前
         */

        $viewClassLists = [
            'CreateVdVideoZv',
            'CreateVdQuizUserZv'
        ];
        for($i=0; $i<count($viewClassLists); $i++){
            $viewClassName = $viewClassLists[$i];
            $view = new $viewClassName();
            $view->up();
        }

    }
}
