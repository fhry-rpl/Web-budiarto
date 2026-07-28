<?php

use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

error_reporting(E_ALL);
ini_set('display_errors', '1');

error_log('BOOTSTRAP: starting');

$basePath = dirname(__DIR__);

error_log('BOOTSTRAP: basePath='.$basePath);
error_log('BOOTSTRAP: is_writable(cache)='.(is_writable($basePath.'/bootstrap/cache') ? 'yes' : 'no'));

if (! is_writable($basePath.'/bootstrap/cache')) {
    $tmpBootstrap = '/tmp/bootstrap';
    $tmpCacheDir = $tmpBootstrap.'/cache';

    if (! is_dir($tmpCacheDir)) {
        mkdir($tmpCacheDir, 0755, true);
        error_log('BOOTSTRAP: created tmp cache dir');
    }

    foreach (['packages.php', 'events.php'] as $file) {
        $src = $basePath.'/bootstrap/cache/'.$file;
        $dst = $tmpCacheDir.'/'.$file;
        if (file_exists($src) && ! file_exists($dst)) {
            copy($src, $dst);
            error_log('BOOTSTRAP: copied '.$file.' to tmp');
        }
    }
}

error_log('BOOTSTRAP: creating application');

$app = Application::configure(basePath: $basePath)
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

error_log('BOOTSTRAP: app created');

if (isset($tmpBootstrap)) {
    $app->useBootstrapPath($tmpBootstrap);
    error_log('BOOTSTRAP: set bootstrap path to /tmp/bootstrap');
}

error_log('BOOTSTRAP: binding custom connector');

$app->bind('db.connector.pgsql', fn () => new App\Database\Connectors\PostgresConnector);

error_log('BOOTSTRAP: done');

return $app;
