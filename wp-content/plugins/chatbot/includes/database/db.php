<?php

class Chatbot_DB {
  private $db_host = 'localhost';
  private $db_user = 'root';
  private $db_pass = '26101989';
  private $db_name = 'chatbot_gpt';

  private $conn;

  public function __construct() {
    $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

    if ($this->conn->connect_error) {
      die("Conexión fallida: " . $this->conn->connect_error);
    }
  }

  public function insert_user($user_data) {
    $nombre = $user_data['nombre'];
    $correo_electronico = $user_data['correo_electronico'];
    $contraseña = $user_data['contraseña'];
    $fecha_creacion = $user_data['fecha_creacion'];
    $configuracion_chatbot = json_encode($user_data['configuracion_chatbot']);

    $sql = "INSERT INTO usuarios (nombre, correo_electronico, contraseña, fecha_creacion, configuracion_chatbot)
            VALUES ('$nombre', '$correo_electronico', '$contraseña', '$fecha_creacion', '$configuracion_chatbot')";

    if ($this->conn->query($sql) === TRUE) {
      return $this->conn->insert_id;
    } else {
      echo "Error: " . $sql . "<br>" . $this->conn->error;
      return -1;
    }
  }

  public function get_user_by_id($user_id) {
    $sql = "SELECT * FROM usuarios WHERE id = '$user_id'";
    $result = $this->conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $row['configuracion_chatbot'] = json_decode($row['configuracion_chatbot'], true);
      return $row;
    } else {
      return null;
    }
  }
}

?>
