<?php


namespace CCTools\Traits;


use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    public function success($msg,$data,$code = 200)
    {
        $result = [];
        $msg ? $result['msg'] = $msg : $result['msg'] = 'ok';
        $result['code'] = $code;
        $result['data'] = $data;
        return response()->header('X-Author','mimic/cctools')->json($result,200);
    }


    public function error($msg,$code = 500)
    {
        $result = [];
        $msg ? $result['msg'] = $msg : $result['msg'] = 'fail';
        $result['code'] = $code;
        return response()->header('X-Author','mimic/cctools')->json($result,200);
    }
}