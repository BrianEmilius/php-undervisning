<?php
if ($_POST) {
	$stmt = $conn->prepare("INSERT INTO produkter
	       (navn, beskrivelse, pris, fkKategoriId, fkModelId)
				 VALUES (?, ?, ?, ?, ?)");
	$stmt->bind_param('ssdii', $_POST['produktNavn'],
														 $_POST['produktBeskrivelse'],
														 $_POST['produktPris'],
														 $_POST['kategori'],
														 $_POST['model']);

	$stmt->execute();
	$stmt->close();
}
?>

<h1>Nyt produkt</h1>

<form action="admin.php?p=nytprodukt" method="post" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Form Name</legend>

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

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="Opret"></label>
  <div class="col-md-4">
    <button id="Opret" name="Opret" class="btn btn-success">Opret</button>
  </div>
</div>

</fieldset>
</form>
