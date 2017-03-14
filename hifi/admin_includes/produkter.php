<h1>Produkter</h1>
<a href="admin.php?p=nytprodukt" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i> Nyt produkt</a>

<div class="table-responsive">
	<table class="table table-striped">
		<thead>
			<th>Kategori</th>
			<th>Model</th>
			<th>Produktnavn</th>
			<th>Pris</th>
			<th></th>
		</thead>
		<tbody>
		<?php
		$result = $conn->query("SELECT produkter.id,
																	 produkter.navn,
																	 produkter.pris,
																	 kategori.navn AS katNavn,
																	 model.navn AS modNavn
														FROM produkter
														INNER JOIN kategori
															ON fkKategoriId = kategori.id
														INNER JOIN model
															ON fkModelId = model.id");
		while($row = $result->fetch_assoc()) {
			echo '<tr>
			       <td>'.$row['katNavn'].'</td>
						 <td>'.$row['modNavn'].'</td>
						 <td>'.$row['navn'].'</td>
						 <td>'.$row['pris'].'</td>
						 <td><a href="admin.php?p=redigerprodukt&id='.$row['id'].'"><i class="glyphicon glyphicon-pencil"></i></a></td>
						</tr>';
		}
		$result->free();
		?>
		</tbody>
	</table>
</div>