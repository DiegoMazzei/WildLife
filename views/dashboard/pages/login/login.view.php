<!DOCTYPE hmtl>
<html>
	<head>
		<title>Login</title>
		<meta charset="UTF-8">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="author" content="Roberto Savin">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="/wildlife/views/dashboard/styles/login.css">
		<script>
			
			function validaCampi()
			{	
				let username = document.forms["myform"]["username"].value;
				let password = document.forms["myform"]["password"].value;
						
				if(username === "")
				{
					alert("ERRORE: username non inserito");
					document.getElementById("username").style.outlineColor = "red";
					document.getElementById("username").focus();
					return false;
				}
				
				if(password === "")
				{
					alert("ERRORE: password non inserita");
					document.getElementById("password").style.outlineColor = "red";
					document.getElementById("password").focus();
					return false;
				}
			}
		</script>
		
		</head>
		<body>
			<h2>Login</h2>
			<form action="/wildlife/controllers/dashboard/login/controllologin.php" method="post" name="myform" onsubmit="return validaCampi()">
			<label for="username">Inserisci username</label><br>
			<input type="text" id="username" name="username" placeholder="username"><br><br>
			<label for="password">Inserisci password</label><br>
			<input type="password" id="password" name="password" placeholder="Password"><br><br>
			<input type="submit" value="Login">
			</form>
		</body>
	</html>
