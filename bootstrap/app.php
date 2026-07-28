<?php

use App\Database\Connectors\PostgresConnector;
use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$basePath = dirname(__DIR__);

if (! is_writable($basePath.'/bootstrap/cache')) {
    $tmpBootstrap = '/tmp/bootstrap';
    $tmpCacheDir = $tmpBootstrap.'/cache';

    if (! is_dir($tmpCacheDir)) {
        mkdir($tmpCacheDir, 0755, true);
    }

    foreach (['packages.php', 'events.php'] as $file) {
        $src = $basePath.'/bootstrap/cache/'.$file;
        $dst = $tmpCacheDir.'/'.$file;
        if (file_exists($src) && ! file_exists($dst)) {
            copy($src, $dst);
        }
    }
}

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

if (isset($tmpBootstrap)) {
    $app->useBootstrapPath($tmpBootstrap);
}

$app->bind('db.connector.pgsql', fn () => new PostgresConnector);

// Redirect writable paths to /tmp when the filesystem is read-only
if (isset($tmpCacheDir) && ! is_dir('/tmp/storage/framework/views')) {
    mkdir('/tmp/storage/framework/views', 0755, true);
}

return $app;
