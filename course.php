<?php
include_once("views/Template.php");
include_once("models/DB.php");
include_once("controllers/CourseController.php");

$course = new CourseController();

if (isset($_POST['add'])) {
    $course->add($_POST);
} elseif (isset($_POST['edit'])) {
    $course->edit($_POST);
} elseif (!empty($_GET['add'])) {
    $course->addForm();
} elseif (!empty($_GET['id_edit'])) {
    $course->editForm($_GET['id_edit']);
} elseif (!empty($_GET['id_hapus'])) {
    $course->delete($_GET['id_hapus']);
} else {
    $course->index();
}
?>