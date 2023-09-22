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

class Admin implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
    	
        if(session()->id_usuario==null or session()->tipo!=1){
        	return redirect()->to(base_url());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
