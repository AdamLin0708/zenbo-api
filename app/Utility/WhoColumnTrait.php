<?php
/**
 * UCARER CONFIDENTIAL
 * Copyright 2015 優護平台股份有限公司 <http://www.ucarer.tw>
 * All Rights Reserved.
 */
namespace App\Utility;

trait WhoColumnTrait
{

    public function whocol($created_by, $created_at, $updated_by, $updated_at)
    {
        if (!is_null($created_by)) {
            $this->created_by = $created_by;
        }
        if (!is_null($created_at)) {
            $this->created_at = $created_at;
        }
        if (!is_null($updated_by)) {
            $this->updated_by = $updated_by;
        }
        if (!is_null($updated_at)) {
            $this->updated_at = $updated_at;
        }

    }
    public function progwhocol($created_by, $created_at, $updated_by, $updated_at)
    {
        if (!is_null($created_by)) {
            $this->program_created_by = $created_by;
        }
        if (!is_null($created_at)) {
            $this->program_created_at = $created_at;
        }
        if (!is_null($updated_by)) {
            $this->program_updated_by = $updated_by;
        }
        if (!is_null($updated_at)) {
            $this->program_updated_at = $updated_at;
        }

    }
}
