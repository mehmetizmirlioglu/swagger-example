<?php
$openapi = \OpenApi\Generator::scan(['./example']);
header('Content-Type: text/x-yaml');
echo $openapi->toYaml();