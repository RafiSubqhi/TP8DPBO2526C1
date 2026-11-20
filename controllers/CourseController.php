<?php
include_once("config.php");
include_once("models/DB.php");
include_once("models/Course.php");
include_once("models/Lecturer.php");
include_once("views/CourseView.php");

class CourseController {
    private $course;
    private $lecturer;

    function __construct() {
        $this->course = new Course(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
        $this->lecturer = new Lecturer(Config::$db_host, Config::$db_user, Config::$db_pass, Config::$db_name);
    }

    public function index() {
        $this->course->open();
        $this->course->getCourse();

        $data = array('courses' => array());
        while ($row = $this->course->getResult()) {
            array_push($data['courses'], $row);
        }
        $this->course->close();

        $view = new CourseView();
        $view->render($data);
    }

    public function addForm() {
        $this->lecturer->open();
        $this->lecturer->getLecturer();
        $lecturers = array();
        while ($row = $this->lecturer->getResult()) {
            array_push($lecturers, $row);
        }
        $this->lecturer->close();

        $view = new CourseView();
        $view->renderForm($lecturers);
    }

    public function editForm($id) {
        $this->course->open();
        $this->course->getCourseById($id);
        $courseData = $this->course->getResult();
        $this->course->close();

        $this->lecturer->open();
        $this->lecturer->getLecturer();
        $lecturers = array();
        while ($row = $this->lecturer->getResult()) {
            array_push($lecturers, $row);
        }
        $this->lecturer->close();

        $view = new CourseView();
        $view->renderForm($lecturers, $courseData);
    }

    public function add($data) {
        $this->course->open();
        $this->course->add($data);
        $this->course->close();
        header("location:course.php");
        exit;
    }

    public function edit($data) {
        $this->course->open();
        $this->course->update($data);
        $this->course->close();
        header("location:course.php");
        exit;
    }

    public function delete($id) {
        $this->course->open();
        $this->course->delete($id);
        $this->course->close();
        header("location:course.php");
        exit;
    }
}
?>