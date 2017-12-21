<?php

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
        return "hola curso";
    }

    public function indexAction($request) {
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
        /* validacion de parametros */
        if(!isset($request['resourceId']) || empty($request['resourceId'])) {
            return json_encode(['msn' => '__KO__', 'return' => 'parametros incompletos']);
        }

        /* obtener el id del usuario para almacenarlo en la tabla de recursos vistos */
        $record = new stdClass();
        $enrol = $this->getUserEnrolment();
        $record->user_enrolments_id = $enrol->id;
        $record->resource_id = $request['resourceId'];
        $id = $this->db->insert_record('esp_user_concept_resource', $record, true);

        return json_encode(['msn' => '__OK__', 'return' => 'registro exitoso', 'data' => ['id' => $id]]);
    }

    /**
     * getUserEnrolment obtener el enroll del usuario para almacenarlo en las tablas relacionadas
     * @return stdClass tipo userEnrollment
     */
    private function getUserEnrolment() {
        $userEnrol = $this->db->get_records('user_enrolments', ['userid' => $this->user->id]);
        return $userEnrol;
    }

    /**
     * insterta un registro en la tabla Usersection 
     * esta recive como parametro el id de la seccion
     * @param type $request
     * @return type
     */
    public function setUserSectionAction($request) {
        /* preguntar si section id esta vacion */
        if (!isset($request['sectionId']) || empty($request['sectionId'])) {
            return json_encode(['msn' => '__KO__', 'return' => 'error los parametros estan incompletos']);
        }

        /* obtener el id del usuario para almacenarlo en la tabla de recursos vistos */
        $record = new stdClass();
        $userEnrol=$this->getUserEnrolment();
        $record->user_enrolments_id = $userEnrol->id;
        $record->resource_id = $request['sectionId'];
        $id = $this->db->insert_record('esp_user_section', $record, true);
        
        return json_encode(['msn' => '__OK__', 'return' => 'registro exitoso', 'data' => ['id' => $id]]);
    }

}
