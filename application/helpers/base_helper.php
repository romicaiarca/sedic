<?php

if (!function_exists('css_path'))
{
    function css_path($path = '')
    {
        return site_url('assets/css/' . $path);
    }
}

if (!function_exists('js_path'))
{
    function js_path($path = '')
    {
        return site_url('assets/js/' . $path);
    }
}

if (!function_exists('image_path'))
{
    function image_path($path = '')
    {
        return site_url('assets/images/' . $path);
    }
}

if (!function_exists('prepare_result'))
{
    function prepare_result($sparql_obj, $field)
    {
        $return = array();
        while ( $row = $sparql_obj->fetch_array() )
        {
            $value = substr((string)$row[$field], strlen('http://www.semanticweb.org/sedic#'));
            $return[strtolower($value)] = str_replace('_', ' ', $value);
        }
        return $return;
    }
}
