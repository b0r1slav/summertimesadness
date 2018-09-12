<?php

if (! function_exists('filter_array')) {
    /**
    * Filters elements of an array using a callback function
    *
    * @param  array  $resource
    * @return array
    */

    function filter_array($resource)
    {
        return array_filter($resource, function($value) {
            return ($value !== null && $value !== false && $value !== '');
        });
    }
}