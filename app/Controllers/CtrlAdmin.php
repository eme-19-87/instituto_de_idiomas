<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class CtrlAdmin extends BaseController{

	private $usuarios;
   
    private function setUsuariosModel($modelo){
        $this->usuarios=$modelo;
    }


    //Definimos los getters
    private function getUsuariosModel(){
        return $this->usuarios;
    }

    public function __construct(){
        helper('form','url');
        $this->setUsuariosModel(new UsuariosModel());
    }


	public function index ()
        {
    
            $data['titulo']='Administración';
            $eleccion['resaltar']="Usuarios";
            $usuarios['usuarios']=$this->getUsuariosModel()->getUsuarios();
            echo view('front/head_view',$data);
            echo view('back/usuarios/navbar_view_admin',$eleccion);
            echo view('back/usuarios/admin_view',$usuarios);
            echo view('front/footer_view');
        }

   public function cambiarEstado($id,$estado){
        
        $this->getUsuariosModel()->cambiarEstadoUsuario((int)$id,(int)$estado);
        return redirect()->to(base_url("admin/inicio"));
   }

}


        