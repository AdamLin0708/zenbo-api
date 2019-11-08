<?php


function successResponse($message, $data = null, $options = null)
{
    $result = array();
    $result['status'] = 'success';
    $result['message'] = $message;
    $result['data'] = $data;
    if (!is_null($options)) {
        $result = array_merge($result, $options);
    }
    return $result;

}

function errorResponse($message, $data = null, $options = null, $isLogError = true)
{
    $result = array();
    $result['status'] = 'error';
    $result['message'] = $message;
    $result['data'] = $data;
    if (!is_null($options)) {
        $result = array_merge($result, $options);
    }
    if($isLogError){
        \Illuminate\Support\Facades\Log::error($result);
    }
    return $result;

}
