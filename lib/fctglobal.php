<?php

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

function dateTimeUs2Fr($date) {
    $dateBegin = substr($date,0,10);
    $time = substr($date,11,19);
    list($annee, $mois, $jour) = explode('-', $dateBegin);
    list($heure, $min, $sec) = explode(':', $time);

    return ('Le '.$jour . '/' . $mois . '/' . $annee . '<br /> à ' . $heure . ':' . $min . ':' . $sec);
}