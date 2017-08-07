<?php
namespace Home\Common;
class Libs{
    function getClientIp()
    {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        } else {
            return "192.168.0.0";
        }
    }

    function getServerIp()
    {
        if (isset($_SERVER['SERVER_ADDR'])) {
            return $_SERVER['SERVER_ADDR'];
        } else {
            return "192.168.0.0";
        }
    }

    function redirect_jump($url)
    {
        //跳转的url
        echo "<script language='javascript'>location.href = '" . $url . "'</script>";
        exit;
    }

    public  function test(){
        static $a =1;
        echo 88;
    }
}

