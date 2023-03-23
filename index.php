<!doctype html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Connectez-vous !</title>
		<link href="style.css" rel="stylesheet">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
	</head> 
	
	<body class="index">
		
		<section class="vh-100">
			<div class="container py-5 h-100">
			<div class="row d-flex justify-content-center align-items-center h-100">
				<div class="col-12 col-md-8 col-lg-6 col-xl-5">
				<div class="card shadow-2-strong" style="border-radius: 1rem;">
					<div class="card-body p-5 text-center">
						
					
						<div class="mb-5">
							<h1 >Connexion</h1>
							<p style="font-size:smaller; color: rgb(103, 103, 103);" >Veuillez vous connecter pour accéder à Epoka Mission</p>
						</div>
					
						<form action="connexion.php" method="POST">
							<div class="form-outline mb-4">
								<label class="form-label" for="idCo" style="font-size:smaller; color: rgb(103, 103, 103);">Matricule</label>
								<input type="text" name="login" style="margin-right:10px"class="form-control"  aria-label="Matricule" aria-describedby="basic-addon1">
							</div>
				
							<div class="form-outline mb-4">
								<label class="form-label" for="password" style="font-size:smaller; color: rgb(103, 103, 103);">Mot de passe</label>
								<input type="password" name="motdepasse" style="margin-right:10px"class="form-control"  aria-label="Matricule" aria-describedby="mdp">
							</div>

							<button type="submit" class="btn btn-secondary btn-block m-3">Valider</button>
					
						</form>
					

			
					</div>
				</div>
				</div>
			</div>
			</div>
		</section>
	</body>
</html>