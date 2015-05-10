<?php

class URLChecker {

    public static $errormsg = '';

    public static function isURLvalid($url){
        if(filter_var($url, FILTER_VALIDATE_URL) === false){
            self::$errormsg = $url.' is not valid!';
            return false;
        }

        if(self::getDomain($url) === self::getDomain(SHORTENER_URL)){
            self::$errormsg = 'haha.';
            return false;
        }
        return true;
    }

    public static function isURLavailable($url){
        $curl = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 2,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS | CURLPROTO_FTP | CURLPROTO_FTPS | CURLPROTO_SFTP | CURLPROTO_SCP,
            CURLOPT_REDIR_PROTOCOLS => CURLPROTO_HTTP | CURLPROTO_HTTPS | CURLPROTO_FTP | CURLPROTO_FTPS | CURLPROTO_SFTP | CURLPROTO_SCP,
            CURLOPT_REFERER => SHORTENER_URL,
            CURLOPT_NOBODY => true
        );

        curl_setopt_array($curl, $options);
        $c = curl_exec($curl);


        if(!curl_errno($curl)){
            $scode = curl_getinfo($curl, CURLINFO_HTTP_CODE).'';
            $one = $scode[0];
            if($one == "2" || $one == "3"){
                return true;
            }else{
                self::$errormsg = 'Connection returned '.$scode;
            }
        }else{
            self::$errormsg = curl_error($curl);
        }

        return false;
    }

    public static function getDomain($url){
        $result = parse_url($url);
        return isset($result['host']) ? $result['host'] : false;
    }


} 