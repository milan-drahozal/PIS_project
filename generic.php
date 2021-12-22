<!DOCTYPE HTML>
<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->

<html>
	<head>
		<title>Studijní výsledky</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	   <?php
			$spojeni = mysqli_connect("sql.endora.cz:3306", "2171159ecz", "Vzdelani3", "projekt01");
			if(!$spojeni) die("Nepodařilo se připojt k DB serveru: " . mysqli_connect_error());
			$dotaz = "SELECT * FROM studvysledky";
			$data = mysqli_query($spojeni, $dotaz);
			?>

             <?php 
              function cviceni($data){
                  $i = 0;
                  $doh = 0;
                  $nejlz = 5;
                  $nejhz = 1;
                  $prumer = 0;
                  echo '<table><tr>';
                     echo '<th>ID</th><th>Název předmětu</th><th>Datum zkoušky</th><th>Známka</th>';
                     
                     while($radek = mysqli_fetch_array($data, MYSQLI_ASSOC)){
                        echo "<tr><td>" . $radek["ID"] . "</td><td>" . $radek["Název předmětu"] . "</td><td>" . $radek["Datum zkoušky"] . "</td><td>" . $radek["Známka"] . "</td></tr>";
                        $i += 1;
                        $doh += $radek["Známka"];
                        for($p = 0; $p <= $i; $p++){
                         if($radek["Známka"] < $nejlz){
                             $nejlz = $radek["Známka"];
                         }
                        }
                        for($x = 0; $x <= $i; $x++){
                             if($radek["Známka"] > $nejhz){
                                $nejhz = $radek["Známka"];
                            }
                        }
                    }  
                  $prumer = $doh/$i;
            
                  echo '</tr></table>';
                  echo '<tr><table>';
                      echo "<tr><th>Nejhorší známka</th><td>$nejhz</td></tr>";
                      echo "<tr><th>Nejlepší známka</th><td>$nejlz</td></tr>";
                      echo "<tr><th>Studijní průměr</th><td>$prumer</td></tr>";
                  echo '</tr></table>';
                  }
 ?>
      
    
 

	<body class="is-preload">

		<!-- Header -->
			<header id="header">
				<a href="index.html" class="title">Osobní vizitka Milana Drahozala</a>
				<nav>
					<ul>
						<li><a href="index.html">Domů</a></li>
						<li><a href="generic.php" class="active">Studijní výsledky</a></li>
					</ul>
				</nav>
			</header>
		
       
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<section id="main" class="wrapper">
						<div class="inner">
							<h1 class="major">Tabulka s hodnocením</h1>
							
						</div>
					</section>
             
            </div>
            <?php cviceni($data) ?> 
            <div class="container">
                    <form action="" method="POST">
                        <label>Název předmětu</label>
                        <input type="text" name="predmet" placeholder="Zadejte název předmětu" />
                        
                        <label>Datum zkoušky</label>
                        <input type="text" name="datum" placeholder="Zadejte datum zkoušky" />
                        
                        <label>Známka</label>
                        <input type="text" name="znamka" placeholder="Zadejte známku ze zkoušky" /><br>
                        
                        <input type="submit" name="odeslat" value="Vložit předmět"/>
                    </form>
            
            </div>
            <?php
             if(isset($_POST["odeslat"])){
                $predmet = $_POST["predmet"];
                $datum = $_POST["datum"];
                $znamka = $_POST["znamka"];
                
                #INSERT INTO `studvysledky` (`ID`, `Název předmětu`, `Datum zkoušky`, `Známka`) VALUES ( '$predmet', '$datum', '$znamka');
               
            }
           

            ?>
            
         
		<!-- Footer -->
			<footer id="footer" class="wrapper alt">
				<div class="inner">
					<ul class="menu">
						<li>&copy; Oficiální vizitka Milana Drahozala</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
<?php mysqli_close($spojeni) ?>  

