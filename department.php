<?php
include_once("views/Template.php");
include_once("models/DB.php");
include_once("controllers/DepartmentController.php");

$department = new DepartmentController();

if (isset($_POST['add'])) {
    $department->add($_POST);
} elseif (isset($_POST['edit'])) {
    $department->edit($_POST);
} elseif (!empty($_GET['add'])) {
    $department->addForm();
} elseif (!empty($_GET['id_edit'])) {
    $department->editForm($_GET['id_edit']);
} elseif (!empty($_GET['id_hapus'])) {
    $department->delete($_GET['id_hapus']);
} else {
    $department->index();
}
?>