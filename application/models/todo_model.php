<?php
    class Todo_model extends CI_Model {
        private $usuario_id = null;

        public function set_usuario_id($valor){
            $this->usuario_id = $valor;
        }
        public function listar(){
            $this->db->select('pendientes.*, DATE_FORMAT(fecha, "%d/%m/%Y %H:%i") AS fecha_humano', FALSE);
            $this->db->from('pendientes');
            if($this->usuario_id != null){
                $this->db->where('usuario_id',$this->usuario_id);
            }
            $this->db->order_by('pendiente_id','DESC');
            return $this->db->get()->result_array();
        }
        public function nuevo($texto="", $usuario_id=0)
        {
            //lo guardamos en la base de datos 
            $this->db->set('texto', $texto);
            $this->db->set('usuario_id', $usuario_id); 
            $this->db->insert('pendientes');
            
            return $this->db->insert_id(); //devuelve que inserto la ultima consulta
        }
        
        public function borrar($id = 0)
        {
            $id = intval($id);
            $this->db->where('pendiente_id', $id);
            $this->db->delete('pendientes');
          
            return $this->db->affected_rows(); //devuelve cuantas filas fueron afectadas por la consulta
        }
    
        public function marcar($id = 0)
        {
            $id = intval($id);
            $this->db->where('pendiente_id', $id);
            $this->db->set('estado', 1);
            $this->db->update('pendientes');
            $this->session->set_flashdata('OP', 'LISTO');
    
            redirect('todo/principal');
        }
    }


?>