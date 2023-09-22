<?php

//Me indica este archivo será parte del Modelo
namespace App\Models;

//sirve para traer la información necesaria para que nuestra clase extienda de ella
use CodeIgniter\Model;

//Creo la clase que extiende de Model
class UsuariosModel extends Model
{

    //el nombre de la tabla
    protected $table      = 'usuarios';

    //el nombre del campo primario
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    //el tipo de retorno
    protected $returnType     = 'array';

    //Para indicar que no se harán eliminaciones de filas. En el trabajo, aplicaremos bajas lógicas
    protected $useSoftDeletes = false;

    //Aquí colocamos los campos de nuestra tabla. No se agrega el campo id
    protected $allowedFields = ['nombre','apellido','usuario','telefono','correo','password','activo','id_perfil'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    /*Son los campos que llevarán el registro de actualizaciones, creaciones y eliminaciones.
    Codeigniter lo hará de manera automática y sólo le decimos cómo se llamarán esos campos en la tabla
    con la que estamos trabajando.
    En este ejemplo, se llamarán fecha_alta y fecha_edit que guardarán, respectivamente, la fecha en la cual el registro fue creada y actualizado.
    Debe tenerse en cuenta que estos campos deben ser agregados a la tabla con la que se trabaja.
    Podemos indicar que la fecha_edit sea nulo para que tome ese valor al momento de crear el registro.
    */
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_edit';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    /*Retorna las unidades dependiendo si están o no activas.
    La gunción recibe una variable que será de tipo entero con valor 1 si el producto está activo y con
    valor 0 si no lo está.
    El where('activo',$activo) permite buscar los registros en la tabla unidades que tengan el 
    campo activo con valor igual a 1.
    La porción where('activo',$activo)->findAll(); recupera todos los campos del registro.*/
    public function getUsuarios(){
        try {
            return $this->findAll();
        } catch (Exception $e) {
            
        }
       
    }

    public function insertarUsuario($datos){
        try {
            $this->save($datos);

        } catch (Exception $e) {
            
        }
        
        
    }

    public function getUsuarioPorId($id){
        try {
            return $this->where('id_usuario',$id)->first();

        } catch (Exception $e) {
            
        }
        
    }

    public function getPorEstado($estado){
        try {
            return $this->where('activo',$estado)->findAll();

        } catch (Exception $e) {
            
        }
        
    }


    public function updateUsuario($id,$datos){
        try {
            $this->update($id,$datos);

        } catch (Exception $e) {
            
        }
        
    }

    public function darBaja($id){
        try {
            $this->update($id,['activo'=>0]);
        } catch (Exception $e) {
            
        }
        
    }

    public function darAlta($id){
        try {
             $this->update($id,['activo'=>1]);

        } catch (Exception $e) {
            
        }
       
    }

    public function getUsuarioPorMail($mail){
        try {
             $busqueda=['correo'=>$mail,'activo'=>1];
             return $this->where($busqueda)->first();
        } catch (Exception $e) {
            
        }
       
    }

    public function cambiarEstadoUsuario($id,$estado){

        $nuevo_estado=0;
        if($estado==$nuevo_estado){
            $nuevo_estado=1;
        };
      $this->update($id,['activo'=>$nuevo_estado]);
    }

    
}
