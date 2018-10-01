<?php

use Qandidate\Stack\RequestId;
use Qandidate\Stack\UuidRequestIdGenerator;
use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__ .'/../vendor/autoload.php';

require __DIR__ . '/../app/AppKernel.php';

$debug       = true;
$environment = 'dev';

$kernel = new AppKernel($environment, $debug);

// Stack it!
$generator = new UuidRequestIdGenerator(42);
$requestId = new RequestId($kernel, $generator);

$kernel->loadClassCache();

$request = Request::createFromGlobals();
$response = $requestId->handle($request);
$response->send();
$kernel->terminate($request, $response);
