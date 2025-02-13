<?php
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use App\Mail\CommonMail;

function uuid4() {
    /* 32 random HEX + space for 4 hyphens */
    $out = bin2hex(random_bytes(18));

    $out[8]  = "-";
    $out[13] = "-";
    $out[18] = "-";
    $out[23] = "-";

    /* UUID v4 */
    $out[14] = "4";
    
    /* variant 1 - 10xx */
    $out[19] = ["8", "9", "a", "b"][random_int(0, 3)];

    return $out;
}

function roundoff($num){
  $number=  number_format($num, 2, ".", "");
    // $number = number_format($num, 2);
    return $number;
}


if (!function_exists('encode_data')) {
    /**
     * Encode data
     *
     * @param int $num
     * @return string
     */
    function encode_data($num)
    {

        $num=$num*12+89;
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $base = strlen($alphabet);
        $encoded = '';

        while ($num) {
            $encoded = $alphabet[$num % $base] . $encoded;
            $num = intval($num / $base);
        }

        return $encoded;
    }
}

if (!function_exists('decode_data')) {
    /**
     * Decode data
     *
     * @param string $encoded
     * @return int
     */
    function decode_data($encoded)
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyz';
        $base = strlen($alphabet);
        $length = strlen($encoded);
        $num = 0;

        for ($i = 0; $i < $length; $i++) {
            $num = $num * $base + strpos($alphabet, $encoded[$i]);
        }
        $num=($num-89)/12;
        return $num;
    }
}


if (!function_exists('encode')) {
    /**
     * Encode data
     *
     * @param int $num
     * @return string
     */
    function encode($string)
    {
        $encoded=Crypt::encryptString($string);

       
        return urlencode($encoded);
    }
}

if (!function_exists('decode')) {
    /**
     * Decode data
     *
     * @param string $encoded
     * @return int
     */
    function decode($encoded)
    {
       $urlDecoded=urldecode($encoded);
       $decrypted=Crypt::decryptString($urlDecoded);
    
       return $decrypted;
    }
}


function send_mail($email,$title, $body){
    
    Mail::to($email)
        // ->bcc(['dishantkpr@gmail.com'])
        ->send(new CommonMail(['title'=>$title, 'email'=> $email, 'body'=> $body]));
}


?>