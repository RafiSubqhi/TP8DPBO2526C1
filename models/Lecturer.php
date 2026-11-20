<?php
class Lecturer extends DB {
    function getLecturer() {
        $query = "SELECT lecturers.*, departments.department_name 
                  FROM lecturers 
                  LEFT JOIN departments ON lecturers.department_id = departments.id";
        return $this->execute($query);
    }

    function getLecturerById($id) {
        $id = (int)$id;
        $query = "SELECT * FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }

    function add($data) {
        $name = $this->escape($data['name']);
        $nidn = $this->escape($data['nidn']);
        $phone = $this->escape($data['phone']);
        $join_date = $this->escape($data['join_date']);
        $dept_id = !empty($data['department_id']) ? (int)$data['department_id'] : "NULL";

        $query = "INSERT INTO lecturers (name, nidn, phone, join_date, department_id) 
                  VALUES ('$name', '$nidn', '$phone', '$join_date', $dept_id)";
        return $this->execute($query);
    }

    function update($data) {
        $id = (int)$data['id'];
        $name = $this->escape($data['name']);
        $nidn = $this->escape($data['nidn']);
        $phone = $this->escape($data['phone']);
        $join_date = $this->escape($data['join_date']);
        $dept_id = !empty($data['department_id']) ? (int)$data['department_id'] : "NULL";

        $query = "UPDATE lecturers 
                  SET name = '$name', nidn = '$nidn', phone = '$phone', join_date = '$join_date', department_id = $dept_id 
                  WHERE id = $id";
        return $this->execute($query);
    }

    function delete($id) {
        $id = (int)$id;
        $query = "DELETE FROM lecturers WHERE id = $id";
        return $this->execute($query);
    }
}
?>