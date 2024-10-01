<?php
class Usuario_models extends CI_Model
{
    public function get_by_id($id)
    {
        $this->db->select("usuarios.*,roles.nombre AS rol");
        $this->db->join("roles", "roles.rol_id=usuarios.rol_id", "inner");
        $this->db->from("usuarios");
        $this->db->where("usuario_id", $id);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function check_login($usuarios, $password)
    {
        $this->db->select("usuario_id");
        $this->db->where("usuario", $usuarios);
        $this->db->where("password", md5($password));
        $query = $this->db->get("usuarios");
        if ($query->num_rows() > 0) {
            $tmp = $query->row_array();
            return $tmp["usuario_id"];
        } else {
            return false;
        }
    }
    public function actualizar_password($usuario_id, $new_password)
    {
        $hashed_password = md5($new_password);
        $this->db->where('usuario_id', $usuario_id);
        $this->db->set('password', $hashed_password);
        $this->db->update('usuarios');
        return $this->db->affected_rows(); // Devuelve el número de filas afectadas
    }
    public function listar (){
        $this->db->select("usuario_id,usuario,rol_id,estado");
        $this->db->from("usuarios");
        return $this->db->get()->result_array();
    }
    public function listar_roles (){
        $this->db->select("rol_id,nombre");
        $this->db->from("roles");
        return $this->db->get()->result_array();
    }
    public function nuevo($usuario, $password, $rol)
        {
            $hashed_password = md5($password);
            //lo guardamos en la base de datos 
            $this->db->set('usuario', $usuario);
            $this->db->set('password', $hashed_password); 
            $this->db->set('rol_id', $rol); 
            $this->db->insert('usuarios');
            
            return $this->db->insert_id(); //devuelve que inserto la ultima consulta
        }

    public function borrar($id = 0)
    {
        $id = intval($id);
        $this->db->where('usuario_id', $id);
        $this->db->set('estado', 0);
        $this->db->update('usuarios');
        return $this->db->affected_rows();
    }

    public function activar($id = 0)
    {
        $id = intval($id);
        $this->db->where('usuario_id', $id);
        $this->db->set('estado', 1);
        $this->db->update('usuarios');
        return $this->db->affected_rows();
    }

}


?>