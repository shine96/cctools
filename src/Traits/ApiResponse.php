<?php


namespace CCTools\Traits;


use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    protected $headers = [
        'X-Author' => 'cctools',
    ];

    public function success($msg,$data,$code = 200)
    {
        $result = [];
        $msg ? $result['msg'] = $msg : $result['msg'] = 'ok';
        $result['code'] = $code;
        $result['data'] = $data;
        ksort($result);
        return response()->json($result,200,$this->headers);
    }


    public function error($msg,$code = 500)
    {
        $result = [];
        $msg ? $result['msg'] = $msg : $result['msg'] = 'fail';
        $result['code'] = $code;
        ksort($result);
        return response()->json($result,200,$this->headers);
    }
}