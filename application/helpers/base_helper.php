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