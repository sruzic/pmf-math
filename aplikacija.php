<!DOCTYPE HTML>
<html>
    <head>
		<title> Aplikacija za računanje bodova za diplomski studij PMF-MO </title>
        <meta http-equiv="Content-Type" content="text/php; charset=UTF-8" />
        <link href="stil.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="./favicon.ico"/>

    </head>
    <body>
		<div class="kontejner">
			<div class="navigacija">
				<ul>
					<li> <a href="index.php"> Zimski </a></li>
					<li> <a href="ljetni.html">Ljetni </a></li>
					<li> <a href="uvjeti.html">Uvjeti </a></li>
					<li> <a class="ovdje" href="aplikacija.php"> Aplikacija </a></li>
					<li> <a href="kom_teorijska.html"> Diplomski </a></li>
					<li> <a href="linkovi.html"> Linkovi </a></li>
					<li> <a href="kontakt.html"> Kontakt </a></li>
				</ul>
			</div>
			<div class="sadrzaj">
					<form action="./stari.php">
						<fieldset class="zeleni" id="stari">
							<legend>Stari program (Mreže Računala obavezan)</legend>
							<input type="submit" class="button" value="Izračunaj">
						</fieldset>
					</form>

					<form action="./novi.php">
						<fieldset class="crveni" id="novi">
							<legend>Novi program (Teorija Brojeva obavezan)</legend>
							<input type="submit" class="button" value="Izračunaj">
						</fieldset>
					</form>
			</div>
				<?php
					 $hit_count = @file_get_contents('count.txt'); // read the hit count from file
					echo "<div class='vizita'> Izračuna: $hit_count</div>"; //  display the hit count
				?>
		</div>

</body>
</html>
