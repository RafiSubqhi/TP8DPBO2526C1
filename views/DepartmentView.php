<?php
class DepartmentView {
    public function render($data) {
        $dataTabel = null;
        foreach ($data['departments'] as $val) {
            $dataTabel .= "<tr>
                <td>{$val['id']}</td>
                <td>{$val['department_name']}</td>
                <td>{$val['faculty']}</td>
                <td>
                    <a class='btn btn-success btn-sm' href='department.php?id_edit={$val['id']}'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='department.php?id_hapus={$val['id']}' onclick='return confirm(\"Yakin hapus departemen ini?\")'>Delete</a>
                </td>
            </tr>";
        }

        $tpl = new Template("templates/department.html");
        $tpl->replace("DATA_TABEL", $dataTabel);
        $tpl->write();
    }

    public function renderForm($department = null) {
        $tpl = new Template("templates/department_form.html");
        if ($department) {
            $tpl->replace("DATA_FORM_TITLE", "Update Department");
            $tpl->replace("DATA_HEADER_BG", "bg-warning");
            $tpl->replace("DATA_ROW_ID", $department['id']);
            $tpl->replace("DATA_DEPT_NAME", $department['department_name']);
            $tpl->replace("DATA_DEPT_FACULTY", $department['faculty']);
            $tpl->replace("DATA_BTN_NAME", "edit");
        } else {
            $tpl->replace("DATA_FORM_TITLE", "Create Department");
            $tpl->replace("DATA_HEADER_BG", "bg-primary");
            $tpl->replace("DATA_BTN_NAME", "add");
        }
        $tpl->write();
    }
}
?>