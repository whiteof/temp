<?php
/*
    $servername = "its-yrkmysqlt01.med.cornell.edu";
    $username = "itsapi_app_dev";
    $password = "jhh37hysFjDSX";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=itsapi_dev", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);
$apnsHost = 'gateway.sandbox.push.apple.com';
$apnsCert = '/var/www/html/its-api/public/certificates/ApnsDev.pem';
$apnsPort = 2195;
$token = 'eb9191eb19212f36cce61f17b85501c9eeb958ca99e14c32441dac27feec9243';
$payload['aps'] = array('alert' => "Somebody came to Mohammad's office!", 'sound' => 'default');
$output = json_encode($payload);
$token = pack('H*', str_replace(' ', '', $token));
$apnsMessage = chr(0).chr(0).chr(32).$token.chr(0).chr(strlen($output)).$output;
$streamContext = stream_context_create();
stream_context_set_option($streamContext, 'ssl', 'local_cert', $apnsCert);
$apns = stream_socket_client('ssl://'.$apnsHost.':'.$apnsPort, $error, $errorString, 2, STREAM_CLIENT_CONNECT, $streamContext);
fwrite($apns, $apnsMessage);
fclose($apns);
var_dump($errorString);