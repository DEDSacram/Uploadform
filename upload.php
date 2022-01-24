<!DOCTYPE html>
<html>
<head>

<title>Nahravani Souboru</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
<div class="mb-3">
<form class="form-control" action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>
</div>

</body>
</html>
<?php



// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
$target_file = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if ($_FILES["fileToUpload"]["size"] > 8000000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

$video = in_array($imageFileType, array('mov','mp4','avi'));
$img = in_array($imageFileType, array('jpg','png'));
$audio = in_array($imageFileType, array('mp3','wav'));

if(!$video && !$img && !$audio){
  echo "These files are not allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";

} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    if($video){
      echo '<video width="320" height="240" controls>
      <source src='.$_FILES["fileToUpload"]["name"].' type="video/mp4">
      <source src='.$_FILES["fileToUpload"]["name"].' type="video/ogg">
    </video>';
    }
    else if ($audio){
      echo '<audio controls>
      <source src='.$_FILES["fileToUpload"]["name"].' type="audio/ogg">
      <source src='.$_FILES["fileToUpload"]["name"].' type="audio/mpeg">
    </audio>';
      
    }
    else if ($img){
      echo "<img class='img-rounded' src=" .$_FILES["fileToUpload"]["name"].">";
    }
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
}
?>