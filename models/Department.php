<?php
class Department extends DB {
    function getDepartment() {
        $query = "SELECT * FROM departments";
        return $this->execute($query);
    }

    function getDepartmentById($id) {
        $id = (int)$id;
        $query = "SELECT * FROM departments WHERE id = $id";
        return $this->execute($query);
    }

    function add($data) {
        $name = $this->escape($data['department_name']);
        $faculty = $this->escape($data['faculty']);
        $query = "INSERT INTO departments (department_name, faculty) VALUES ('$name', '$faculty')";
        return $this->execute($query);
    }

    function update($data) {
        $id = (int)$data['id'];
        $name = $this->escape($data['department_name']);
        $faculty = $this->escape($data['faculty']);
        $query = "UPDATE departments SET department_name = '$name', faculty = '$faculty' WHERE id = $id";
        return $this->execute($query);
    }

    function delete($id) {
        $id = (int)$id;
        $query = "DELETE FROM departments WHERE id = $id";
        return $this->execute($query);
    }
}
?>