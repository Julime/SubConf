<?php
var_dump($_FILES);
$userfile = $_FILES['userfile']['tmp_name'];
$userfile_name = $_FILES['userfile']['name'];
$userfile_size = $_FILES['userfile']['size'];
$userfile_type = $_FILES['userfile']['type'];
$userfile_error = $_FILES['userfile']['error'];
$allowedExtensions = array("image/jpg","image/jpeg","image/png");

$length=count($_FILES["userfile"]["name"]);

for($i=0;$i<$length;$i++) {

    if($userfile_error[$i]>0){
        echo 'Problem mit file '.$i.' : ';
        switch ($userfile_error[$i])
        {
            case 1: echo 'File exceeded upload_max_filesize'; break;
            case 2: echo 'File exceeded max_File_size'; break;
            case 3: echo 'File only partially uploaded'; break;
            case 4: echo 'No file uploaded'; break;
        }
        exit;
    }

    if ($userfile=='none'){
        echo 'No file uploaded';
        exit;
    }

    if ($userfile_size[$i]==0){
        echo ' Problem : Uploaded file size is zero';
        exit;
    }

    if (!in_array($userfile_type[$i],$allowedExtensions)){
        echo 'File type is not an Image '.$userfile_type;
        exit;
    }

    $upfile = $_SERVER['DOCUMENT_ROOT']."\img\Gutscheine\\".$userfile_name[$i];

    if (is_uploaded_file($userfile[$i])){
        if(!move_uploaded_file($_FILES["userfile"]["tmp_name"][$i],$upfile)){
            echo 'Could not move uploaded file';
            exit;
        }
    }
    else {
        echo 'Possible File Attack';
        exit;
    }
    echo 'File Uploaded Successfuly<br />';

}
?>
