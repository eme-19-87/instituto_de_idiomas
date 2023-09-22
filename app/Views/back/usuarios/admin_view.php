<div class="container-fluid py-4 ps-4 px-4">
	<h2 class="text-star mb-4 ps-4">Tabla de usuarios registrados</h2>

	<table class="table table-hover table-bordered table-responsive border-dark px-4">
		<thead>
			<tr style="background-color: #FFD93D">
				<th scope="col" style="color: #5E1A57; background-color: #FFD93D">N°</th>
				<th scope="col" style="color: #5E1A57; background-color: #FFD93D">Nombre</th>
				<th scope="col" style="color: #5E1A57; background-color: #FFD93D">Apellido</th>
				<th scope="col" style="color: #5E1A57; background-color: #FFD93D">Correo electrónico</th>
				<th scope="col" style="color: #5E1A57; background-color: #FFD93D">Alta/Baja</th>
			</tr>
		</thead>
		<tbody class="table-group-divider">
			<!--
			<tr>
				<th scope="row">1</th>
				<td>María</td>
				<td>mmaria10@gmail.com</td>
				<td>---</td>
			</tr>
			<tr>
				<th scope="row">2</th>
				<td>Gonzáles</td>
				<td>gdavid@gmail.com</td>
				<td>---</td>
			</tr>-->
			<?php foreach ($usuarios as $usu){?>
				<tr>
					<th scope="row"><?php echo $usu['id_usuario']?></th>
					<th scope="row"><?php echo $usu['nombre']?></th>
					<th scope="row"><?php echo $usu['apellido']?></th>
					<th scope="row"><?php echo $usu['correo']?></th>
					
					<th scope="row">
						<a href=<?php echo base_url('admin/alta_usuario/'.$usu['id_usuario'].'/'.$usu['activo']);?>>

							<?php $condicion=$usu['activo'] ? 'Baja' : 'Alta'; echo $condicion;?>
							
						</a>
						
						</th>	
				</tr>
		    <?php };?>
		</tbody>
	</table>



</div>