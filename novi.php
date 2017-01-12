<?php
    if (isset($_POST['izracunaj'])){

    	$hit_count = @file_get_contents('count.txt'); // read the hit count from file
		$hit_count = $hit_count + 1; // increment the hit count by 1
        @file_put_contents('count.txt', $hit_count); // store the new hit count

        $rezultat = 0; // za broj bodova diplomskog
		$suma_ocjena = 0; // za prosjek
		$broj_ocjena = 0; // za prosjek

        switch ($_POST['smjer']){
            case "Računarstvo i matematika": $kR = 1; break;
            case "Primijenjena matematika": $kR = 0.8; break;
            default: $kR = 0.5;
        }

        switch ($_POST['izborni1']){
            case "Fizika 1": if ($_POST['smjer']=="Financijska i poslovna matematika"){$k[0] = 0.5; break;} else {$k[0] = 0.4; break;}
            case "Građa računala": $k[0] = $kR; break;
            default: $k[0] = 1;
        }

        switch ($_POST['izborni2']){
            case "Fizika 2": if ($_POST['smjer']=="Financijska i poslovna matematika"){$k[1] = 0.5; break;} else {$k[1] = 0.4; break;}
            default: $k[1] = 1;
        }

        if ($_POST['izborni3'] == "Objektno programiranje (C++)" || $_POST['izborni3'] == "Mreže računala")
            $k[2] = $kR;
        else
            $k[2] = 1;

        if ($_POST['izborni4'] == "Objektno programiranje (C++)" || $_POST['izborni4'] == "Mreže računala")
            $k[3] = $kR;
        else
            $k[3] = 1;


        /* matematicki kolegiji  koef = 1 */

        $m5 = $_POST['mat5'];
        for ($i=0; $i<count($m5); $i++){
            $rezultat += 5*$m5[$i];
			$suma_ocjena += $m5[$i];
			if ($m5[$i]>=2) $broj_ocjena += 1;
        }

        $m6 = $_POST['mat6'];
        for ($i=0; $i<count($m6); $i++){
            $rezultat += 6*$m6[$i];
			$suma_ocjena += $m6[$i];
			if ($m6[$i]>=2) $broj_ocjena += 1;
        }

        $m7 = $_POST['mat7'];
        for ($i=0; $i<count($m7); $i++){
            $rezultat += 7*$m7[$i];
			$suma_ocjena += $m7[$i];
			if ($m7[$i]>=2) $broj_ocjena += 1;
        }

        $m8 = $_POST['mat8'];
        for ($i=0; $i<count($m8); $i++){
            $rezultat += 8*$m8[$i];
			$suma_ocjena += $m8[$i];
			if ($m8[$i]>=2) $broj_ocjena += 1;
        }

        $m9 = $_POST['mat9'];
        for ($i=0; $i<count($m9); $i++){
            $rezultat += 9*$m9[$i];
			$suma_ocjena += $m9[$i];
			if ($m9[$i]>=2) $broj_ocjena += 1;
        }

        /* racunarski kolegiji koef = kR */

        $r4 = $_POST['rac4'];
        for ($i=0; $i<count($r4); $i++){
            $rezultat += 4*$r4[$i]*$kR;
			$suma_ocjena += $r4[$i];
			if ($r4[$i]>=2) $broj_ocjena += 1;
        }

        /* $r5 = $_POST['rac5'];
        for ($i=0; $i<count($r5); $i++){
            $rezultat += 5*$r5[$i]*$kR;
			$suma_ocjena += $r5[$i];
			if ($r5[$i]>=2) $broj_ocjena += 1;
        } */

        $r6 = $_POST['rac6'];
        for ($i=0; $i<count($r6); $i++){
            $rezultat += 6*$r6[$i]*$kR;
			$suma_ocjena += $r6[$i];
			if ($r6[$i]>=2) $broj_ocjena += 1;
        }

        /* strucni (tj. ostali) kolegiji koef = 0.4 */

        $s2 = $_POST['str2'];
	 if ($_POST['smjer']=="Financijska i poslovna matematika") $kS = 0.5; else $kS = 0.4;
        for ($i=0; $i<count($s2); $i++){
            $rezultat += 2*$s2[$i]*$kS;
			$suma_ocjena += $s2[$i];
			if ($s2[$i]>=2) $broj_ocjena += 1;
        }

        /* izborni kolegiji koef = k[] */

        $i5 = $_POST['izb5'];
        for ($i=0; $i<count($i5); $i++){
            $rezultat += 5*$i5[$i]*$k[$i];
			$suma_ocjena += $i5[$i];
			if ($i5[$i]>=2) $broj_ocjena += 1;
        }

        $rezultat = round($rezultat);

        /* dodatni bodovi */

        $dodatni = 0;

        $dodatni += 25 * $_POST['nagrada'];
        $dodatni += 15 * $_POST['radovi'];
        $dodatni += 10 * $_POST['natjecanja'];
        $dodatni += 5 * $_POST['demonstrature'];
        $dodatni += 5 * $_POST['mentorstva'];
        if(isset($_POST['u_roku']) && $_POST['u_roku'] == 'u_roku') $dodatni += 10;

        if ($dodatni > 30) $dodatni = 30;

        $rezultat += $dodatni;

		/* prosjek ocjena */

		$prosjek = round($suma_ocjena / $broj_ocjena, 3);
    }
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/php; charset=UTF-8" />
        <link href="stil.css" rel="stylesheet" type="text/css" />
		<title>Novi program</title>
		<link rel="shortcut icon" href="./favicon.ico"/>

    </head>
    <body> <div class="kontejner">
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
			<div class="sadrzaj bodovi">
				 <?php if (isset($rezultat))
						echo "<form id='broj_bod'>
						<fieldset class='sivi' style='font-size: 25px' >
							<legend>Broj bodova za diplomski</legend>
								<b style='padding-left: 10px'>$rezultat</b>
						 </fieldset>
						 </form>
						 <form id='prosjek'>
						 <fieldset class='sivi' style='font-size: 25px' >
							<legend>Prosjek ocjena</legend>
								<b style='padding-left: 10px'>$prosjek</b>
						 </fieldset>
					</form><br> "; ?>

        <form method="post">
            <fieldset class="zeleni" id="fieldset1">
                <legend>1. godina</legend>

                <label for="">Matematička analiza 1</label> <input type="number" name="mat8[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m8[0]}'" ?>/><br>
                <label for="">Linearna algebra 1</label> <input type="number" name="mat8[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m8[1]}'" ?>/><br>
                <label for="">Elementarna matematika 1</label> <input type="number" name="mat8[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m8[2]}'" ?>/><br>
                <label for="">Programiranje 1</label> <input type="number" name="rac6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$r6[0]}'" ?>/><br>

                <hr/>

                <label for="">Matematička analiza 2</label> <input type="number" name="mat9[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m9[0]}'" ?>/><br>
                <label for="">Linearna algebra 2</label> <input type="number" name="mat9[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m9[1]}'" ?>/><br>
                <label for="">Elementarna matematika 2</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[0]}'" ?>/><br>
                <label for="">Programiranje 2</label> <input type="number" name="rac6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$r6[1]}'" ?>/><br>

            </fieldset>


            <fieldset class="crveni" id="fieldset2">
                <legend>2. godina</legend>

                <label for="">Diferencijalni račun funkcija više varijabli</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[1]}'" ?>/><br>
                <label for="">Diskretna matematika</label> <input type="number" name="mat5[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m5[0]}'" ?>/><br>
                <label for="">Vjerojatnost</label> <input type="number" name="mat7[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m7[0]}'" ?>/><br>
                <label for="">Strukture podataka i algoritmi</label> <input type="number" name="mat5[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m5[1]}'" ?>/><br>
                <label for="">Engleski jezik dtruke 1</label> <input type="number" name="str2[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$s2[0]}'" ?>/><br>

                <hr/>

                <label for="">Integrali funkcija više varijabli</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[2]}'" ?>/><br>
                <label for="">Teorija brojeva</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[3]}'" ?>/><br>
                <label for="">Numerička matematika</label> <input type="number" name="mat7[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m7[1]}'" ?>/><br>
                <label for="">Računarski praktikum 1</label> <input type="number" name="rac4[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$r4[0]}'" ?>/><br>
                <label for="">Engleski jezik struke 2</label> <input type="number" name="str2[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$s2[1]}'" ?>/><br>

                <hr/>

                <select class="selekt" name="izborni1">
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni1']=="Fizika 1") echo "selected='selected'" ?> >Fizika 1</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni1']=="Matematičko modeliranje u biologiji") echo "selected='selected'" ?> >Matematičko modeliranje u biologiji</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni1']=="Građa računala") echo "selected='selected'" ?> >Građa računala</option>
                </select>
                <input type="number" name="izb5[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$i5[0]}'" ?>/><br>

                <select class="selekt" name="izborni2">
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni2']=="Fizika 2") echo "selected='selected'" ?> >Fizika 2</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni2']=="Bioinformatika") echo "selected='selected'" ?> >Bioinformatika</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni2']=="Baze podataka") echo "selected='selected'" ?> >Baze podataka</option>
                </select>
                <input type="number" name="izb5[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$i5[1]}'" ?>/><br>

            </fieldset>


            <fieldset class="plavi" id="fieldset3">
                <legend>3. godina</legend>

                <label for="">Algebarske strukture</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[4]}'" ?>/><br>
                <label for="">Obične diferencijalne jednadžbe</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[5]}'" ?>/><br>
                <label for="">Vektorski prostori</label> <input type="number" name="mat7[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m7[2]}'" ?>/><br>
                <label for="">Teorija skupova</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[6]}'" ?>/><br>

                <hr/>

                <label for="">Kompleksna analiza</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[7]}'" ?>/><br>
                <label for="">Statistika</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[8]}'" ?>/><br>
                <label for="">Metode matematičke fizike</label> <input type="number" name="mat7[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m7[3]}'" ?>/><br>
                <label for="">Mjera i integral</label> <input type="number" name="mat6[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$m6[9]}'" ?>/><br>

                <hr/>

                <select class="selekt" name="izborni3">
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Matematička logika") echo "selected='selected'" ?> >Matematička logika</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Iterativne metode") echo "selected='selected'" ?> >Iterativne metode</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Markovljevi lanci") echo "selected='selected'" ?> >Markovljevi lanci</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Euklidski prostori") echo "selected='selected'" ?> >Euklidski prostori</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Mreže računala") echo "selected='selected'" ?> >Mreže računala</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Fourierovi redovi i primjene") echo "selected='selected'" ?> >Fourierovi redovi i primjene</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Modeli geometrije") echo "selected='selected'" ?> >Modeli geometrije</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Uvod u diferencijalnu geometriju") echo "selected='selected'" ?> >Uvod u diferencijalnu geometriju</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Odabrane primjene vjerojatnosti i statistike") echo "selected='selected'" ?> >Odabrane primjene vjerojatnosti i statistike</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Objektno programiranje (C++)") echo "selected='selected'" ?> >Objektno programiranje (C++)</option>
                </select>
                <input type="number" name="izb5[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$i5[2]}'" ?>/><br>

                <select class="selekt" name="izborni4">
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Matematička logika") echo "selected='selected'" ?> >Matematička logika</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Iterativne metode") echo "selected='selected'" ?> >Iterativne metode</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Markovljevi lanci") echo "selected='selected'" ?> >Markovljevi lanci</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Euklidski prostori") echo "selected='selected'" ?> >Euklidski prostori</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni3']=="Mreže računala") echo "selected='selected'" ?> >Mreže računala</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Fourierovi redovi i primjene") echo "selected='selected'" ?> >Fourierovi redovi i primjene</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Modeli geometrije") echo "selected='selected'" ?> >Modeli geometrije</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Uvod u diferencijalnu geometriju") echo "selected='selected'" ?> >Uvod u diferencijalnu geometriju</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Odabrane primjene vjerojatnosti i statistike") echo "selected='selected'" ?> >Odabrane primjene vjerojatnosti i statistike</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['izborni4']=="Objektno programiranje (C++)") echo "selected='selected'" ?> >Objektno programiranje (C++)</option>
                </select>
                <input type="number" name="izb5[]" min="2" max="5" <?php if (isset($_POST['izracunaj'])) echo "value='{$i5[3]}'" ?>/><br>

            </fieldset>


            <fieldset class="zuti" id="fieldset4">
                <legend>Dodatni bodovi</legend>

                <label for="">Nagrade (rektorova, ...) </label> <input type="number" min="0" max="6" name="nagrada" <?php if (isset($_POST['izracunaj'])) echo "value='{$_POST['nagrada']}'"?> /> <br>
                <label for="">Objavljeni stručni i znanstveni radovi </label> <input type="number"  min="0" max="6" name="radovi"<?php if (isset($_POST['izracunaj'])) echo "value='{$_POST['radovi']}'"?>/> <br>
                <label for="">Sudjelovanja na studentskim natjecanjima </label> <input type="number"  min="0" max="6" name="natjecanja" <?php if (isset($_POST['izracunaj'])) echo "value='{$_POST['natjecanja']}'"?> /> <br>
                <label for="">Status demonstratora (za svaki semestar) </label> <input type="number"  min="0" max="6" name="demonstrature" <?php if (isset($_POST['izracunaj'])) echo "value='{$_POST['demonstrature']}'"?> /><br>
                <label for="">Mentorstva učenicima (za svaku školsku godinu) </label> <input type="number"  min="0" max="6" name="mentorstva" <?php if (isset($_POST['izracunaj'])) echo "value='{$_POST['mentorstva']}'"?>/><br>
                <label for="">Preddiplomski završen u roku </label><input type="checkbox" name="u_roku" value="u_roku" <?php if (isset($_POST['izracunaj']) && isset($_POST['u_roku']) && $_POST['u_roku'] == 'u_roku') echo "checked='yes'" ?>/>
            </fieldset>

            <br>

            <fieldset class="sivi" id="fieldset5">
                <legend>Smjer</legend>

                <select class="selekt" name="smjer">
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['smjer']=="Teorijska matematika") echo "selected='selected'" ?> >Teorijska matematika</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['smjer']=="Primijenjena matematika") echo "selected='selected'" ?> >Primijenjena matematika</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['smjer']=="Matematička statistika") echo "selected='selected'" ?> >Matematička statistika</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['smjer']=="Računarstvo i matematika") echo "selected='selected'" ?> >Računarstvo i matematika</option>
                    <option <?php if (isset($_POST['izracunaj']) && $_POST['smjer']=="Financijska i poslovna matematika") echo "selected='selected'" ?> >Financijska i poslovna matematika</option>
                </select>

            </fieldset>

            <input class="button" id="fieldset6" type="submit" name="izracunaj" value="Izračunaj" />
        </form>
		</div>
    </div></body>
</html>
