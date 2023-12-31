<?php
/*Documentación: https://codeigniter.com/user_guide/incoming/filters.html?highlight=s*/
/*
Cuando se crea el filtro, se debe registrar en el archivo Filters.php que se encuentra en la 
carpeta app/Config.
Debe quedar algo así para el filtro
public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'auth'=>\App\Filters\Auth::class
    ];


*/
namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /*El valor 1 representa al usuario Administrador. Si un administrador está logueado,
        no se le debe permitir ingresar al registro o logueo.
        El valor 2 representa al usuario Cliente. Si en ambos casos está nulo, entonces redirigirá a
        la vista principal.*/
    	
        switch(session()->tipo){
            case 1:
                return redirect()->to(base_url('admin/inicio'));
                break;
            case 2:
                 return redirect()->to(base_url());
                 break;
        };
        /*
        if(session()->tipo==2){
        	
        }else if(session()->tipo==1){
            
        }*/
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
