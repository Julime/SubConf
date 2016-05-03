<?php
//manage the image upload for coupons in addGutschein.php
if (!file_exists("../img/Gutscheine")) { //check if path exists
    mkdir("../img/Gutscheine"); //creat path
}
//output important data for debug
var_dump($_FILES);
//set variables
$userfile = $_FILES['userfile']['tmp_name'];
$userfile_name = $_FILES['userfile']['name'];
$userfile_size = $_FILES['userfile']['size'];
$userfile_type = $_FILES['userfile']['type'];
$userfile_error = $_FILES['userfile']['error'];
$allowedExtensions = array("image/jpg","image/jpeg","image/png");

$length=count($_FILES["userfile"]["name"]);

for($i=0;$i<$length;$i++) {

    if($userfile_error[$i]>0){ //check for errors
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

    if ($userfile=='none'){ //check if a file got uploaded
        echo 'No file uploaded';
        exit;
    }

    if ($userfile_size[$i]==0){ //check the size of the file
        echo ' Problem : Uploaded file size is zero';
        exit;
    }

    if (!in_array($userfile_type[$i],$allowedExtensions)){ //check if the file type is an image
        echo 'File type is not an Image '.$userfile_type;
        exit;
    }

    $upfile = $_SERVER['DOCUMENT_ROOT']."/img/Gutscheine/".$userfile_name[$i]; //set the path to the image

    if (is_uploaded_file($userfile[$i])){ //check if you got the right file 
        if(!move_uploaded_file($_FILES["userfile"]["tmp_name"][$i],$upfile)){ //move file to the set directory
            echo 'Could not move uploaded file';
            exit;
        }
    }
    else {
        echo 'Possible File Attack';
        exit;
    }
    echo 'File Uploaded Successfuly<br />'; //give success message

}
?>
