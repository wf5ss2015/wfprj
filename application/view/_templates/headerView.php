
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!--<!DOCTYPE HTML>!-->
<html lang="de">
<head>
<title>Lehrveranstaltungs Software</title>
<meta charset="utf-8">
<meta name="description"
	content="Das wird die zukünftige lehrveranstaltunsseite">
<link rel="stylesheet"
	href="<?php echo Config::get('URL'); ?>public/css/styles.css">
	

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#login-trigger').click(function(){
    $(this).next('#login-content').slideToggle();
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25B2;')
      else $(this).find('span').html('&#x25BC;')
    })
});
</script>
</head>
<body>
<div class="wrapper"></div>
	<header>
	<nav id="login">
	<ul id="login" >
    <?php if(!Session::userIsLoggedIn()){?>
	<li id="login">
      <a id="login-trigger" href="#">
        Login <span>▼</span>
      </a>
      <div id="login-content">
        <form action="index.php?url=login/login" method="post">
          <fieldset id="inputs">
            <input id="username" type="text" name="user_name" placeholder="Nutzername" required>   
            <input id="password" type="password" name="user_password" placeholder="Passwort" required>
          </fieldset>
          <fieldset id="actions">
            <input type="submit" id="submit" value="Log in">
          </fieldset>
        </form>
      </div>                     
    </li>
	<?php }else{ ?>
	<li id="login">
      <a id="login-trigger" href="index.php?url=login/logout">
		Logout (Angemeldet: <?php echo(Session::get('user_name'))?> )
      </a>                   
    </li>
	<?php }?>
  </ul>
  </nav>
</header>

	

