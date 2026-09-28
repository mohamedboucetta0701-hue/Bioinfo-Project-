<?php

define('PER_PAGE', 10);
//$MODE_ADMIN=0;
$MODE_ADMIN=isset($_GET['mod']) ? $_GET['mod'] : 0	;

$pdo = new PDO('mysql:host=localhost; dbname=chimiotheque;' , 'root', '',[
PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC,
PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
] );

$query="SELECT * FROM molecule";
$queryCount="SELECT count(num) as count FROM molecule";
$params=[];
if(!empty($_GET['q']))
{
	$query .= " WHERE champ1 LIKE :champ";
	$queryCount .= " WHERE champ1 LIKE :champ";	
	$params['champ']="%" . $_GET['q'] ."%";
}

//Pagination

$page=(int)(isset($_GET['p']) ? $_GET['p'] : 1);
$offset=($page-1)*PER_PAGE;




$query .= " LIMIT ".PER_PAGE . " OFFSET $offset";

$statement =$pdo->prepare($query);
$statement->execute($params);
$molecules=$statement->fetchAll();

$statement =$pdo->prepare($queryCount);
$statement->execute($params);
$count=(int)$statement->fetch()["count"];
$pages=ceil($count/PER_PAGE);





//dd($molecules)
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" >		
		<meta http-equiv="X-UA-Compatible" content="ie=edge" >			
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<title> Data base</title>
	</head>
	<body class="p-4">


		
		<?php if($MODE_ADMIN==1):  ?>
		<a href="?<?= http_build_query(array_merge($_GET,['mod'=>0])) ?>" style="float: right;"> Switch to user mode </a>
	    <?php else : ?>		
		<a href="?<?= http_build_query(array_merge($_GET,['mod'=>1])) ?>" style="float: right;"> Switch to administrator mode </a>		
		<?php endif  ?>	
		

	
	<h1 > Molecules</h1>
	
<form action="" class="mb-4"> 
	  <div class="form-group">
		<input type="text" class="form-control" name="q" placeholder="Search by name" value="<?= htmlentities(isset($_GET['q']) ? $_GET['q'] : null) ?>">
	  </div>
	  <button class="btn btn-primary" > Search</button>  	  
</form>
	
	
<form action="add.php" class="mb-4"> 
	<?php if($MODE_ADMIN==1): ?>	  
	  <button class="btn btn-primary" style="float: right;" > Add</button>
	<?php endif  ?>		  
</form>
	
	
		<table class="table table-striped" valign="middle" >
			<thead>
				<tr>
				<?php if($MODE_ADMIN==1): ?>				
				<th> ::</th>
				<?php endif  ?>											
				<th> ID</th>
				<th> ic50(µm)</th>
			    <th> Chemdraw(.cdx)</th>	
			    <th> Mol file 3000(.mol)</th>
			    <th> Sybyle2(.mol2)</th>
			    <th> Protein data bank(.pdb)</th>
			    <th> SD file(.sdf)</th>
			    <th> Smile(.smi)</th>
			    <th> Structure 2D</th>
			    <th> Structure 3D</th>
			    		    
				</tr>
			</thead>
			<tbody>
			<?php foreach($molecules as $molecule):?>
				<tr > 
				<?php if($MODE_ADMIN==1): ?>
					<td > <a href="delete.php?<?=http_build_query(array_merge($_GET,['d'=>$molecule['num']]))?>" >Delete</a> </td>								
				<?php endif  ?>
					<td > #<?= $molecule['num']?></td>
					<td> <?= $molecule['ic50']?></td>
					<td> <?= $molecule['champ1']?></td>
					<td> <?= $molecule['champ2']?></td>
					<td> <?= $molecule['champ3']?></td>
					<td> <?= $molecule['champ4']?></td>
					<td> <?= $molecule['champ5']?></td>
					<td> <?= $molecule['champ6']?></td>
					<td> <?php echo '<img src="data:image/png;base64,'.base64_encode( $molecule['image2d'] ).'" height="130" >'	?></td>	
					<td> <?php echo '<img src="data:image/png;base64,'.base64_encode( $molecule['image3d'] ).'" height="130" >'	?></td>				
				
				</tr>
			<?php endforeach ?>
			</tbody>
		</table> 
	
		
		<?php if($pages>1 && $page>1):  ?>
		<a href="?<?= http_build_query(array_merge($_GET,['p'=>$page-1])) ?>" class="btn btn-primary"> <-Previous page </a>
		<?php endif  ?>			
		
		<?php if($pages>1 && $page<$pages):  ?>
		<a href="?<?= http_build_query(array_merge($_GET,['p'=>$page+1])) ?>" class="btn btn-primary"> Next page-> </a>
		<?php endif  ?>		
	</body>
</html>