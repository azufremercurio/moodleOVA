<?php

/**
 * Description of Test
 *
 * @author admin
 */
class Curso {

    public function index2Action() {
        return "hola curso";
    }
    public function indexAction($request) {
        global $DB;
        $record = new stdClass();
        $record->name = $request['msn'];
        $record->card = $request['id'];
//        $id = $DB->insert_record('xample', $record, true);
        $id = 1;

        return json_encode(['msn' => '__OK__', 'return' => 'acceso exitoso', 'rq' => $id]);
    }

}
