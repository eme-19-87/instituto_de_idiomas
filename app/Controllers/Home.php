<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['titulo']='Instituto de Idiomas';
        echo view('front/head_view',$data);
        echo view('front/navbar_view');
        echo view('front/principal');
        echo view('front/footer_view');
    }
    public function quienes_somos ()
    {
        $data['titulo']='¿Quiénes somos?';
        echo view('front/head_view',$data);
        echo view('front/navbar_view');
        echo view('front/quienes_somos');
        echo view('front/footer_view');
    }
    public function acerca_de ()
    {
        $data['titulo']='Acerca De';
        echo view('front/head_view',$data);
        echo view('front/navbar_view');
        echo view('front/acerca_de');
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
