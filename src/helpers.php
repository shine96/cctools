<?php

if (! function_exists('milliseconds')) {
    function milliseconds(): float
    {
        list($msec,$sec) = explode(' ',microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }
}