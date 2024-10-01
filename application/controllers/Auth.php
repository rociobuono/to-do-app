<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // La funcion index tiene que estar en todos los controllers
    public function index()
    {
        redirect('auth/login');
    }
    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('usuario','Usuario', 'trim|strtolower|required');//primero nombre real, luego como el usuario lo ve,
        $this->form_validation->set_rules('password','Contraseña','required');
        if( $this->form_validation->run() == FALSE ){ //run va a devolver true si pasaron las reglas o falso si no pasaron
            $this->load->view('login');
        }else{
            $this->load->model('usuario_models');
            $usuario = set_value("usuario");
            $password = set_value("password");
            if( $uid = $this->usuario_models->check_login($usuario, $password) ){
                $u=$this->usuario_models->get_by_id($uid);
                if( $u["estado"] == 1){
                    $this->session->set_userdata("usuario_id",$uid);
                    $this->session->set_userdata("usuario", $u["usuario"]);
                    $this->session->set_userdata("rol_id", $u["rol_id"]);
                    redirect('todo');
                }else{
                    $this->session->set_flashdata("OP", "INACTIVO");
                    redirect('auth/login');
                }
            }else{
                $this->session->set_flashdata("OP", "INCORRECTO");
                redirect('auth/login');
            }
        }
    }
    public function logout(){   
        $this->session->sess_destroy();
        $this->session->set_flashdata("OP", "SALIO");
        redirect('auth/login');
    }
}
