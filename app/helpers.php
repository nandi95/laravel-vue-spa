<?php

if (!function_exists('snake_array_keys')) {
    /**
     * Convert array keys to snake_case
     *
     * @param array $data
     * @param bool  $recursive
     * @param bool  $reverse   convert from snake to camel
     *
     * @return array
     */
    function snake_array_keys(array $data, $recursive = true, $reverse = false)
    {
        $mapFunction = $reverse === false ? 'snake_case' : 'camel_case';

        $newKeys = array_map($mapFunction, array_keys($data));
        $data    = array_combine($newKeys, array_values($data));

        // If we are running recursively we'll map over each
        // sub array and run it through this function.
        if ($recursive === true) {
            $data = array_map(
                function ($data) use ($reverse) {
                    return !is_array($data) ? $data : snake_array_keys($data, true, $reverse);
                },
                $data
            );
        }

        return $data;
    }
}


if (!function_exists('camel_array_keys')) {
    /**
     * Convert array keys to camel case
     *
     * @param array $data
     * @param bool  $recursive
     *
     * @return array
     */
    function camel_array_keys(array $data, $recursive = true)
    {
        return snake_array_keys($data, $recursive, true);
    }
}

if (!function_exists('camel_case')) {
    /**
     * Convert array keys to camel case
     *
     * @param string $data
     *
     * @return string
     */
    function camel_case(string $data)
    {
        return \Illuminate\Support\Str::camel($data);
    }
}

if (!function_exists('snake_case')) {
    /**
     * Convert array keys to camel case
     *
     * @param string $data
     *
     * @return string
     */
    function snake_case(string $data)
    {
        return \Illuminate\Support\Str::snake($data);
    }
}

if (!function_exists('generate_password')) {
    /**
     * https://stackoverflow.com/a/6101976
     * Only used for automated testing.
     *
     * @param int $length
     *
     * @return string
     *
     * @throws Exception
     */
    function generate_password($length = 20)
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|"\'';
        $str   = '';
        $max   = strlen($chars) - 1;

        for ($i=0; $i < $length; $i++)
            $str .= $chars[random_int(0, $max)];

        return $str;
    }
}
