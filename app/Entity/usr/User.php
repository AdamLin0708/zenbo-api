<?php
/**
 * UCARER CONFIDENTIAL
 * Copyright 2015 優護平台股份有限公司 <http://www.ucarer.tw>
 * All Rights Reserved.
 */

namespace App\Entity\usr;

use App\Utility\WhoColumnTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use WhoColumnTrait;
    protected $table = "usr_user";
    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
