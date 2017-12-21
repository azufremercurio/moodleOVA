<?php

use DateTime as xxx;

/**
 * Description of Test
 *
 * @author admin
 */
class Curso {

    private $db;
    private $user;

    public function __construct() {
        global $DB;
        global $USER;
        $this->db = $DB;
        $this->user = $USER;
    }

    public function defaultAction() {
        print_r(new xxx('now'));die;
        
        $this->getUserEnrolment();
        return "hola curso";
    }

    public function indexAction($request) {
        $record = new stdClass();
        $record->name = $request['msn'];
        $record->card = $request['id'];
//        $id = $this->db->insert_record('xample', $record, true);
        $id = 1;

        return json_encode(['msn' => '__OK__', 'return' => 'acceso exitoso', 'rq' => $id]);
    }

    /**
     * setUserResource almacenar un recurso visto por el usuario
     * @global ObjetoMoodle $DB
     * @param Array $request parametros a ingresar en la base de datos
     * @return json
     */
    public function setUserResourceAction($request) {

        $record = new stdClass();
        /* obtener el id del usuario para almacenarlo en la tabla de recursos vistos */
        $record->user_enrolments_id = $this->user->id;
        $record->resource_id = $request['videoId'];
        $id = $this->db->insert_record('esp_user_concept_resource', $record, true);

        return json_encode(['msn' => '__OK__', 'return' => 'registro exitoso', 'data' => ['id' => $id]]);
    }

    public function getUserEnrolment() {
        $userEnrol = $this->db->get_records('user_enrolments', ['userid' => $this->user->id]);
        return $userEnrol;
    }
    
}
