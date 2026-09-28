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

	<h1 > Add a new molecule</h1>
	
<form method="post" enctype="multipart/form-data" action="add.php" class="mb-4"> 

  <div class="form-group">
    <label for="exampleInputEmail1">IC50 *</label>
    <input name="MolIc50" type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter IC50"> 
  </div>
  
  <div class="form-group">
    <label for="exampleInputEmail1">Chemdraw(.cdx) *</label>
    <input name="MolChem" type="file" class="inputFile"> 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Mol file 3000(.mol) *</label>
    <input name="MolFile3" type="file" class="inputFile"> 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Sybyle2(.mol2) *</label>
    <input name="MolSy2" type="file" class="inputFile"> 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Protein data bank(.pdb) *</label>
    <input name="MolPDB" type="file" class="inputFile"> 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">SD file(.sdf) *</label>
    <input name="MolSdf" type="file" class="inputFile"> 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">Smile(.smi) *</label>
    <input name="MolSmi" type="file" class="inputFile"> 
  </div>

  <div class="form-group">
    <label for="exampleInputEmail1">2D image structure *</label>
    <input name="Mol2D" type="file" class="inputFile"> 
  </div>  
    
  <div class="form-group">
    <label for="exampleInputEmail1">3D image structure *</label>
    <input name="Mol3D" type="file" class="inputFile">
  </div> 
    	  
	<button type="submit" name="valider" class="btn btn-primary" style="float: right;">Add</button>
</form>

<form action="bioinf.php"><input type="submit" value="back" />
</form>
		
<?php
if (isset ($_POST['valider']))
{   
      // Check if a file has been uploaded
            $MolIc50=$_POST['MolIc50'];
       //     $Mol2D=$_POST['Mol2D'];
       //     $Mol3D=$_POST['Mol3D'];
            
            
  if(isset($MolIc50)&&isset($_FILES['MolChem'])&&isset($_FILES['MolFile3'])&&isset($_FILES['MolSy2'])&&isset($_FILES['MolPDB'])&&isset($_FILES['MolSdf'])&&isset($_FILES['MolSmi'])&&isset($_FILES['Mol3D'])&&isset($_FILES['Mol2D'])) 
  {
    // Make sure the file was sent without errors
	if(($_FILES['MolChem']['error'] == 0)&&($_FILES['MolFile3']['error'] == 0)&&($_FILES['MolSy2']['error'] == 0)&&($_FILES['MolPDB']['error'] == 0)&&($_FILES['MolSdf']['error'] == 0)&&($_FILES['MolSmi']['error'] == 0)&&($_FILES['Mol3D']['error'] == 0)&&($_FILES['Mol2D']['error'] == 0)) 
    {
	   		$base = mysqli_connect ('localhost', 'root', '','chimiotheque');  
	    	mysqli_select_db ($base,'chimiotheque') ;

 
        // Gather all required data
    
    $nameChem = $base->real_escape_string($_FILES['MolChem']['name']);
    $mimeChem = $base->real_escape_string($_FILES['MolChem']['type']);
    $dataChem = $base->real_escape_string(file_get_contents($_FILES  ['MolChem']['tmp_name']));
    $sizeChem = intval($_FILES['MolChem']['size']);

    $nameMFile = $base->real_escape_string($_FILES['MolFile3']['name']);
    $mimeMFile = $base->real_escape_string($_FILES['MolFile3']['type']);
    $dataMFile = $base->real_escape_string(file_get_contents($_FILES  ['MolFile3']['tmp_name']));
    $sizeMFile = intval($_FILES['MolFile3']['size']);

    $nameSy2 = $base->real_escape_string($_FILES['MolSy2']['name']);
    $mimeSy2 = $base->real_escape_string($_FILES['MolSy2']['type']);
    $dataSy2 = $base->real_escape_string(file_get_contents($_FILES  ['MolSy2']['tmp_name']));
    $sizeSy2 = intval($_FILES['MolSy2']['size']);

    $namePDB = $base->real_escape_string($_FILES['MolPDB']['name']);
    $mimePDB = $base->real_escape_string($_FILES['MolPDB']['type']);
    $dataPDB = $base->real_escape_string(file_get_contents($_FILES  ['MolPDB']['tmp_name']));
    $sizePDB = intval($_FILES['MolPDB']['size']);

    $nameSdf = $base->real_escape_string($_FILES['MolSdf']['name']);
    $mimeSdf = $base->real_escape_string($_FILES['MolSdf']['type']);
    $dataSdf = $base->real_escape_string(file_get_contents($_FILES  ['MolSdf']['tmp_name']));
    $sizeSdf = intval($_FILES['MolSdf']['size']);

    $nameSmi = $base->real_escape_string($_FILES['MolSmi']['name']);
    $mimeSmi = $base->real_escape_string($_FILES['MolSmi']['type']);
    $dataSmi = $base->real_escape_string(file_get_contents($_FILES  ['MolSmi']['tmp_name']));
    $sizeSmi = intval($_FILES['MolSmi']['size']);

    $name2d = $base->real_escape_string($_FILES['Mol2D']['name']);
    $mime2d = $base->real_escape_string($_FILES['Mol2D']['type']);
    $data2d = $base->real_escape_string(file_get_contents($_FILES  ['Mol2D']['tmp_name']));
    $size2d = intval($_FILES['Mol2D']['size']);
            
    $name3d = $base->real_escape_string($_FILES['Mol3D']['name']);
    $mime3d = $base->real_escape_string($_FILES['Mol3D']['type']);
    $data3d = $base->real_escape_string(file_get_contents($_FILES  ['Mol3D']['tmp_name']));
    $size3d = intval($_FILES['Mol3D']['size']);
    
    $sql = 'INSERT INTO molecule (ic50,champ1,champ2,champ3,champ4,champ5,champ6,image2d,image3d) VALUES("'.$MolIc50.'","'.$dataChem.'","'.$dataMFile.'","'.$dataSy2.'","'.$dataPDB.'","'.$dataSdf.'","'.$dataSmi.'","'.$data2d.'","'.$data3d.'")';  
 
    mysqli_query ($base,$sql) or die ('Erreur SQL !'.$sql.'<br />'.mysqli_error($base)); 
    mysqli_close($base);
        
    echo '<span style="color:#3af24b;text-align:center;">The molecule has been succesfully added!</span>';
    
    }
    else
    {
  	    echo '<span style="color:#ffaaae;text-align:center;">Please unsure that all the required fields are correctly filled!</span>';			
	}    
  }
  else 
  {
  	    echo '<span style="color:#ffaaae;text-align:center;">Please unsure that all the required fields are correctly filled!</span>';
  }
    
}

?>		
		
		
		
			
	</body>
</html>