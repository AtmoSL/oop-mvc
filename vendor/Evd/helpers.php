<?php

function debug($value = null, $die = 1)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    if ($die) die;
}