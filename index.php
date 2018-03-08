<?php 
    require_once('src/excel.php');

    if ( isset($_FILES['excelfiles']) ){

        $excel = new ImportXL($_FILES['excelfiles']['tmp_name']);
        $excel->saveFile();
        $c = count($excel->getData()); 
        echo sprintf("Total : %s" ,$c);
        foreach( $excel->getData() as $data) {
            printf($data);
            // db function here
        }
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
