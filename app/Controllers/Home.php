<?php

namespace App\Controllers;

class Home extends BaseController
{
    /*Siempre debe controlarse si hay una sesión iniciada. Si la hay, debemos cargar en las vistas el modal
    para el cierre de sesión. Esto sólo en las vistas que se verán cuando se tenga una sesión iniciada.*/
    public function index()
    {
        $data['titulo']='Instituto de Idiomas';
        echo view('front/head_view',$data);
        echo view('front/navbar_view');
        echo view('front/principal');
        if(session()->id_usuario!=null){
           echo view('front/modal_cierre_sesion'); 
        };
        echo view('front/footer_view');
    }
    public function quienes_somos ()
    {
        $data['titulo']='¿Quiénes somos?';
        echo view('front/head_view',$data);
        echo view('front/navbar_view');
        echo view('front/quienes_somos');
        if(session()->id_usuario!=null){
           echo view('front/modal_cierre_sesion'); 
        };
        echo view('front/footer_view');
    }
    public function acerca_de ()
    {
        $data['titulo']='Acerca De';
        echo view('front/head_view',$data);
        echo view('front/navbar_view');
        echo view('front/acerca_de');
        if(session()->id_usuario!=null){
           echo view('front/modal_cierre_sesion'); 
        };
        echo view('front/footer_view');
    }
    public function registrarse ()
    {
        $data['titulo']='Registrarse';
        echo view('front/head_view',$data);
        echo view('front/navbar_view');
        echo view('front/registrarse');
        echo view('front/footer_view');
    }
    public function login ()
    {
        $data['titulo']='Iniciar Sesión';
        echo view('front/head_view',$data);
        echo view('front/navbar_view');
        echo view('front/login');
        echo view('front/footer_view');
    }
}
