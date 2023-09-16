<?php

/*Inciamos que se trata de un controlador*/
namespace App\Controllers;

/*Importamos los archivos necesarios para trabajar. Primero, importamos el BaseController que tendrá
las funciones que Codigniter ya trae preparado para trabajar con los controladores.
Segundo, importamos el modelo con el cual se trabajará en este controlador.
Tercero, un archivo php con funciones comunes a varios controladores*/
use App\Controllers\BaseController;
use App\Models\UsuariosModel;


/*Con  CtrlUnidades extends BaseController le pedimos al controlador que herede de BaseController*/
class CtrlUsuarios extends BaseController
{
  
  //Creamos los atributos de clase 
    private $usuarios;
    private $reglas_validacion;
    private $reglas_login;
    //Definimos los setters
    private function setModelUsuarios($modelo){
        $this->usuarios=$modelo;
    }

    private function setReglaNewUpdate($reglas){
        $this->reglas_validacion=$reglas;
    }

    private function setReglasLogin($reglas){
         $this->reglas_login=$reglas;
    }

    //Definimos los getters
    private function getModelUsuarios(){
        return $this->usuarios;
    }


    private function getReglaNewUpdate(){
        return $this->reglas_validacion;
    }

    private function getReglasLogin(){
        return $this->reglas_login;
    }


    /*Creamos el controlador.
    Aquí relacionamos el modelo y el controlador. El atributo de clase $unidades será un objeto de tipo
    UnidadesModel y nos servirá para realizar las query a la tabla unidades.
    Nótese cómo se settea la variable mediante el setter*/
    public function __construct(){
        helper('form','url');
        $this->setModelUsuarios(new UsuariosModel());
        /*
        La regla is_unique permite determinar que un campo específico sea único. Para ello le decimos
        is_unique['nombre_tabla.nombre_campo'].
        La regla matches sirve para comprobar si dos campos tienen el mismo valor. Su sintaxis será
        matches['nombre_campo']. Por campo me refiero a los input de la vista.
        */
        $this->setReglaNewUpdate(
            [
            "nombre"=>["rules"=>"required|min_length[3]|max_length[50]",
            "errors"=>["required"=>"El campo 'nombre' es obligatorio",
                      "min_length"=>"El campo nombre debe contener como mínimo 3 caracteres",
                      "max_length"=>"El campo nombre no debe superar los 50 caracteres"] 
            ],

            "apellido"=>["rules"=>"required|min_length[3]|max_length[80]",
            "errors"=>["required"=>"El campo 'apellido' es obligatorio",
                      "min_length"=>"El campo apellido debe contener como mínimo 3 caracteres",
                      "max_length"=>"El campo apellido no debe superar los 80 caracteres"] 
            ],

            "usuario"=>["rules"=>"required|min_length[4]|max_length[40]|is_unique[usuarios.correo]",
            "errors"=>["required"=>"El nombre del usuario es requerido",
                       "min_length"=>"El nombre de usuario debe contener como mínimo 4 caracteres",
                      "max_length"=>"El nombre de usuario no debe superar los 40 caracteres"],
                      "is_unique"=>"Ya existe un usuario con el nombre establecido"]
            ],

            "pass"=>["rules"=>"required|min_length[8]|max_length[100]",
            "errors"=>["required"=>"El campo 'Contraseña' es obligatorio",
                       "min_length"=>"La contraseña debe contener al menos 8 caracteres"]
            ],

            "pass_conf"=>["rules"=>"required|matches[pass]",
            "errors"=>["required"=>"El campo 'Confirmar Contraseña' es obligatorio",
                      "matches"=>"La contraseña y su confirmación no coinciden"]
            ],

             "telefono"=>["rules"=>"required|regex_match[/3[0123456789]{3}-[0123456789]{6}/]",
            "errors"=>["required"=>"El campo 'telefono'e es obligatorio",
                      "regex_match"=>"El teléfono debe tener la forma 3794-3467823"]
            ],
             "mail"=>["rules"=>"required|valid_email|is_unique[usuarios.correo]",
            "errors"=>["required"=>"El campo 'mail' es obligatorio",
                       "valid_email"=>"El mail ingresado debe tener la forma nombre@dominio",
                       'is_unique'=>'Ya existe un usuario registrado con el mail ingresado']
            ],
            ]);

        $this->setReglasLogin(
            [
            "mail_login"=>["rules"=>"required|valid_email",
            "errors"=>["required"=>"El campo 'correo electronico' es obligatorio",
                       "valid_mail"=>"El mail ingresado debe tener la forma nombre@dominio"] 
            ],

            "pass_login"=>["rules"=>"required",
            "errors"=>["required"=>"El campo 'Contraseña' es obligatorio"] 
            ]

            ]);
    }


 public function registrarse ($errores=[])
    {
        try {
                
                //Aquí controlo si hay una sesión iniciada. Si la hay, no le dejo que se vea la
                //ventana de registrarse.
                if (session()->id_usuario==null){
                    $data['titulo']='Registrarse';
                    echo view('front/head_view',$data);
                    echo view('front/navbar_view');
                    echo view('back/usuarios/registrarse',$errores);
                    echo view('front/footer_view');
                }else{
                    return redirect()->to(base_url());
                }
                
            
        } catch (Exception $e) {

            
        }
        
    }

    public function login ($errores=[])
    {
        try {
                 //Aquí controlo si hay una sesión iniciada. Si la hay, no le dejo que se vea la
                //ventana de login
                if (session()->id_usuario==null){
                     $data['titulo']='Iniciar Sesión';
                    echo view('front/head_view',$data);
                    echo view('front/navbar_view');
                    echo view('back/usuarios/login',$errores);
                    echo view('front/footer_view');
                }else{
                    return redirect()->to(base_url());
                }
                
            
        } catch (Exception $e) {
            
        }
        
    }

     private function mostrar_bienvenida ()
    {
        try {
                
                 //Aquí controlo si hay una sesión iniciada. Si la hay, no le dejo que se vea la
                //ventana de login
                if (session()->id_usuario==null){
                    $data['titulo']='Bienvenido';
                    echo view('front/head_view',$data);
                    echo view('front/navbar_view');
                    echo view('front/login');
                    echo view('front/bienvenida_registro');
                    echo view('front/footer_view');


                }else{
                    return redirect()->to(base_url());
                }
                
            
        } catch (Exception $e) {
            
        }
        
    }
    

    
    /*El método que insertará los usuarios a la base de datos.
    Debemos tener en cuenta que, aquí, estamos recibiendo el método POST*/
    public function insertar_usuario(){
        /*Creamos el arreglo de datos que vamos a guardar
        Con $this->$request->getPost('nombre') recuperamos el dato enviado por el formulario con el método POST y el dato recuperado es el que se colocó en el input cuyo id y name es 'nombre.
        Lo mismo para el resto de campos
        Notamos que es un arreglo. 'nombre', 'apellido', 'correo', etc. son los nombres de nuestras columnas en la tabla. Sólo pasamos los campos que no sean autoincrementales y que no tengan checks u otras restricciones, ya que esos campos se completarán automáticamente según las reglas que hayamos colocado al momento de crear la tabla.
        */

        /*
        La línea  if ($this->request->getMethod()=="POST") valida que no se envíen datos con POST
        */
        try {

                 //almaceno los datos temporalmente para enviarlos al momento de mostrar errores
                 $datos_post=[
                    'nombre'=>$this->request->getPost('nombre'),
                    'apellido'=>$this->request->getPost('apellido'),
                    "usuario"=>$this->request->getPost('usuario'),
                    'correo'=>$this->request->getPost('mail'),
                    'telefono'=>$this->request->getPost('telefono')
                 ];
                 $metodo_post=$this->request->getMethod()=="post";

           //Esta linea valida que se cumplan las reglas implementadas en el constructor de la clase
                $reglas_validas=$this->validate($this->getReglaNewUpdate());
            
                //si ambas reglas se cumplen, allí recién creamos al usuario
                if ( $metodo_post && $reglas_validas ){
                    //encriptamos la contraseña para guardarla en la base de datos
                    $encript_pass=password_hash($this->request->getPost('pass'), PASSWORD_DEFAULT);

                    //creamos el arreglo con los datos que vamos a guardar en la base de datos
                    //la sintaxis es 'nombre_campo_en_la_tabla'=>valor
                    $new_usu=['nombre'=>$this->request->getPost('nombre'),
                    'apellido'=>$this->request->getPost('apellido'),
                    "usuario"=>$this->request->getPost('usuario'),
                    'correo'=>$this->request->getPost('mail'),
                    'telefono'=>$this->request->getPost('telefono'),
                     'password'=>$encript_pass,
                     'id_perfil'=>2
                      
                    ];
                    
                    //llamamos al modelo. Nosotros le pasamos los datos, es el modelo el que inserta
                    $this->getModelUsuarios()->insertarUsuario($new_usu);
                    $this->mostrar_bienvenida();
                }else{

                    $data['validation']=$this->validator;
                    //session()->setFlashdata('validation',$this->validator);
                    //session()->setFlashdata('datos_registro',$datos_post);
                   $this->registrarse($data);

                    
                  
                };
            
        } catch (Exception $e) {
            
        }
     
         
        

    }


  /*Controla primeramente que los campos no se dejen vacíos y
  que exista el usuario y la contraseña*/
    public function controlar_logueo(){
        try {
              $metodo_post=$this->request->getMethod()=="post";
              $reglas_validas=$this->validate($this->getReglasLogin());
              $error=null;
               if($metodo_post && $reglas_validas){
                    //recupero el usuario desde la base de datos
                    $datos_usuario=$this->getModelUsuarios()->getUsuarioPorMail($this->request->getPost("mail_login"));
                    //Reviso que el usuario exista e inicia la sesión
                    $error=$this->iniciar_sesion($datos_usuario,$this->request->getPost("pass_login"));
                    //En caso de que haya error o no, este método redirecciona a la vista pertinente
                    return $this->redireccionarInicioSesion($error);
               } else{
                $data['validation']=$this->validator;
                $this->login($data);
               };
            
        } catch (Exception $e) {
            
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
                        'nombre_usuario'=>$datos_usuario['apellido']." ".$datos_usuario['nombre'],
                        "correo"=>$datos_usuario['correo'],
                        "usuario"=>$datos_usuario['usuario']

                    ];
                    $session=session();
                    $session->set($datos_sesion);
                    $datos["error"]="";
                }else{
                    $datos["error"]="Error al inicial sesión. Controle su nombre de usuario y su contraseña";
                };
                return $datos;
            
        } catch (Exception $e) {
            
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
            
        }
       

    }

    /*Permite redireccionar a la página principal si hubo éxito en el logueo. 
    Si el logueo fracas, redireccionará a la ventana de logueo mostrando el error ocurrido.
    */

    public function redireccionarInicioSesion($datos_error){
        try {
            if(strlen($datos_error["error"])!=0){
                $this->login($datos_error);
              
            }
            else{
                return redirect()->to(base_url());
            };
             
        } catch (Exception $e) {
            
        };
      
    

    }   

    public function logout(){
        try {
             session()->destroy();
             return redirect()->to(base_url());
        } catch (Exception $e) {
            
        };
       
    }
}