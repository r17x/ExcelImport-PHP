<?php 
    require_once('src/excel.php');

    if ( isset($_FILES['excelfiles']) ){

        $excel = new ImportXL($_FILES['excelfiles']['tmp_name']);
        $c = count($excel->getData()); 
        echo $c; 
    }


?>
<html>
<body>
<form method="POST" enctype="multipart/form-data">

<input type="file" name="excelfiles" />

<input type="submit" value="Yeah">

</form>
</body>
</html> 
