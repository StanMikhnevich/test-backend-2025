<?php

if (!function_exists('clearPhone')) {
    function clearPhone($phone): string
    {
        return str_replace(['+', '-', ')', '(', ' '], '', $phone);
    }
}

if (!function_exists('formatPhone')) {
    function formatPhone($phone): string
    {
        $phone = clearPhone($phone);

        return '+' . substr($phone, 0, 3)
            . ' (' . substr($phone, 3, 2) . ') '
            . substr($phone, 5, 3) . ' '
            . substr($phone, 8, 2) . ' '
            . substr($phone, 10, 2);
    }
}
