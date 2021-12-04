<?php

$dsn = 'mysql:host=localhost;dbname=engineer';
$user = 'root';
$pass = '';
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);


function convert_id($action,$string){

    $output = '';

    $encrypt_method = 'BF-CBC';

    $security_key = 'Eng\azima';

    $secret_iv = 'Eng\ ';

    $key = hash('gost',$security_key);

    $init_vector = substr(hash('gost',$secret_iv),0,8);

    if($string != ''){

        if($action == 'encrypt'){

            $output = openssl_encrypt($string,$encrypt_method,$key,0,$init_vector);

            $output = base64_encode($output);

        }
        if($action == 'decrypt'){

            $output = openssl_decrypt(base64_decode($string),$encrypt_method,$key,0,$init_vector);
        }
    }
    return $output;
};

function convert_string($action,$string){

    $output = '';

    $encrypt_method = 'AES-256-CBC';

    $security_key = 'Eng\azima';

    $secret_iv = 'Eng\ ';

    $key = hash('gost',$security_key);

    $init_vector = substr(hash('gost',$secret_iv),0,16);

    if($string != ''){

        if($action == 'encrypt'){

            $output = openssl_encrypt($string,$encrypt_method,$key,0,$init_vector);

            $output = base64_encode($output);

        }
        if($action == 'decrypt'){

            $output = openssl_decrypt(base64_decode($string),$encrypt_method,$key,0,$init_vector);
        }
    }
    return $output;
};

try{

    $conn = new PDO($dsn,$user,$pass,$option);

    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){

    echo 'Failed' . $e->getMessage();
}
