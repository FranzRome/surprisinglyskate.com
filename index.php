<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="stile.css">
	</HEAD>

	<BODY>
		<?php
		include('connect.php');
		session_start();

		if(isset($_POST['ENTRA']))
		{

		   // in caso di ingresso da login
		   include('connect.php');


		  // recuperiamo usename e password
		  // utilizziamo una funzione di controllo
		  // per prevenire i tentativi di SQL Injection
		  $user=mysql_real_escape_string($_POST['USER']);
		  $pass=mysql_real_escape_string($_POST['PASS']);

		  // costruiamo e poi effettuiamo
		  // la query per identificare l'utente
		  $query="";
		  $query=$query."SELECT id,username,password FROM dati_accesso ";
		  $query=$query."WHERE username='".$user."' AND password='".$pass."' ";

		  //echo $query."<br>";

		  $risultato=mysql_query($query) or die($query);

		  // se nel recordset ottenuto
		  // esiste il record allora posso entrare
		  if(mysql_num_rows($risultato)>0)
		  {
			 while($array=mysql_fetch_array($risultato))
			 {
				$id=$array['id'];
				$username=$array['username'];
			 }

			 $_SESSION['id']=$id;
			 $_SESSION['username']=$username;
			 // aggiornamento conta e ultimo riferimento mysql tabella utenti

		  }
		}



		include("header.php");
		echo "<h1 style='color:white;'>Benvenuto utente : ". $_SESSION['username']."</h1>";
		?>

		<?php include("footer.php"); ?>
	</BODY>
</HTML>
