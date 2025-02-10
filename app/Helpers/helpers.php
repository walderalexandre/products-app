<?php

if (!function_exists('formatCurrency')) {
    /**
     * Formata um valor como moeda.
     *
     * @param  float  $value
     * @param  string  $currency
     * @return string
     */
    function formatCurrency($value, $currency = 'R$')
    {
        return $currency . ' ' . number_format($value, 2, ',', '.');
    }
}

if (!function_exists('formatDate')) {
    /**
     * Formata uma data.
     *
     * @param  string  $date
     * @param  string  $format
     * @return string
     */
    function formatDate($date, $format = 'd/m/Y H:i:s')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}
