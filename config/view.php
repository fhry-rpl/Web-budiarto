<?php

$compiledPath = is_writable(__DIR__.'/../storage/framework/views')
    ? __DIR__.'/../storage/framework/views'
    : '/tmp/storage/framework/views';

return [
    'compiled' => $compiledPath,
];
