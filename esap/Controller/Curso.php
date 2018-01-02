<?php

use Spyc;

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
        $userEnrol = $this->db->get_record('user_enrolments', ['userid' => $this->user->id]);
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
        if (!isset($request['objName']) || empty($request['objName'])) {
            return json_encode(['msn' => '__KO__', 'return' => 'parametros incompletos']);
        }

        /* consultar el id del recurso mediante nombre */
        $resource = $this->getConceptResourceByName($request['objName']);

        if (empty($resource)) {
            return json_encode(['msn' => '__KO__', 'return' => 'el recurso no se encontro']);
        }

        $request['resourceId'] = $resource->id;

        if ($this->issetRegist($request)) {
            return json_encode(['msn' => '__OK__', 'return' => 'el registro ya existe']);
        }

        /* obtener el id del usuario para almacenarlo en la tabla de recursos vistos */
        $record = new stdClass();
        $record->user_enrolments_id = $this->enrolId;
        $record->concept_resource_id = $resource->id;
        $record->score = $resource->score;

        try {
            $id = $this->db->insert_record('esp_user_concept_resource', $record, true);
        } catch (Exception $exc) {
            return $exc->getMessage();
        }

        return json_encode(['msn' => '__OK__', 'return' => 'registro exitoso', 'data' => ['id' => $id]]);
    }

    /**
     * insterta un registro en la tabla Usersection 
     * esta recive como parametro el id de la seccion
     * @param array $request
     * @return json
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
        $date = date('Y-m-d H:i:s', $request['sectionId']);
        $concept = $this->db->get_record('esp_concept', ['timename' => $date]);

        /* validar que el concepto exista para evitar fraudes */
        if (empty($concept)) {
            return json_encode(['msn' => '__KO__', 'return' => 'la actividad no existe']);
        }

        $record = new stdClass();
        $record->user_enrolments_id = $this->enrolId;
        $record->course_sections_id = $concept->course_sections;

        $id = $this->db->insert_record('esp_user_section', $record, true);

        return json_encode(['msn' => '__OK__', 'return' => 'registro exitoso', 'data' => ['id' => $id]]);
    }

    private function issetRegist($request) {
        $regist = null;
        if (array_key_exists('sectionId', $request)) {
            /* obtener el concept mediante fecha unica y con esto consultar el user_concept_section */
            $date = date('Y-m-d H:i:s', $request['sectionId']);
            $concept = $this->db->get_record('esp_concept', ['timename' => $date]);
            $regist = $this->db->get_record('esp_user_section', [
                'course_sections_id' => $concept->course_sections,
                'user_enrolments_id' => $this->enrolId
            ]);

        } elseif (array_key_exists('resourceId', $request)) {
            $regist = $this->db->get_records('esp_user_concept_resource', [
                'concept_resource_id' => $request['resourceId'],
                'user_enrolments_id' => $this->enrolId
            ]);
        }

        if (empty($regist)) {
            return false;
        }
        return true;
    }

    /**
     * Obtener los datos necesarios para crear los botones y mostrar el OVA
     * @param array $request
     * @return json
     */
    public function getSectionsCoursesAction($request) {

        /* obtener el curso */
        $course = $this->db->get_record('course', ['id' => $request['idCourse']]);
        $urlCourse = $this->getYmlCourse($course->fullname);

        /* obtener los conceptos de las secciones y de ahi sacar el titulo de los botones */
        $sql = "SELECT ec.id, ec.description, ec.title, ec.course_sections, "
                . "UNIX_TIMESTAMP(ec.timename) AS timename, cs.id as sectionId, cs.section as sectionTheme "
                . "FROM {course_sections} as cs "
                . "JOIN {esp_concept} as ec on ec.course_sections = cs.id "
                . "WHERE cs.course = ?";
        $params = [$request['idCourse']];

        $concepts = $this->db->get_records_sql($sql, $params);

        /* obtener las secciones vistas por el usuario */
        $sql = "select us.course_sections_id as sectionId FROM {esp_user_section} as us "
                . "where us.user_enrolments_id = ?";
        $params = [$this->enrolId];
        $userSections = $this->db->get_records_sql($sql, $params);

        $arrShowed = [];
        foreach ($userSections as $data) {
            $arrShowed[] = $data->sectionid;
        }

        $arrActives = [];
        if (!empty($arrShowed)) {
            $showed = false;
            foreach ($concepts as $concept) {
                if (in_array($concept->sectionid, $arrShowed)) {
                    $arrActives[] = $concept->sectiontheme;
                    $showed = true;
                } elseif ($showed) {
                    $arrActives[] = $concept->sectiontheme;
                    break;
                }
            }
        }

        $response = [
            'path' => $urlCourse['path'],
            'sections' => $concepts,
            'activar' => $arrActives
        ];

        return json_encode($response);
    }

    private function getYmlCourse($nameCourse) {
        $nameAux = str_replace(' ', '', $nameCourse);
        $name = mb_strtolower($nameAux, 'UTF-8');
        $chars = ['á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u', 'ñ' => 'n'];
        $newName = strtr($name, $chars);
        $array = Spyc::YAMLLoad('Resources/config/courses.yml');

        return $array[$newName];
    }

    /**
     * obtener el concepto recurso por medio del nombre del ercurso
     * @param string $objName
     * @return stdClass
     */
    private function getConceptResourceByName($objName) {
        $sql = "SELECT cr.id, cr.concept_id, cr.resource_id, r.score "
                . "FROM {esp_concept_resource} AS cr "
                . "JOIN {esp_resource} AS r ON r.id = cr.resource_id "
                . "WHERE r.name = ?";
        $param = [$objName];

        $resource = $this->db->get_record_sql($sql, $param);
        return $resource;
    }

}
