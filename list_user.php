<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('api/db_connect.php') ?>
	<title>SMART User List</title>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary">User List</div>
		<br>
		<br>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="10%">
						<col width="40%">
						<col width="30%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>User Type</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$qry = $conn->query("SELECT * from users order by name asc ");
					$i = 1;
					if($qry->num_rows > 0){
						while($row= $qry->fetch_assoc()){
						?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo $row['name'] ?></td>
						<td><?php if($row['user_type'] == 1) echo 'Admin';if($row['user_type'] == 2) echo 'Lecturer';if($row['user_type'] == 3) echo 'Student';  ?></td>
						<td>
							<center>
							 <button class="btn btn-sm btn-outline-primary edit_user" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i> Edit</button>
							</center>
						</td>
					</tr>
					<?php
					}
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="modal fade" id="manage_user" tabindex="-1" role="dialog" >
				<div class="modal-dialog modal-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							
							<h4 class="modal-title" id="myModallabel">Add New user</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						</div>
						<form id='user-frm'>
							<div class ="modal-body">
								<div id="msg"></div>
								<div class="form-group">
									<label>Name</label>
									<input type="hidden" name="id" />
									<input type="hidden" name="uid" />
									<input type="hidden" name="user_type" value = '3' />
									<input type="text" name="name" required="required" class="form-control" />
								</div>
                <div class="form-group">
                  <label>User Type</label>
                  <select id="userType" class="form-control" name="user_type">
                    <option value="1">Admin</option>
                    <option value="2">Lecturer</option>
                    <option value="3">Student</option>
                  </select>
                </div>
								<div class="form-group">
									<label>Username</label>
									<input type="text" name ="username" required="" class="form-control" />
								</div>
								<div class="form-group">
									<label>Password</label>
									<input type="password" name="password" required="required" class="form-control" />
								</div>
							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary" name="submit"><span class="glyphicon glyphicon-save"></span> Save</button>
							</div>
						</form>
					</div>
				</div>
			</div>
</body>
<script>
	$(document).ready(function(){
		$('#table').DataTable();
		$('.edit_user').click(function(){
			var id = $(this).attr('data-id')
			$.ajax({
				url:'./api/get_user.php?id='+id,
				error:err=>console.log(err),
				success:function(resp){
					if(typeof resp != undefined){
            resp = JSON.parse(resp)
						$('[name="id"]').val(resp.id)
						$('[name="name"]').val(resp.name)
						$("#userType").val(resp.user_type)
						$('[name="username"]').val(resp.username)
						$('[name="password"]').val(resp.password)
						$('#manage_user .modal-title').html('Edit user')
						$('#manage_user').modal('show')

					}
				}
			})

		})

		$('#user-frm').submit(function(e){
			e.preventDefault();
			$('#user-frm [name="submit"]').attr('disabled',true)
			$('#user-frm [name="submit"]').html('Saving...')
			$('#msg').html('')

			$.ajax({
				url:'./save_user.php',
				method:'POST',
				data:$(this).serialize(),
				error:err=>{
					console.log(err)
					alert('An error occured')
					$('#user-frm [name="submit"]').removeAttr('disabled')
					$('#user-frm [name="submit"]').html('Save')
				},
				success:function(resp){
					console.log(resp)
					if(typeof resp != undefined){
						resp = JSON.parse(resp)
						if(resp.status == 1){
							alert('Data successfully saved');
							location.reload()
						}else{
						$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')

						}
					}
				}
			})
		})
	})
</script>
</html>