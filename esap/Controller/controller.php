<?php

require_once '../config.php';

function insertRegister() {
    $record = new stdClass();
    $record->name = "Hector hernandez";
    $record->card = "1022334123";
    $id = $DB->insert_record('xample', $record, true);
    var_dump($id);
    die();
}

function getRegister() {
    global $DB;
    $id = $DB->get_records('xample', []);
    print_r($id);
    die;
}