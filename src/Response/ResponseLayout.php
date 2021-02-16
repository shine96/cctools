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
                if (is_array($msg)){
                    $result['msg'] = $bool ? '操作成功' : '操作失败';
                    $result['data'] = $msg;
                }else{
                    $result['msg'] = $msg;
                    $result['data'] = $data;
                }
            }
            return response()->json($result,$code == 200 ? $code : $code);
        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}