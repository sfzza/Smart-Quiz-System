<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('api/db_connect.php') ?>
	<title>SMART Quiz Records</title>
</head>
<body>
	<?php include('nav_bar.php') ?>
	
	<div class="container-fluid admin">
		<div class="col-md-12 alert alert-primary">Quiz Records</div>
		<br>
		<div class="col-md-4 offset-md-4 mb-4">
			<select class="form-control select2" onchange="location.replace('history.php?quiz_id='+this.value)">
				<option value="all" <?php echo isset($_GET['quiz_id']) && $_GET['quiz_id'] == 'all' ? 'selected' : '' ?>>All</option>
				<?php 
				$where =''; 
				if($_SESSION['login_user_type'] == 2){
					$where = ' where user_id = '.$_SESSION['login_id'].' '; 
				}
				$quiz = $conn->query("SELECT * FROM quiz_list ".$user_id." order by title asc");
				while($row = $quiz->fetch_assoc()){
				?>
				<option value="<?php echo $row['id'] ?>" <?php echo isset($_GET['quiz_id']) && $_GET['quiz_id'] == $row['id']  ? 'selected' : '' ?>><?php echo $row['title'] ?></option>
			<?php } ?>
			</select>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table table-bordered" id='table'>
					<colgroup>
						<col width="10%">
						<col width="30%">
						<col width="20%">
						<col width="20%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Student Name</th>
							<th>Quiz</th>
							<th>Score</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$where = '';
					if($_SESSION['login_user_type'] == 2){
						$where = ' where q.user_id = '.$_SESSION['login_id'].' ';
					}
					if(isset($_GET['quiz_id']) && $_GET['quiz_id'] != 'all'){
						if(empty($where)){
						$where = ' where q.id = '.$_GET['quiz_id'].' ';

						}else{
						$where = ' and q.id = '.$_GET['quiz_id'].' ';

						}
					}
					$qry = $conn->query("SELECT h.*,u.name as student,q.title from history h inner join users u on h.user_id = u.id inner join quiz_list q on h.quiz_id = q.id ".$where." order by u.name asc ");
					$i = 1;
					if($qry->num_rows > 0){
						while($row= $qry->fetch_assoc()){
							
						?>
					<tr>
						<td><?php echo $i++ ?></td>
						<td><?php echo ucwords($row['student']) ?></td>
						<td><?php echo $row['title'] ?></td>
						<td class="text-center"><?php echo $row['score'].'/'.$row['total_score']  ?></td>
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
</body>
</html>