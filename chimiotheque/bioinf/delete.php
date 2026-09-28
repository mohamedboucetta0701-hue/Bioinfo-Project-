		
<?php
if (isset($_GET['d']))
{   

            $IDtoDel=$_GET['d'];
	$base = mysqli_connect ('localhost', 'root', '','bioinfdb');  
	mysqli_select_db ($base,'bioinfdb') ;
        // Gather all required data
        
    $sql = 'DELETE FROM molecule WHERE num='.$IDtoDel;  
 
    mysqli_query ($base,$sql) or die ('Erreur SQL !'.$sql.'<br />'.mysqli_error($base)); 
    mysqli_close($base);
        
    echo '<span style="color:#3af24b;text-align:center;">The molecule with ID: '.$IDtoDel.' has been succesfully deleted!</span>';
    
    
} 
  else 
  {
  	    echo '<span style="color:#ffaaae;text-align:center;">Please unsure that all the required fields are correctly filled!</span>';
  }
    


?>	