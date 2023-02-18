<?php

namespace Tests;

abstract class ApiBaseTestCase extends TestCase
{
    protected const TEST_ROUTE = '/api/v1/short-urls';

    protected const TEST_URL = 'https://google.es';

    protected const RESPONSE_INVALID_TOKEN = [
        'message' => 'No valid token'
    ];

    protected const RESPONSE_VALID_JSON_STRUCTURE = [
        'url'
    ];

    protected const RESPONSE_INVALID_JSON_STRUCTURE = [
        'message'
    ];

    protected const VALID_TOKEN = '()';

    protected const INVALID_TOKEN = '(';

}
