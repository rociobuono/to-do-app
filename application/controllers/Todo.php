<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Todo extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct(); //llama al constructor padre para tener todas las herr. es necesario
		if(!$this->session->userdata('usuario_id')){
			$this->session->set_flashdata("OP", "PROHIBIDO");
			redirect('auth/login');
		}
        //Cargo el modelo para que esté disponible en todos los métodos
        $this->load->model('todo_model');
	}

	public function index()// La funcion index tiene que estar en todos los controllers
	{
		redirect('todo/principal'); //cuando entra a este metodo redirecciona a todo principal. No hay q poner cosas en el index, cambiamos el redirect
	}
    
	public function principal()
    {
            //array de transporte, pasar info a la vista
            $datos = array();

            $this->todo_model->set_usuario_id($this->session->userdata('usuario_id'));
            $datos['pendientes'] = $this->todo_model->listar(); 

            //$this->db->select('pendientes.*, usuarios.usuario'); // todos los campos de pendientes y el nombre de usuario
            //$this->db->from('pendientes');
            //$this->db->join('usuarios', 'usuarios.usuario_id = pendientes.usuario_id', 'left'); // JOIN con la tabla usuarios
            $this->load->view('todo/principal', $datos); //carga la vista principal y le pasa el array de datos
    }
    
    public function nuevo()
    {
        $texto = $this->input->post('texto'); //devuelve lo q hay en el canal post, si no hay nda devuelve falso
        $usuario_id = $this->session->userdata('usuario_id'); //id del usuario que inicia sesion
        $this->todo_model->nuevo($texto, $usuario_id);
        $this->session->set_flashdata('OP', 'OK');
        redirect('todo/principal');
    }
    
    public function borrar($id = 0)
    {
        $id = intval($id);
        $this->db->where('pendiente_id', $id);
        $this->db->delete('pendientes');
        $this->session->set_flashdata('OP', 'BORRADO');

        redirect('todo/principal');
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
