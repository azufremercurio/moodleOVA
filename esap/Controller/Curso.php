<?php

/**
 * Description of Test
 *
 * @author admin
 */
class Curso {

    /**
     * objeto de la base de datos
     * @var object
     */
    private $db;
    /**
     * entidad del usuario logeado
     * @var array
     */
    private $user;
    /**
     * primary key del user_enroll
     * @var integer
     */
    private $enrolId;

    public function __construct() {
        global $DB;
        global $USER;
        $this->db = $DB;
        $this->user = $USER;
        $this->enrolId = 0;

        /* obtener el enrol del usuario logeado */
        $enrol = $this->getUserEnrolment();
        if (!empty($enrol)) {
            $this->enrolId = $enrol->id;
        }
    }

    /**
     * getUserEnrolment obtener el enroll del usuario para almacenarlo en las tablas relacionadas
     * @return stdClass tipo userEnrollment
     */
    private function getUserEnrolment() {
        $userEnrol = $this->db->get_records('user_enrolments', ['userid' => $this->user->id]);
        return $userEnrol;
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
        if (!isset($request['resourceId']) || empty($request['resourceId'])) {
            return json_encode(['msn' => '__KO__', 'return' => 'parametros incompletos']);
        }

        if ($this->issetRegist($request)) {
            return json_encode(['msn' => '__OK__', 'return' => 'el registro ya existe']);
        }
        /* obtener el id del usuario para almacenarlo en la tabla de recursos vistos */
        $record = new stdClass();

        $record->user_enrolments_id = $this->enrolId;
        $record->concept_resource_id = $request['resourceId'];
        $id = $this->db->insert_record('esp_user_concept_resource', $record, true);

        return json_encode(['msn' => '__OK__', 'return' => 'registro exitoso', 'data' => ['id' => $id]]);
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

        if ($this->issetRegist($request)) {
            return json_encode(['msn' => '__OK__', 'return' => 'el registro ya existe']);
        }

        /* obtener el id del usuario para almacenarlo en la tabla de recursos vistos */
        $record = new stdClass();

        $record->user_enrolments_id = $this->enrolId;
        $record->course_sections_id = $request['sectionId'];
        $id = $this->db->insert_record('esp_user_section', $record, true);

        return json_encode(['msn' => '__OK__', 'return' => 'registro exitoso', 'data' => ['id' => $id]]);
    }

    private function issetRegist($request) {
        $regist = null;
        if (array_key_exists('sectionId', $request)) {
            $regist = $this->db->get_records('esp_user_section', [
                'course_sections_id' => $request['sectionId'],
                'user_enrolments_id' => $this->enrolId
            ]);
        } elseif (array_key_exists('resourceId', $request)) {
            $regist = $this->db->get_records('esp_user_concept_resource', ['concept_resource_id' => $request['resourceId'],
                'user_enrolments_id' => $this->enrolId
            ]);
        }

        if (!empty($regist)) {
            return true;
        }
        return false;
    }

}
