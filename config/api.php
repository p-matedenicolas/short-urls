<?php

return [
    'latest_version' => env('API_LATEST_VERSION'),
    'supported_versions' => explode(',', env('API_SUPPORTED_VERSIONS')),
];
