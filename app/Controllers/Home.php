<?php

namespace App\Controllers;

class Home extends BaseController
{
    /*Siempre debe controlarse si hay una sesión iniciada. Si la hay, debemos cargar en las vistas el modal
    para el cierre de sesión. Esto sólo en las vistas que se verán cuando se tenga una sesión iniciada.*/
    public function index()
    {
        try {
                $data['titulo']='Instituto de Idiomas';
                $eleccion['resaltar']="Home";
                echo view('front/head_view',$data);
                echo view('front/navbar_view',$eleccion);
                echo view('front/principal');
                if(session()->id_usuario!=null){
                   echo view('front/modal_cierre_sesion'); 
                };
                echo view('front/footer_view');
            
        } catch (Exception $e) {

            d($e->getMessage());
        }
       
    }

    
    public function quienes_somos ()
    {
        try {
                $data['titulo']='¿Quiénes somos?';
                $eleccion['resaltar']="Quienes";
                echo view('front/head_view',$data);
                echo view('front/navbar_view',$eleccion);
                echo view('front/quienes_somos');
                if(session()->id_usuario!=null){
                   echo view('front/modal_cierre_sesion'); 
                };
                echo view('front/footer_view');
        } catch (Exception $e) {
            d($e->getMessage());
        }
        
    }
    public function acerca_de ()
    {
        try {
                $data['titulo']='Acerca De';
                $eleccion['resaltar']="Acerca";
                echo view('front/head_view',$data);
                echo view('front/navbar_view',$eleccion);
                echo view('front/acerca_de');
                if(session()->id_usuario!=null){
                   echo view('front/modal_cierre_sesion'); 
                };
                echo view('front/footer_view');
        } catch (Exception $e) {
            d($e->getMessage());
        }
      
    }

    /*
    public function registrarse ()
    {
        $data['titulo']='Registrarse';
        $eleccion['resaltar']=4;
        echo view('front/head_view',$data);
        echo view('front/navbar_view',$eleccion);
        echo view('front/registrarse');
        echo view('front/footer_view');
    }
    public function login ()
    {
        $data['titulo']='Iniciar Sesión';
        $eleccion['resaltar']=5;
        echo view('front/head_view',$data);
        echo view('front/navbar_view',$eleccion);
        echo view('front/login');
        echo view('front/footer_view');
    }*/
}
