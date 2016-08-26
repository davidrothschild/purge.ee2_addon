<?php
$cache_path = '/tmp/nginx-cache/';

if ( $_POST['url'] === "0" ) { // all
    $response = shell_exec( 'rm -Rf '.$cache_path.'*' );
    echo $response ? $response : 'OK';
    exit;
}

$url = parse_url($_POST['url']);
if(!$url)
{
    echo 'Invalid URL entered';
    die();
}
$scheme = $url['scheme'];
$host = $url['host'];
$requesturi = $url['path'];
$hash = md5($scheme.'GET'.$host.$requesturi);
var_dump(unlink($cache_path . substr($hash, -1) . '/' . substr($hash,-3,2) . '/' . $hash));
?>
