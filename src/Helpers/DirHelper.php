<?php

namespace Yudhi\Apigen\Helpers;

class DirHelper
{
    public static function stubDir( $path='')
    {
        if($path==''){
            return __DIR__.DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'stubs';
        }else{
            return __DIR__.DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . $path;
        }
    }

}