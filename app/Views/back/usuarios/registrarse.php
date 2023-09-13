<section class="container-fluid px-4">
  <h2 class="text-star pt-4 pb-4">Registrarse</h2>
  
  <form class="pb-5 px-2" method="post" action="<?php echo base_url('/registrar_usuario')?>">
    <?php echo csrf_field();?>
    <div class="row text-star pb-3 px-2" style="background: #F9B400; border-radius:15px;">
      <h3 class="pt-3">Datos personales</h3>
        <div class="col-md-6 col-sm-12 pb-3">
          <label for="exampleFormControlInput1" class="form-label fw-semibold fs-5">Nombre</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ejemplo: Ana"
          id="nombre" name="nombre" value="<?php echo set_value('nombre')?>">
          <!--Aquí se muestran los errores para el nombre-->
          <?php if (isset ($validation) && $validation->hasError('nombre')) {?>
             <span class="alert-danger">
                 *<?php echo $validation->getError('nombre');?>
            </span>
         
          <?php };?>

        </div>

        <div class="col-md-6 col-sm-12 pb-3">
          <label for="exampleFormControlInput1" class="form-label fw-semibold fs-5">Apellido</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ejemplo: Pérez" id="apellido" name="apellido" value="<?php echo set_value('apellido')?>">
          <!--Aquí se muestran los errores para el apellido-->
           <?php if (isset ($validation) && $validation->hasError('apellido')) {?>
             <span class="alert-danger">
                 *<?php echo $validation->getError('apellido');?>
            </span>
            <?php };?>
        </div>

         <div class="col-md-6 col-sm-12 pb-3">
          <label for="exampleFormControlInput1" class="form-label fw-semibold fs-5">Nombre Usuario</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ejemplo: Pérez" id="usuario" name="usuario" value="<?php echo set_value('usuario')?>">
          <!--Aquí se muestran los errores para el apellido-->
           <?php if (isset ($validation) && $validation->hasError('usuario')) {?>
             <span class="alert-danger">
                 *<?php echo $validation->getError('usuario');?>
            </span>
            <?php };?>
        </div>

        <div class="col-md-6 col-sm-12 pb-3">
          <label for="exampleFormControlInput1" class="form-label fw-semibold fs-5">Correo electrónico</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Ejemplo: ana@gmail.com" id="mail" name="mail" value="<?php echo set_value('mail')?>">
          <!--Aquí se muestran los errores para el mail-->
           <?php if (isset ($validation) && $validation->hasError('mail')) {?>
             <span class="alert-danger">
                 *<?php echo $validation->getError('mail');?>
            </span>
            <?php };?>
        </div>

        <div class="col-md-6 col-sm-12 pb-3">
          <label for="exampleFormControlInput1" class="form-label fw-semibold fs-5">Teléfono</label>
          <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Formato: XXX-XXX-XXXX" id="telefono" name="telefono" value="<?php echo set_value('telefono')?>">
          <!--Aquí se muestran los errores para el teléfono-->
           <?php if (isset ($validation) && $validation->hasError('telefono')) {?>
             <span class="alert-danger">
                 *<?php echo $validation->getError('telefono');?>
            </span>
            <?php };?>
        </div>

      <h3 class="pt-2">Seguridad</h3>

        <div class="col-md-6 col-sm-12 pb-3">
          <label for="exampleFormControlInput1" class="form-label fw-semibold fs-5">Contraseña</label>
          <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Mínimo 8 caracteres, una mayúscula, una mínuscula y un número"
          id="pass" name="pass">
          <!--Aquí se muestran los errores para la contraseña--->
           <?php if (isset ($validation) && $validation->hasError('pass')) {?>
             <span class="alert-danger">
                 *<?php echo $validation->getError('pass');?>
            </span>
            <?php };?>
        </div>

        <div class="col-md-6 col-sm-12 pb-3">
          <label for="exampleFormControlInput1" class="form-label fw-semibold fs-5">Confirmar Contraseña</label>
          <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Confirme su contraseña, por favor" id="pass_conf" name="pass_conf">
          <!--Aquí se muestran los errores para la confirmación de la contraseña-->
           <?php if (isset ($validation) && $validation->hasError('pass_conf')) {?>
             <span class="alert-danger">
                 *<?php echo $validation->getError('pass_conf');?>
            </span>
            <?php };?>
        </div>

      <div class="col-md-6 col-sm-12 py-3">
        <button type="submit" class="w-100 boton-aceptar fs-5">
          Registrarse
        </button>
      </div>

      <div class="col-md-6 col-sm-12 py-3">
        <button type="button" class="w-100 boton-cancelar fw-semibold fs-5">
          Cancelar
        </button>
      </div>
    </div>
  </form>
</section>

