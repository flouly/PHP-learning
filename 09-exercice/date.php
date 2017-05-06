<?php

/* 1 Creer une foncyion qui retourne la conversion d une date US ou inversement. cette fonction prend 2 parametres une date valide et le faormat de convertiopn "us" ou "fr"

2 pour valider que le parametre de format est bien  "us" ou "fr" la fonction retorne un message si ce nest pas le cas
*/

function convert($date, $format) {
        if ($format == 'FR'){
            return   strftime('%d-%m-%Y', strtotime($date));
        } elseif($format == 'US') {

            return   strftime('%Y-%m-%d',strtotime($date));
        } else {
            return  'Pas le bon formmat';
        }

}

echo convert('2017-05-18', 'FR');
echo '<br>';
echo convert('13-06-1998', 'US');


function afficheDate($date, $format) {
    //version avec objet date
    $objetDate = new DateTime($date);
    
    if ($format == 'FR'){
        return $objetDate->format('d-m-Y');
    } elseif ($format == 'US'){
        return $objetDate->format('Y-m-d');
    } else {
            return  'Pas le bon formmat';
        }
}