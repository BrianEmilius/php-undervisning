<header>
	<div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.html" class="navbar-brand">HIFI</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <nav class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li><a href="index.html">Forside</a></li>
			<?php
				$sql = "SELECT * FROM `kategori`";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo '<li><a href="index.php?p=products&id='.$row['id'].'">'.$row['navn'].'</a></li>';
					}
				}
			?>
        </nav>
      </div>
    </div>
</header>