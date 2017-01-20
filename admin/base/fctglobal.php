<?php

function ifsetor(&$val, $default = null){
    return isset($val) ? $val : $default;
}
/**
 * Format date.
 * @param $date date à reformater
 * @return string date formatée aaaa-mm-jj
 */
function dateFr2Us($date) {
    list($jour, $mois, $annee) = explode('/', $date);
    return ($annee . '-' . $mois . '-' . $jour);
}

/**
 * Format date.
 * @param $dat date à reformater
 * @return string date formatée jj-mm-aaaa
 */
function dateUs2Fr($date) {
    list($annee, $mois, $jour) = explode('-', $date);
    return ($jour . '/' . $mois . '/' . $annee);
}

function dateTimeUs2Fr($datetime) {
    $datetime = substr($datetime,0,10);
    list($annee, $mois, $jour) = explode('-', $datetime);
    return ($jour . '/' . $mois . '/' . $annee);
}