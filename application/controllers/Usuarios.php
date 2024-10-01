<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('usuario_id') or $this->session->userdata('rol_id') != 1) {
            $this->session->set_flashdata("OP", "PROHIBIDO");
            redirect('auth/login');
        }
        $this->load->model('usuario_models');
    }

    public function index()// La funcion index tiene que estar en todos los controllers
    {
        redirect('usuarios/principal'); //cuando entra a este metodo redirecciona a todo principal. No hay q poner cosas en el index, cambiamos el redirect
    }


    public function principal()
    {
        $datos = array();
        $datos['usuarios'] = $this->usuario_models->listar();
        $datos['roles'] = $this->usuario_models->listar_roles();
        $this->load->view('usuarios', $datos); //carga la vista principal y le pasa el array de datos
    }
    public function perfil()
    {
        $usuario_id = $this->session->userdata('usuario_id'); //USUARIO ACTUAL
        $data['usuario'] = $this->usuario_models->get_by_id($this->session->userdata('usuario_id'));
        // Verificar si se envió el formulario de cambio de contraseña
        if ($this->input->post()) {
            $password = $this->input->post('password');
            $password2 = $this->input->post('password2');

            // Verificar que las contraseñas coincidan
            if ($password === $password2) {
                
                // Actualizar la contraseña en la base de datos
                $this->usuario_models->actualizar_password($usuario_id, $password);
                $this->session->set_flashdata('OP', 'Contraseña actualizada con éxito.');
                redirect('usuarios/perfil'); // Redirigir de nuevo a la vista de perfil
            } else {
                $this->session->set_flashdata('error', 'Las contraseñas no coinciden.');
            }
        }
        // Cargar la vista
        $this->load->view('perfil', $data);
    }

    public function nuevo()
    {
        $usuario = $this->input->post('usuario');
        $password = $this->input->post('password');
        $rol = $this->input->post('rol');
        $this->usuario_models->nuevo($usuario, $password, $rol);
        $this->session->set_flashdata('OP', 'OK');
        redirect('usuarios/principal');
    }

    public function borrar($id = 0)
    {

        $this->usuario_models->borrar($id);

        $this->session->set_flashdata('OP', 'BORRADO');

        redirect('usuarios/principal');
    }

    public function activar($id)
	{
		$this->usuario_models->activar($id);
		redirect('usuarios/principal');
	}
}