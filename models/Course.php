<?php
class Course extends DB {
    function getCourse() {
        $query = "SELECT courses.*, lecturers.name AS lecturer_name 
                  FROM courses 
                  LEFT JOIN lecturers ON courses.lecturer_id = lecturers.id";
        return $this->execute($query);
    }

    function getCourseById($id) {
        $id = (int)$id;
        $query = "SELECT * FROM courses WHERE id = $id";
        return $this->execute($query);
    }

    function add($data) {
        $code = $this->escape($data['course_code']);
        $name = $this->escape($data['course_name']);
        $sks = (int)$data['sks'];
        $lecturer_id = !empty($data['lecturer_id']) ? (int)$data['lecturer_id'] : "NULL";

        $query = "INSERT INTO courses (course_code, course_name, sks, lecturer_id) 
                  VALUES ('$code', '$name', $sks, $lecturer_id)";
        return $this->execute($query);
    }

    function update($data) {
        $id = (int)$data['id'];
        $code = $this->escape($data['course_code']);
        $name = $this->escape($data['course_name']);
        $sks = (int)$data['sks'];
        $lecturer_id = !empty($data['lecturer_id']) ? (int)$data['lecturer_id'] : "NULL";

        $query = "UPDATE courses 
                  SET course_code = '$code', course_name = '$name', sks = $sks, lecturer_id = $lecturer_id 
                  WHERE id = $id";
        return $this->execute($query);
    }

    function delete($id) {
        $id = (int)$id;
        $query = "DELETE FROM courses WHERE id = $id";
        return $this->execute($query);
    }
}
?>