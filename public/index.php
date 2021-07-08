<?php

$hetznerUsername = 'chordrdbwt';

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if(strpos(__DIR__, $hetznerUsername))
{
    if (file_exists('/usr/home/'.$hetznerUsername.'/storage/framework/maintenance.php')) {
        require '/usr/home/'.$hetznerUsername.'/storage/framework/maintenance.php';
    }
    require '/usr/home/'.$hetznerUsername.'/vendor/autoload.php';
    $app = require_once '/usr/home/'.$hetznerUsername.'/bootstrap/app.php';

}else{

    require __DIR__.'/../vendor/autoload.php';
    $app = require_once __DIR__.'/../bootstrap/app.php';
}


$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);
