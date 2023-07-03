<?php

function env($key)
{
    $mappedEnvFileData = [];
    $envFile = file_get_contents('.env');
    $envFile = array_filter(explode(PHP_EOL, $envFile));
    array_map(function ($row) use (&$mappedEnvFileData) {
        $segments = explode('=', $row);
        $mappedEnvFileData[$segments[0]] = $segments[1];
    }, $envFile);

    if (isset($mappedEnvFileData[$key])) {
        switch ($mappedEnvFileData[$key]) {
            case 'true':
            case '(true)':
                return true;

            case 'false':
            case '(false)':
                return false;

            case 'empty':
            case '(empty)':
                return '';

            case 'null':
            case '(null)':
                return;
        }

        return $mappedEnvFileData[$key];
    }

    return;
}
