<?php

if(!function_exists('debug'))
{
    function debug($data, $exit = FALSE)
    {
        echo '<pre><strong>';
        print_r($data);
        echo '</strong></pre>';
        if ($exit == TRUE)
        {
            exit();
        }
    }
}