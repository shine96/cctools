<?php


namespace CCTools\Response;

use Illuminate\Http\Exceptions\HttpResponseException;

final class ResponseLayout
{
    protected static $headers = [
        'X-Author' => 'cctools',
    ];

    public static function apply($bool = true,$msg = null,$data = array(),$code = 200)
    {
        try {
            $result = [];
            $result['status'] = $bool;
            $result = self::getResult($msg, $bool, $result, $data);
            return response()->json($result,($code == 200 ? $code : $code),self::$headers);
        }catch (\Exception $exception){
            throw new HttpResponseException($exception->getMessage());
        }
    }


    public static function result($bool,$msg = null,$data = array())
    {
        try {
            $result = [];
            if (is_bool($bool)){
                $result['status'] = $bool;
                if ($bool){
                    $result['code'] = 200;
                }else{
                    $result['code'] = 500;
                }
            }else{
                $result['code'] = $bool;
                $result['status'] = $bool == 200;
            }
            $result = self::getResult($msg, $bool, $result, $data);
            return response()->json($result,200,self::$headers);
        }catch (\Exception $exception){
            throw new HttpResponseException($exception->getMessage());
        }
    }

    /**
     * @param $msg
     * @param $bool
     * @param array $result
     * @param array $data
     * @return array
     */
    public static function getResult($msg, $bool, array $result, array $data): array
    {
        if (empty($msg)) {
            $result['msg'] = $bool ? '操作成功' : '操作失败';
            $result['data'] = $data;
        } else {
            if (is_array($msg) || is_object($msg)) {
                $result['msg'] = $bool ? '操作成功' : '操作失败';
                $result['data'] = $msg;
            } else {
                $result['msg'] = $msg;
                $result['data'] = $data;
            }
        }
        return $result;
    }
}