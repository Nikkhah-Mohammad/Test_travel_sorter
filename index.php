<?php


require_once __DIR__ . '/vendor/autoload.php';

use src\Trip;

include_once('cards.php');
$trip = new Trip($boardingCollection);

$trip->sort();

$trip->tripString();
