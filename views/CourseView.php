<?php
class CourseView {
    public function render($data) {
        $dataTabel = null;
        foreach ($data['courses'] as $val) {
            $lecturer = !empty($val['lecturer_name']) ? $val['lecturer_name'] : '-';
            $dataTabel .= "<tr>
                <td>{$val['id']}</td>
                <td>{$val['course_code']}</td>
                <td>{$val['course_name']}</td>
                <td>{$val['sks']}</td>
                <td>{$lecturer}</td>
                <td>
                    <a class='btn btn-success btn-sm' href='course.php?id_edit={$val['id']}'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='course.php?id_hapus={$val['id']}' onclick='return confirm(\"Yakin hapus mata kuliah ini?\")'>Delete</a>
                </td>
            </tr>";
        }

        $tpl = new Template("templates/course.html");
        $tpl->replace("DATA_TABEL", $dataTabel);
        $tpl->write();
    }

    public function renderForm($lecturers, $course = null) {
        $options = "";
        $selectedLec = $course ? $course['lecturer_id'] : "";

        foreach ($lecturers as $lec) {
            $selected = ($lec['id'] == $selectedLec) ? "selected" : "";
            $options .= "<option value='{$lec['id']}' {$selected}>{$lec['name']} ({$lec['nidn']})</option>";
        }

        $tpl = new Template("templates/course_form.html");
        if ($course) {
            $tpl->replace("DATA_FORM_TITLE", "Update Course");
            $tpl->replace("DATA_HEADER_BG", "bg-warning");
            $tpl->replace("DATA_ROW_ID", $course['id']);
            $tpl->replace("DATA_CRS_CODE", $course['course_code']);
            $tpl->replace("DATA_CRS_NAME", $course['course_name']);
            $tpl->replace("DATA_CRS_SKS", $course['sks']);
            $tpl->replace("DATA_BTN_NAME", "edit");
        } else {
            $tpl->replace("DATA_FORM_TITLE", "Create Course");
            $tpl->replace("DATA_HEADER_BG", "bg-primary");
            $tpl->replace("DATA_BTN_NAME", "add");
        }
        $tpl->replace("DATA_OPTIONS", $options);
        $tpl->write();
    }
}
?>