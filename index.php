<?php

$root = $_SERVER['DOCUMENT_ROOT']; 
$path = $root . '/wildlife/database.php';
include $path;

// Query per sapere il numero di animali salvati
$query = "SELECT COUNT(*) AS n_salvati FROM scheda_arrivo JOIN esito ON Cod_Esito_Finale = Codice_Esito WHERE Descrizione = 'Rilasciato';";
$result = $connection -> query($query);

$numAnimaliSalvati = 0;
if ($result && $result -> num_rows > 0) {
	$numAnimaliSalvati = $result -> fetch_assoc();
}

// Query per la lista di centri
$query = "SELECT Denominazione, Comune, SiglaPR, Indirizzo FROM anagrafica_centro AS a JOIN regprovcomune AS rpc ON a.Codice_Comune = rpc.Codice_Comune";
$result = $connection -> query($query);

$centri = [];
if ($result && $result -> num_rows > 0) {
	   $centri = $result -> fetch_all(MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Wildlife </title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="img/favicon.png">
	<!-- Web Font -->
    <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,600,700&display=swap" rel="stylesheet">
	
	<!-- icons library -->
    <link href="https://cdn.lineicons.com/1.0.1/LineIcons.min.css" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="css/magnific-popup.min.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/LineIcons.css">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="css/owl-carousel.css">
	<!-- Slicknav -->
    <link rel="stylesheet" href="css/slicknav.min.css">
	<!-- Animat -->
    <link rel="stylesheet" href="css/animate.css">
	
	<!-- Appkit StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
	
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/color/color1.css">
	<!--<link rel="stylesheet" href="css/color/color2.css">-->
	<!--<link rel="stylesheet" href="css/color/color3.css">-->
	<!--<link rel="stylesheet" href="css/color/color4.css">-->

	<link rel="stylesheet" href="#" id="colors">
	
</head>
<body class="js">
	<!-- Header Area -->
	<header id="site-header" class="site-header">
		<!-- Header Bottom -->
		<div class="header-bottom">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="#"><img src="img/Logo/wildlife-logo.png" alt="#"></a>
						</div>
						<!-- End Logo -->
						<div class="mobile-nav"></div>
					</div>
					<div class="col-lg-10 col-md-10 col-12">
						<!-- Main Menu -->
						<div class="main-menu">
							<nav class="navigation ">
								<ul class="nav menu">
									<li class="active"><a href="home">Home</a></li>
									<li><a href="#chi-siamo">Chi Siamo</a></li>
									<li><a href="#cosa-facciamo">Cosa Facciamo</a></li>
									<li><a href="#recensioni">Recensioni</a></li>
									<li><a href="#team">Il Nostro Team</a></li>
									<li><a href="#faq">Faq</a></li>
									<li><a href="#contatti">Contatti</a></li>
								</ul>
							</nav>
						</div>
						<!--/ End Main Menu -->
						<a href="/wildlife/controllers/dashboard/login/login.php" class="button">Area Lavoratori</a>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Bottom -->
    </header>
	<!--/ End Header Area -->
	
	<!--Hero header start-->
    <section class="hero-header primary-header slider-header" id="home">
        <div class="container">
			<div class="row">
				<div class="col-lg-5 col-12">
					<div class="hero-header-content">
					    <p>Gli animali vanno tutelati</p>
					    <h1>Aiutaci a salvare gli <b>animali</b></h1>
					    <p>
						  La nostra missione è salvaguardare la fauna del territorio italiano, ma ci serve il tuo aiuto! Se hai trovato un animale selvatico, <b>portalo in sede</b>
					    </p>
					    <div class="button">
							<a href="#contatti" class="btn primary">SOS Salva Animale</a>
					    </div>
					</div>
				</div>
				<div class="col-lg-7 col-12">
					<div class="hero-header-image">
					   <img src="img/nurse/nurse2.png" alt="#">
					</div>
				</div>
			</div>
        </div>
    </section>
    <!--Hero header end-->
	
	<!-- Start Area Chi Siamo -->
	<section id="chi-siamo" class="work section" >
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Chi Siamo</h2>
						<p>Wildlife opera sul territorio italiano per la salvaguardia della fauna</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-work">
						<div class="serial">
							<span><i class="fa-solid fa-house"></i></span>
						</div>
						<h3>Un rifugio per gli animali</h3>
						<p>Accogliamo e accudiamo gli animali.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-work">
						<div class="serial">
							<span><i class="fa-solid fa-hippo"></i></span>
						</div>
						<h3>Animali selvatici</h3>
						<p>Siamo specializzati nella salvaguardia di animali selvatici.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-work last">
						<div class="serial">
							<span><i class="fa-solid fa-user-nurse"></i></span>
						</div>
						<h3>Personale</h3>
						<p>Abbiamo personale specializzato al tuo servizio.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-work last">
						<div class="serial">
							<span><i class="fa-solid fa-clock-rotate-left"></i></span>
						</div>
						<h3>Anno di fondazione</h3>
						<p>La nostra attività è stata fondata da Walter Bianchi e Jessie uomo rosa nel 1980.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /End Area Chi Siamo -->
	
	<!-- Start Services Area -->
    <section class="services-area section" id="cosa-facciamo">
        <div class="container">
			<div class="row">
				<div class="col-lg-7 col-12">
					<div class="info-media right">
					   <img src="img/Animals/fox2.png" alt="Fox">
					</div>
				</div>
				<div class="col-lg-5 col-12">
					<div class="info-text">
					   <p class="short-title">Cosa facciamo?</p>
					   <h2 class="main-title">Vieni a scoprirlo!</h2>
					   <p class="des">
					   <div class="button">
						  <a href="https://www.youtube.com/watch?v=81RglnJff-s" class="btn video-popup mfp-iframe">Passa alla visione <i class="lni-play"></i></a>
					   </div>
					</div>
				</div>
			</div>
        </div>
    </section>
    <!-- End Services Area -->
	
	<!-- Start Counter Section-->
	<section class="product-counter-section">
		<div class="product-counter-wrap">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-12">
						<div class="counter-content-wrap">
							<i class="lni lni-rocket"></i>
							<h6 class="counter-title"><strong>Fidati della nostra esperienza</strong></h6>
							<p class="counter-text">e della nostra professionalità</p>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<ul class="counter-list list-inline text-right">
							<li>
								<!-- INTERAZIONE DB -->
								<span class="number count"> <?= $numAnimaliSalvati['n_salvati'] ?></span>
								<span class="title">Animali Salvati</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /End Counter Section-->
		
	<!-- Start Testimonials Section -->
	<section id="recensioni" class="section testimonials">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Recensioni</h2>
						<p>Questo è quello che pensano di noi i nostri clienti. Ti puoi fidare! </p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<div class="testimonial-slider owl-carousel">
						<!-- Single Testimonial -->
						<div class="single-testimonial">
							<p>"Avevo veramente bisogno di aiuto, avevo trovato uno scoiattolo in fin di vita e non sapevo cosa fare ma, per fortuna, il personale preparato ed efficiente di Wildlife mi ha saputo aiutare. Grazie!" </p>
							<div class="bottom">
								<img src="img/testi1.jpg" alt="#">
								<h4 class="name">Karmo kerin<span>CEO - Apptech</span></h4>
							</div>
						</div>
						<!--/ End Single Testimonial -->
						<!-- Single Testimonial -->
						<div class="single-testimonial">
							<p>" Durante una delle mie guide verso il lavoro, avevo notato un pettirosso in pessime condizioni sul bordo della strada, probabilmente non gli rimaneva molto. Non sono riuscita a restare indifferente e subito mi sono mobilitata per aiutarlo. L'ho preso con me e l'ho portato da Wildlife. Ora si è ripreso ed è pronto per ricominciare a vivere. Wildlife da quel giorno è una garanzia. Ancora grazie mille!" </p>
							<div class="bottom">
								<img src="img/testi2.jpg" alt="#">
								<h4 class="name">Jhon Dimo<span>CEO - Dream app</span></h4>
							</div>
						</div>
						<!--/ End Single Testimonial -->
						<!-- Single Testimonial -->
						<!--/ End Single Testimonial -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /End Testimonials Section -->
		
	<!-- Start Team -->
	<section id="team" class="team section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-title">
						<h2>Il nostro magnifico team</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Single Team -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-team">
						<!-- Image -->
						<div class="image">
							<img src="img/team/team1.jpg" alt="#">
						</div>
						<!-- End Image -->
						<div class="info-head">
							<!-- Info Box -->
							<div class="info-box">
								<h4 class="name"><a href="#">Anna Bianchi</a></h4>
								<span class="designation">CEO</span>
							</div>
							<!-- End Info Box -->
							<!-- Social -->
							<div class="social-links">
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Social -->
						</div>
					</div>
				</div>	
				<!-- End Single Team -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-team">
						<!-- Image -->
						<div class="image">
							<img src="img/team/team2.jpg" alt="#">
						</div>
						<!-- End Image -->
						<div class="info-head">
							<!-- Info Box -->
							<div class="info-box">
								<h4 class="name"><a href="#">Alessandro Neri</a></h4>
								<span class="designation">CFO</span>
							</div>
							<!-- End Info Box -->
							<!-- Social -->
							<div class="social-links">
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Social -->
						</div>
					</div>
				</div>	
				<!-- End Single Team -->
				<div class="col-lg-3 col-md-6 col-12">
					<div class="single-team">
						<!-- Image -->
						<div class="image">
							<img src="img/team/team3.jpg" alt="#">
						</div>
						<!-- End Image -->
						<div class="info-head">
							<!-- Info Box -->
							<div class="info-box">
								<h4 class="name"><a href="#">Alessia Verdi</a></h4>
								<span class="designation">Finanziatore</span>
							</div>
							<!-- End Info Box -->
							<!-- Social -->
							<div class="social-links">
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Social -->
						</div>
					</div>
				</div>	
				<!-- End Single Team -->
                                <div class="col-lg-3 col-md-6 col-12">
					<div class="single-team">
						<!-- Image -->
						<div class="image">
							<img src="img/team/team4.jpg" alt="#">
						</div>
						<!-- End Image -->
						<div class="info-head">
							<!-- Info Box -->
							<div class="info-box">
								<h4 class="name"><a href="#">Mario Rossi</a></h4>
								<span class="designation">Veterinario</span>
							</div>
							<!-- End Info Box -->
							<!-- Social -->
							<div class="social-links">
								<ul class="social">
									<li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter"></i></a></li>
									<li><a href="#"><i class="fa fa-behance"></i></a></li>
									<li><a href="#"><i class="fa fa-instagram"></i></a></li>
								</ul>
							</div>
							<!-- End Social -->
						</div>
					</div>
				</div>	

			</div>	
		</div>
	</section>
	<!--/ End Team Area -->
	
	<!--Frequently asked questions start-->
    <section id="faq" class="faq-section section">
         <div class="container">
			<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Faq</h2>
						</div>
					</div>
				</div>
			<div class="row">
				<div class="col-12">
					<div id="accordion" class="mt-4 faq-container">
						<div class="simple-card">
						   <div class="card-header" id="headingOne">
							  <h5 class="mb-0">
								 <button class=" btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
								 <span class="arrow-container"></span> Come soccorrere un animale?
								 </button>
							  </h5>
						   </div>
						   <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
							  <div class="card-body">
								 <p> Per prima cosa, dopo aver recuperato l'animale, portalo il prima possibile in una delle nostre sedi, lì un personale specializzato ti saprà aiutare al meglio nelle tue problematiche.</p>
							  </div>
						   </div>
						</div>
						<div class="simple-card">
						   <div class="card-header" id="headingTwo">
							  <h5 class="mb-0">
								 <button class=" btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
								 <span class="arrow-container"></span> Quali sono i vostri numeri verdi?
								 </button>
							  </h5>
						   </div>
						   <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
							  <div class="card-body card-with-button">
								 <p> Il nostro principale numero verde è 3345678650.</p>
						</div>
					</div>
				</div>
			</div>
         </div>
    </section>
    <!--Frequently asked questions end-->
	
	<!--Get Started start-->
    <section id="contatti" class="get-started section">
        <div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 col-12">
					<div class="inner-content">
						 <p class="small-title">Salva un animale</p>
						 <h1 class="main-title">Come portare un animale in sede</h1>
						 <p class="des">Puoi vedere tutte le nostre sedi sulla cartina qui di seguito.</p>
						 <iframe src="https://www.google.com/maps/d/embed?mid=1YeZtIXWGDaZVEXAai7crTertXJEOZ0k&ehbc=2E312F&noprof=1" width="640" height="480"></iframe>

							<br>
							<br>
							<ul class="text-white">
								<?php
								foreach ($centri as $centro) {
									echo "<li>{$centro['Denominazione']}, {$centro['Comune']}, {$centro['SiglaPR']}, {$centro['Indirizzo']}</li>";
								}
								?>
							</ul>

					</div>
				</div>
			</div>
        </div>
    </section>
    <!--Get Started end-->
	
	<!-- Start Newsletter Area -->
    <section class="newsletter section">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6  col-12">
					<!-- Start Newsletter Form -->
                    <div class="subscribe-text ">
						<h6>Registrati alla nostra newsletter</h6>
						<p class="">Per conoscerci meglio <br></p>
                    </div>
					<!-- End Newsletter Form -->
                </div>
                <div class="col-lg-6  col-12">
					<!-- Start Newsletter Form -->
                    <div class="subscribe-form ">
                        <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                            <input name="EMAIL" placeholder="Your email address" class="common-input" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Your email address'" required="" type="email">
                            <button class="btn">Invia</button>
                        </form>
                    </div>
					<!-- End Newsletter Form -->
                </div>
            </div>
        </div>
    </section>
    <!-- /End Newsletter Area -->
	
	<!--Footer start-->
    <section id="footer" class="section footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-12">
                  <div class="footer-logo">
                     <a href="index.html"><img src="img/Logo/wildlife-logo.png" alt="#"></a>
                  </div>
                  <div class="contact-info">
                  </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
				   <div class="single-footer f-link">
						<h5>Quick menu</h5>
						<ul>
							<li class="active"><a href="home">Home</a></li>
							<li><a href="#chi-siamo">Chi Siamo</a></li>
							<li><a href="#cosa-facciamo">Cosa Facciamo</a></li>
							<li><a href="#recensioni">Recensioni</a></li>
							<li><a href="#team">Il Nostro Team</a></li>
							<li><a href="#faq">Faq</a></li>
							<li><a href="#contatti">Contatti</a></li>
						</ul>
				   </div>
                </div>
                <div class="col-lg-3 col-md-3 col-12">
					<div class="single-footer f-contact">
					  <h5>Recapiti</h5>
					  <div class="contact-info">
						 <p>
							Qui tutti i nostri principali recapiti.
						 </p>
					  </div>
					  <p>
						 +39 3456786543
					  </p>
					  <p>
						 Email: segreteria.wilidlife1@gmail.com
					  </p>
					</div>
                </div>
            </div>
        </div>
		<div class="container">
			<div class="row">
				<div class="col-12">
						<p class="text-center copyright">1980 - <?= date("Y")?> &copy Wildlife</p>
				</div>
			</div>
		</div>
    </section>
    <!--Footer end-->
 
	<!-- Jquery -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<!-- Popper JS -->
	<script src="js/popper.min.js"></script>
	<!-- Bootstrap JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Color JS -->
	<script src="js/colors.js"></script>
	<!-- Steller JS -->
	<script src="js/steller.js"></script>
	<!-- Slicknav JS -->
	<script src="js/slicknav.min.js"></script>
	<!-- Owl Carousel JS -->
	<script src="js/owl-carousel.js"></script>
	<!-- Magnific Popup JS -->
	<script src="js/magnific-popup.js"></script>
	<!-- Waypoints JS -->
	<script src="js/waypoints.min.js"></script>
	<!-- Wow Min JS -->
	<script src="js/wow.min.js"></script>
	<!-- Jquery Counterup JS -->
	<script src="js/jquery-counterup.min.js"></script>
	<!-- Ytplayer JS -->
	<script src="js/ytplayer.min.js"></script>
	<!-- ScrollUp JS -->
	<script src="js/scrollup.js"></script>
	<!-- Onepage Nav JS -->
	<script src="js/onepage-nav.min.js"></script>
	<!-- Easing JS -->
	<script src="js/easing.js"></script>
	<!-- Active JS -->
	<script src="js/active.js"></script>
</body>
</html>
