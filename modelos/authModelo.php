<?php
class authModelo
{
    public $db;

    public function __construct()
    {
        require("config.php");

        $this->db = new mysqli($host, $user, $pass, $db);
        mysqli_set_charset($this->db, 'utf8');
    }

    public function getUserByUsername($nom_usu)
    {
        // Consulta la base de datos para obtener un usuario por correo electrónico
        $sql = "SELECT * FROM login WHERE nom_usu = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $nom_usu);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();

        return $usuario;
    }
}

?>