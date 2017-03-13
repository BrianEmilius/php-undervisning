<?php
	if(isset($_GET['id']) && is_numeric($_GET['id'])){
		$id = $_GET['id'];
	} else {
		//404
		header('Location: index.php?p=home');
	}
?>
<section class="container heading">
	<article class="row">
		<section class="col-lg-12">
			<?php
				$sql = "SELECT * FROM `kategori` WHERE id = $id";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					$row = $result->fetch_assoc();
					echo '<h3>'.$row['navn'].'</h3>';
				}
			?>
		</section>
	</article>
	<hr class="featurette-divider">
	<article class="row">
		<?php
			$sql = "SELECT `produkter`.`id`, `produkter`.`navn`, `beskrivelse`, `pris`, `billede`, `model`.`navn` AS model FROM `produkter`
					INNER JOIN model ON fkModelId = model.id
					WHERE fkKategoriId = $id";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()){
					echo '<section class="col-md-12">
							<figure>
								<a href="#" class="thumbnail">
								<figcaption>
									<h3 class="title">'.$row['model'].' - <span class="text-muted">'.$row['navn'].'</span></h3>
									<p>';
								echo strlen($row['beskrivelse']) >= 150 ? substr($row['beskrivelse'], 0, 150) : $row['beskrivelse'];
								echo '</p>
									<var><abbr title="DKK">Pris:</abbr> '.$row['pris'].' kr</var>
								</figcaption>
									<img src="prod_image/cd_afspillere/'.$row['billede'].'" alt="...">
								</a>
							</figure>
						</section>';
				}
			}
		?>
	</article>
	<hr class="featurette-divider">
	<footer>
		<p>© Hi-fi Netbutikken
		</p>
	</footer>

</section>