<?php


namespace CCTools\Response;

final class ResponseLayout
{

    public static function apply($bool = true,$msg = null,$data = array(),$code = 200)
    {
        try {
            $result = [];
            $result['status'] = $bool;
            if (empty($msg)){
                $result['msg'] = $bool ? '操作成功' : '操作失败';
                $result['data'] = $data;
            }else{
                if (is_array($msg) || is_object($msg)){
                    $result['msg'] = $bool ? '操作成功' : '操作失败';
                    $result['data'] = $msg;
                }else{
                    $result['msg'] = $msg;
                    $result['data'] = $data;
                }
            }
            return response()->header('X-Author','mimic/cctools')->json($result,$code == 200 ? $code : $code);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
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
                $result['status'] = $bool == 200 ? true : false;
            }
            if (empty($msg)){
                $result['msg'] = $bool ? '操作成功' : '操作失败';
                $result['data'] = $data;
            }else{
                if (is_array($msg) || is_object($msg)){
                    $result['msg'] = $bool ? '操作成功' : '操作失败';
                    $result['data'] = $msg;
                }else{
                    $result['msg'] = $msg;
                    $result['data'] = $data;
                }
            }
            return response()->header('X-Author','mimic/cctools')->json($result);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}