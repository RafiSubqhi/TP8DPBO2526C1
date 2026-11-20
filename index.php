<?php
include_once("views/Template.php");
include_once("models/DB.php");
include_once("controllers/LecturerController.php");

$lecturer = new LecturerController();

if (isset($_POST['add'])) {
    $lecturer->add($_POST);
} elseif (isset($_POST['edit'])) {
    $lecturer->edit($_POST);
} elseif (!empty($_GET['add'])) {
    $lecturer->addForm();
} elseif (!empty($_GET['id_edit'])) {
    $lecturer->editForm($_GET['id_edit']);
} elseif (!empty($_GET['id_hapus'])) {
    $lecturer->delete($_GET['id_hapus']);
} else {
    $lecturer->index();
}
?>