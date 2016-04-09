<?php
	if(isset($_POST['Reg']))
	{
		//if(!empty($_FILES['Image']) && ($_FILES['Image']['error'] == 0)) 
		if(isset($_FILES['image'])) 
		{
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."etov/";
			$filename = $_FILES['image']['name'];
			$path = $uploaddir.$filename;

			//Copy the file to some permanent location
			if(move_uploaded_file($_FILES['image']['tmp_name'], $path))
			{
				$Msg = "Success";
			}
		}
		else
			$Msg = "Error";
	}
	if(isset($Msg))
	{
		echo $Msg;	
	}
?>
<form action="<?php $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
	<input type="file" name="image" id="image" style="font-size:11px;"/>
    <input type="submit" name="Reg" value="Upload" />
</form>