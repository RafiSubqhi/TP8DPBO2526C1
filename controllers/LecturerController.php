<?php
include_once("config.php");
include_once("models/DB.php");
include_once("models/Lecturer.php");
include_once("models/Department.php");
include_once("views/LecturerView.php");

class LecturerController {
    private $lecturer;
    private $department;

    function __construct() {
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->department = new Department(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index() {
        $this->lecturer->open();
        $this->lecturer->getLecturer();

        $data = array('lecturers' => array());
        while ($row = $this->lecturer->getResult()) {
            array_push($data['lecturers'], $row);
        }
        $this->lecturer->close();

        $view = new LecturerView();
        $view->render($data);
    }

    public function addForm() {
        $this->department->open();
        $this->department->getDepartment();
        $departments = array();
        while ($row = $this->department->getResult()) {
            array_push($departments, $row);
        }
        $this->department->close();

        $view = new LecturerView();
        $view->renderForm($departments);
    }

    public function editForm($id) {
        $this->lecturer->open();
        $this->lecturer->getLecturerById($id);
        $lecturerData = $this->lecturer->getResult();
        $this->lecturer->close();

        $this->department->open();
        $this->department->getDepartment();
        $departments = array();
        while ($row = $this->department->getResult()) {
            array_push($departments, $row);
        }
        $this->department->close();

        $view = new LecturerView();
        $view->renderForm($departments, $lecturerData);
    }

    public function add($data) {
        $this->lecturer->open();
        $this->lecturer->add($data);
        $this->lecturer->close();
        header("location:index.php");
        exit;
    }

    public function edit($data) {
        $this->lecturer->open();
        $this->lecturer->update($data);
        $this->lecturer->close();
        header("location:index.php");
        exit;
    }

    public function delete($id) {
        $this->lecturer->open();
        $this->lecturer->delete($id);
        $this->lecturer->close();
        header("location:index.php");
        exit;
    }
}
?>