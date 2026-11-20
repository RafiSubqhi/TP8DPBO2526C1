<?php
class LecturerView {
    public function render($data) {
        $dataTabel = null;
        foreach ($data['lecturers'] as $val) {
            $dept = !empty($val['department_name']) ? $val['department_name'] : '-';
            $dataTabel .= "<tr>
                <td>{$val['id']}</td>
                <td>{$val['name']}</td>
                <td>{$val['nidn']}</td>
                <td>{$val['phone']}</td>
                <td>{$val['join_date']}</td>
                <td>{$dept}</td>
                <td>
                    <a class='btn btn-success btn-sm' href='index.php?id_edit={$val['id']}'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='index.php?id_hapus={$val['id']}' onclick='return confirm(\"Yakin hapus data ini?\")'>Delete</a>
                </td>
            </tr>";
        }

        $tpl = new Template("templates/lecturer.html");
        $tpl->replace("DATA_TABEL", $dataTabel);
        $tpl->write();
    }

    public function renderForm($departments, $lecturer = null) {
        $options = "";
        $selectedDept = $lecturer ? $lecturer['department_id'] : "";

        foreach ($departments as $dept) {
            $selected = ($dept['id'] == $selectedDept) ? "selected" : "";
            $options .= "<option value='{$dept['id']}' {$selected}>{$dept['department_name']} ({$dept['faculty']})</option>";
        }

        $tpl = new Template("templates/lecturer_form.html");
        if ($lecturer) {
            $tpl->replace("DATA_FORM_TITLE", "Update Lecturer");
            $tpl->replace("DATA_HEADER_BG", "bg-warning");
            $tpl->replace("DATA_ROW_ID", $lecturer['id']);
            $tpl->replace("DATA_LEC_NAME", $lecturer['name']);
            $tpl->replace("DATA_LEC_NIDN", $lecturer['nidn']);
            $tpl->replace("DATA_LEC_PHONE", $lecturer['phone']);
            $tpl->replace("DATA_LEC_JOIN", $lecturer['join_date']);
            $tpl->replace("DATA_BTN_NAME", "edit");
        } else {
            $tpl->replace("DATA_FORM_TITLE", "Create Lecturer");
            $tpl->replace("DATA_HEADER_BG", "bg-primary");
            $tpl->replace("DATA_BTN_NAME", "add");
        }
        $tpl->replace("DATA_OPTIONS", $options);
        $tpl->write();
    }
}
?>