<?php


namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
  
 class CtrlLogin extends BaseController
{

    private $usuarios;
    private $reglas_login;
    //Definimos los setters
    private function setModelUsuarios($modelo){
        $this->usuarios=$modelo;
    }


    private function setReglasLogin($reglas){
         $this->reglas_login=$reglas;
    }

    //Definimos los getters
    private function getModelUsuarios(){
        return $this->usuarios;
    }


    private function getReglasLogin(){
        return $this->reglas_login;
    }
   

    public function __construct(){
        helper('form','url');
        $this->setModelUsuarios(new UsuariosModel());
        

        $this->setReglasLogin(
            [
            "mail_login"=>["rules"=>"required|valid_email",
            "errors"=>["required"=>"El campo 'correo electronico' es obligatorio",
                       "valid_email"=>"El mail ingresado debe tener la forma nombre@dominio"] 
            ],

            "pass_login"=>["rules"=>"required",
            "errors"=>["required"=>"El campo 'Contraseña' es obligatorio"] 
            ]

            ]);
    }

     public function login ()
    {
        try {
                    //Esto controla si el usuario fue redirigido desde el registro de usuario
                    //Si lo fue, se mostrará la ventana de bienvenida
                    $bienvenida=session('nuevoUsu');
                    $data['titulo']='Login';
                    $eleccion['resaltar']='Login';
                    echo view('front/head_view',$data);
                    echo view('front/navbar_view',$eleccion);
                    echo view('back/usuarios/login');
                    if($bienvenida){
                        echo view('front/bienvenida_registro');
                    }
                    echo view('front/footer_view');
               
            
        } catch (Exception $e) {
            d($e->getMessage());
        }
        
    }

     /*Controla primeramente que los campos no se dejen vacíos y
  que exista el usuario y la contraseña*/
    public function controlar_logueo(){
        try {
              $metodo_post=$this->request->getMethod()=="post";
              $reglas_validas=$this->validate($this->getReglasLogin());
              //$error=null;
               if($metodo_post && $reglas_validas){
                    //recupero el usuario desde la base de datos
                    $datos_usuario=$this->getModelUsuarios()->getUsuarioPorMail($this->request->getPost("mail_login"));
                    //Reviso que el usuario exista e inicia la sesión
                    $error=$this->iniciar_sesion($datos_usuario,$this->request->getPost("pass_login"));
                    //En caso de que haya error o no, este método redirecciona a la vista pertinente
                    return $this->redireccionarInicioSesion($error);
               } else{
                     //$data['validation']=$this->validator;
                    
                    return redirect()->back()->withInput()->with('errors',$this->validator->getErrors());
               };
            
        } catch (Exception $e) {
            d($e->getMessage());
        };
     

    }

    /*Se encrga de crear la sesión previa revisión que el usuario exista.
    Retorna un arreglo con un string vacío en caso de haberse creado correctamente la
    sesión y un arreglo con el string del error en caso contrario*/

    private function iniciar_sesion($datos_usuario,$password){
        try {
                 $datos=null;
                //Si el usuario existe, $datos_usuario no será nulo
                $existe_usuario=$this->comprobarUsuarioContra($datos_usuario,$password);

                //Compruebo que las contraseñas ingresadas sean las correctas y si lo es, inicio la sesión
                //En caso contrario, retorno los los errores que se mostrarán en la vista.
                //Si no hay error, se retorna un arreglo cuyo campo 'error' está vacío
                if($existe_usuario){
                    $datos_sesion=[
                        'id_usuario'=>$datos_usuario['id_usuario'],
                        'nombre_persona'=>$datos_usuario['apellido']." ".$datos_usuario['nombre'],
                        "correo"=>$datos_usuario['correo'],
                        "nombre_usuario"=>$datos_usuario['usuario']

                    ];
                    $session=session();
                    $session->set($datos_sesion);
                    $datos["error"]="";
                }else{
                    $datos["error"]="Error al inicial sesión. Controle su nombre de usuario y su contraseña";
                };
                return $datos;
            
        } catch (Exception $e) {
            d($e->getMessage());
        };
       
    }


    /*Comprueba que exista el usuario y que la contraseña corresponda con el usuario asignado*/
    private function comprobarUsuarioContra($datos_usuario,$password){
        try {
                $valido=false;
                if($datos_usuario!=null){
                    $valido=password_verify($password,$datos_usuario['password']);
                };
                return $valido;
        } catch (Exception $e) {
            d($e->getMessage());
        }
       

    }

    /*Permite redireccionar a la página principal si hubo éxito en el logueo. 
    Si el logueo fracas, redireccionará a la ventana de logueo mostrando el error ocurrido.
    */

    public function redireccionarInicioSesion($datos_error){
        try {
            if(strlen($datos_error["error"])!=0){
               
                 return redirect()->back()->withInput()->with('errors',$datos_error);
              
            }
            else{
                return redirect()->to(base_url());
            };
             
        } catch (Exception $e) {
            d($e->getMessage());
        };
      
    

    }   

    public function logout(){
        try {
            if (session()->id_usuario!=null){
               session()->destroy(); 
            };
            return redirect()->to(base_url());
             
        } catch (Exception $e) {
            d($e->getMessage());
        };
       
    }


        // Para probar admin_view

        public function admin_view ()
        {
    
            $data['titulo']='Administración';
            $eleccion['resaltar']="Administrar";
            echo view('front/head_view',$data);
            echo view('front/navbar_view',$eleccion);
            echo view('back/usuarios/admin_view');
            echo view('front/footer_view');
        }

}