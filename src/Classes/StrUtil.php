<?php


namespace CCTools\Classes;


class StrUtil
{
    public function randStr($length)
    {
        //字符组合
        $str = '#abcdefghilkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $len = strlen($str) - 1;
        $randStr = '';
        for ($i = 0; $i < $length; $i++) {
            $num = mt_rand(0, $len);
            $randStr .= $str[$num];
        }
        return $randStr;
    }


    public function desensitize($string, $start = 0, $length = 0, $re = '*')
    {
        if (empty($string) || empty($length) || empty($re)) {
            return $string;
        }
        $end = $start + $length;
        $strLen = mb_strlen($string);
        $strArr = array();
        for ($i=0; $i<$strLen; $i++) {
            if ($i>=$start && $i<$end) {
                $strArr[] = $re;
            } else {
                $strArr[] = mb_substr($string, $i, 1);
            }
        }
        return implode('', $strArr);
    }
}