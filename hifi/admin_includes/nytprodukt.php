<?php
if ($_POST) {
  $target_dir = "img/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if($check !== false) {
          echo "File is an image - " . $check["mime"] . ".";
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
  }
  // Check if file already exists
  if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
          $fileName = basename( $_FILES["fileToUpload"]["name"]);
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
  $stmt = $conn->prepare("INSERT INTO produkter
	       (navn, beskrivelse, pris, fkKategoriId, fkModelId, billede)
				 VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param('ssdiis', $_POST['produktNavn'],
														 $_POST['produktBeskrivelse'],
														 $_POST['produktPris'],
														 $_POST['kategori'],
														 $_POST['model'],
                             $fileName);

	$stmt->execute();
	$stmt->close();
}
?>

<h1>Nyt produkt</h1>

<form action="admin.php?p=nytprodukt" method="post" class="form-horizontal" enctype="multipart/form-data">

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Kategori">Kategori</label>
  <div class="col-md-4">
    <select id="Kategori" name="kategori" class="form-control">
			<?php
			$result = $conn->query("SELECT id, navn FROM kategori");
			while ($row = $result->fetch_assoc()) {
				echo '<option value="'.$row['id'].'">'.$row['navn'].'</option>'.PHP_EOL;
			}
			?>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="model">Model</label>
  <div class="col-md-4">
    <select id="model" name="model" class="form-control">
			<?php
			$result = $conn->query("SELECT id, navn FROM model");
			while ($row = $result->fetch_assoc()) {
				echo '<option value="'.$row['id'].'">'.$row['navn'].'</option>'.PHP_EOL;
			}
			?>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="produktNavn">Produktnavn</label>  
  <div class="col-md-4">
  <input id="produktNavn" name="produktNavn" placeholder="Produktnavn" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="produktBeskrivelse">Produktbeskrivelse</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="produktBeskrivelse" name="produktBeskrivelse"></textarea>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="produktPris">Produktpris</label>  
  <div class="col-md-4">
  <input id="produktPris" name="produktPris" placeholder="Produktpris" class="form-control input-md" required="" type="text">
    
  </div>
</div>

<div class="form-group">
  <label for="produktBillede" class="col-md-4 control-label">Produktbillede</label>
  <div class="col-md-4">
  <input type="file" name="fileToUpload" id="produktBillede">
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Opret"></label>
  <div class="col-md-4">
    <button id="Opret" name="Opret" class="btn btn-success">Opret</button>
  </div>
</div>
</form>
