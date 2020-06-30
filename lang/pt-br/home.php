<?php
	include("../../php/connection.php");
	session_name('userHanabi_online');
	session_start();

	if(isset($_SESSION['email'])){
		//Se estiver logado
		echo 
		'<style>
			#div_login_no{display: none;}
			#div_login_yes{display: all;}
		</style>';

		$getuser = "
			SELECT
				userName,
				userUsername,
				userPhoto
			FROM hanabiUser
			WHERE
				userEmail = '".$_SESSION['email']."'
		";
		$result = mysqli_query($con, $getuser);

		//Se as cores forem padrão, não ativa a função
		$getcolors = "
			SELECT
				*
			FROM hanabiSettings
			WHERE
				userId = '".$_SESSION['id']."'
		    	AND settingsColor1='#8900B3'
		    	AND settingsColor2='#C91AFF'
		    	AND settingsColor3='#57006D'
		    	AND settingsColor4='#270033'
		    	AND settingsColor5='#C932FF'
		    	AND settingsColor6='#1E1E1E'
		    	AND settingsColor7='#8900B3'
		    	AND settingsColor8='#FFFFFF'
		";
		$colors_result = mysqli_query($con, $getcolors);
		$colors_rows = mysqli_num_rows($colors_result);

		if($colors_rows > 0){
			echo
			'<script>
				var logado = 1;
				var color_default = 1;
			</script>';
		}else{
			echo
			'<script>
				var logado = 1;
				var color_default = 0;
			</script>';
		}
	}else{
		//Se não estiver logado
		echo 
		'<style>
			#div_login_no{display: all;}
			#div_login_yes{display: none;}
		</style>';
	}
?>
<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<title>PROJETO HANABI - INÍCIO</title>
		<!--Todos os metas-->
		<meta charset="utf-8"/>
		<meta name="application-name" content="Projeto Hanabi">
		<meta name="description" content="My Personal Site">
		<meta name="keywords" content="HTML, CSS, JavaScript, PHP">
		<meta name="author" content="Vinícius Gabriel Marques de Melo">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--CSS e Javascript-->
		<link rel="stylesheet" type="text/css" href="../../css/stylemain.css">
		<link rel="stylesheet" type="text/css" href="../../css/stylehome.css">
		<script type="text/javascript" src="../../js/events.js" async></script>
		<script type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script>
		<script type="text/javascript" src="../../js/colors.js" async></script>
		<!--Ícones-->
		<link rel="icon" type="image/x-icon" href="../../images/hanabi.png">
		<link rel="shortcut icon" type="image/x-icon" href="../../images/hanabi.png">
	</head>
	<body onload="bodyLoadFunction('language', 'pt-br', '1234')">
		<noscript>
		</noscript>
		<div id=loadContent>
			<a id="top" hidden></a>
			<a id="link_to_top" href="#top"><img id="img_goup" src="../../images/goup1.png" onmouseover="changeimage1()" onmouseout="changeimage2()"></a>
			<?php
				if(isset($_SESSION['email'])){
			?>
					<div>
						<iframe id="iframe_chat" src="chat.php" style="display: none;" scrolling="no"></iframe>
						<button id="btn_iframe" class="btn_button" onmousedown="interactIframe()">Chat</button>
					</div>
			<?php
				}
			?>
			<div style="background-color: rgba(255,255,255,0.85);">
				<header>
					<div id="div_main">
						<a><h1>PROJETO HANABI</h1></a>
					</div>
					<nav id="nav_language">
						<h4>IDIOMA:</h4>
						<ul>
							<li>
								<a onmousedown="movelink('../pt-br/home.php')" class="txt_selected">BR</a>
								<span>|</span>
								<a onmousedown="movelink('../es-es/home.php')">ES</a>
							</li>
							<li>
								<a onmousedown="movelink('../ja-jp/home.php')">JP</a>
								<span style="margin-left: 3px;">|</span>
								<a onmousedown="movelink('../en-us/home.php')">EN</a>
							</li>
						</ul>
					</nav>
				</header>
				<!--Navegação no celular-->
				<div id="div_navphone">
				  <button class="btn_opennav" onclick="openNav()">☰ PROJETO HANABI</button>  
				</div>
				<div id="div_sidebar_id" class="div_sidebar_class">
					<a href="javascript:void(0)" class="btn_closenav" onclick="closeNav()">×</a>
					<br>
					<span><b>MENU</b></span>
					<hr>
					<br>
					<span>- GUIAS -</span>
					<br>
					<a onmousedown="movelink()" class="txt_selected">INÍCIO</a>
					<a onmousedown="movelink('game.php')">JOGOS</a>
					<a onmousedown="movelink('art.php')">ARTES</a>
					<a onmousedown="movelink('about.php')">SOBRE O SITE</a>
					<hr>
					<br>
					<span>- IDIOMA -</span>
					<br>
					<a onmousedown="movelink('../pt-br/home.php')" class="txt_selected">BR</a>
					<a onmousedown="movelink('../es-es/home.php')">ES</a>
					<a onmousedown="movelink('../ja-jp/home.php')">JP</a>
					<a onmousedown="movelink('../en-us/home.php')">EN</a>
					<br>
					<br>
					<br>
					<br>
				</div>
				<!--Navegação Padrão-->
				<nav id="nav_menu">
					<ul>
						<li><a onmousedown="movelink()" class="txt_selected">INÍCIO</a></li>
						<li><a onmousedown="movelink('game.php')">JOGOS</a></li>
						<li><a onmousedown="movelink('art.php')">ARTES</a></li>
						<li><a onmousedown="movelink('about.php')">SOBRE O SITE</a></li>
					</ul>
				</nav>
				<div id="div_account_switch"><a onmousedown="change_account_state()">CONTA</a></div>
				<div id="div_account">
					<!--Não logado-->
					<div id="div_login_no">
						<form id="form_login" method="POST" action="../../php/login.php">
							<label for="login">Usuário ou E-mail:</label>
							<br>
							<input id="txt_email" class="txt_textbox" type="text" name="login" placeholder="Digite seu nome de usuário ou e-mail." maxlength="50" required/>&nbsp
							<br>
							<br>
							<label for="senha">Senha:</label>
							<br>
							<input id="txt_password" class="txt_textbox" type="password" name="password" placeholder="Digite sua senha." maxlength="20" required/>&nbsp
							<br>
							<br>
							<a id="txt_signup" onmousedown="movelink('signup.php')">Criar uma conta.</a>
							<br>
							<br>
							<button class="btn_button" onmousedown="movelink('login')" value="Entrar">Entrar</button>
							<br>
							<br>
							<a id="txt_forgot" onmousedown="movelink('forgot.php')">Esqueci a senha.</a>
						</form>
					</div>
					<!--Logado-->
					<div id="div_login_yes">
						<?php
							while ($data = mysqli_fetch_array($result)) {
								if($data['userPhoto']){
									echo '<a onmousedown="movelink(`user.php?user='.htmlentities($data['userUsername']).'`)"><img style="background-image: url(data:image/jpg;charset=utf8;base64,'.base64_encode($data['userPhoto']).')"></a>';
								}else{

									echo '<a onmousedown="movelink(`user.php?user='.htmlentities($data['userUsername']).'`)"><img style="background-image: url(../../images/usericon.png)"></a>';

								}

								echo '
								<br>
								<br>
								<a onmousedown="movelink(`user.php?user='.htmlentities($data['userUsername']).'`)"><span>'.htmlentities($data['userName']).'</span></a>
								<br>
								<a onmousedown="movelink(`user.php?user='.htmlentities($data['userUsername']).'`)"><span>('.htmlentities($data['userUsername']).')</span></a>
								<br>
								<br>
								<hr>
								<a onmousedown="movelink(`user.php?user='.htmlentities($data['userUsername']).'`)">Meu Perfil</a>';
							}
						?>
						<br>
						<br>
						<a onmousedown="movelink('settings.php')">Editar Perfil</a>
						<br>
						<hr>
						<a onmousedown="movelink('search.php')">Procurar Pessoas</a>
						<br>
						<br>
						<a onmousedown="movelink('chat.php')">Entrar no Chat Público</a>
						<br>
						<hr>
						<a id="txt_logoff" onmousedown="movelink('logoff.php')">Fazer Logoff</a>
					</div>
				</div>
				<section>
					<div id="div_blockone">
						<h2>SOBRE O QUE É?</h2>
						<p id="div_about">O Projeto Hanabi  é um projeto que irá acompanhar o meu progresso em diversas coisas de diversas áreas da minha vida ao mesmo tempo. Sejam conhecimento adiquiridos por meios próprios ou por conta de alguma instituição, como o <span style="background: red;color: rgba(255,255,255,1);padding: 1px;">SENAI</span>, que foi muito influente na forma com a qual eu vejo programação e o português hoje.
						<br>
						<br>
						O site vai permanecer em desenvolvimento por um longo período de tempo, pois é algo pessoal e que considero não só uma coisa não só importante para que eu possa ver o meu avanço de um ângulo melhor, mas também, é um projeto que está sendo divertido de se desenvolver.
						<br>
						<br>
						<a onmousedown="movelink('about.php')">Ver mais.</a>
						</p>
						<h3 id="disclaimer">Site em desenvolvimento. Perdoe o inconveniente.</h3>
						<img src="../../images/girlbrowsing.gif" id="img_girlbrowsing" alt="Garota mexendo no computador.">
					</div>
					<div id=div_blockbackground>
						<div id="div_blocktwo">
							<h2>QUAL O CONTEÚDO DO SITE?</h2>
							<div class="div_seravisto left">
								<h3>ARTES</h3>
								<p>Alguns desenhos feitos por mim que eu considere relevante colocar.</p><img src="../../images/pokemon.png" class="img_icons">
							</div>
							<div class="div_seravisto right">
								<h3>JOGOS</h3>
								<p>Falarei sobre alguns jogos que joguei com uma breve descrição.</p><img src="../../images/gameboy.png" class="img_icons">
							</div>
							<div class="div_seravisto left">
								<h3>OUTROS</h3>
								<p>E outros recursos como perfil, chat que pretendo implementar!</p><img src="../../images/plussignal.png" class="img_icons">
							</div>
						</div>
					</div>
					<div id="div_blockthree">
						<h5>E é isso, muito obrigado por ter lido até aqui, espero que continue lendo e que goste do meu trabalho.</h5>
					</div>
				</section>
				<div id="div_cookies" style="display: none;">
					Utilizando o nosso site e continuando a navegar vamos entender que você aceita a nossa política de <a href="http://localhost/projecthanabi_web/info/cookies.html" target="_blank">cookies</a>. Caso queira saber mais sobre <a href="http://localhost/projecthanabi_web/info/cookies.html" target="_blank">cookies</a>, como usamos e a nossa política clique no link exibido.</a>
					<br>
					<br>
					<button class="btn_button" onmousedown="setCookie('terms_of_cookie', 'allowed', 365)">Fechar</button>
				</div>
				<footer>
					Site criado por Vinícius Gabriel Marques de Melo com propostas educativas.
					<br>Sendo mantido desde 2020 até 2020
					<br>Caso utilizar o site em qualquer meio público mesmo que seja como proposta educativa, favor disponibilizar os créditos.
				</footer>
			</div>
		</div>
	</body>
</html>