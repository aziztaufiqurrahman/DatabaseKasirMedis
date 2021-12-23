<?php

class Procurements
{
    public static function add($db, $id_employee)
    {
        $id_proc = 0;
        $sql = "CALL add_proc(:id_employee, :id_proc)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(":id_employee", $id_employee);
        $stmt->bindParam(":id_proc", $id_proc, PDO::PARAM_INT|PDO::PARAM_INPUT_OUTPUT, 38);
        $stmt->execute();

        return $id_proc;
    }
}
?>