<html>

<!-- bootstrap-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- recaptcha-->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
<body style='padding:15'>

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="shop.php">Startseite</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" href="#">Anmelden</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="newUser.php">Registrieren</a>
  </li>
</ul>

<content style='margin:15'>

<form method='post' action='index.php'>
  <div class="form-group">
    <label for="name">Nutzername</label>
    <input type="text" class="form-control" name="name" aria-describedby="emailHelp" required>
  </div>
  <div class="form-group">
    <label for="password">Passwort</label>
    <input type="password" class="form-control" name="password" required>
  </div>
  <div class="g-recaptcha" data-type="image" data-sitekey="6LejgesZAAAAALzGfNQWpDK3qipYQqacsPEOcJs5"></div>
  <input type="submit" name="submit" class="btn btn-primary" value="Einloggen">
</form>

</content>
<?php
  include_once 'validateInputText.php';
	if(isset($_POST['name']) && removeCriticalText($_POST['name']) != '' && isset($_POST['password']) && removeCriticalText($_POST['password'])){
    include 'session.php';
		if(createSession(removeCriticalText($_POST['name']), removeCriticalText($_POST['password']))){
      //redirect to shop
			header('Location: shop.php');
		}else{
      //tell user their login data was wrong
      echo "<script> window.alert('Nutzername oder Password falsch!'); </script>";
      die();
		}
	}elseif(isset($_POST["submit"])){
		//send message when user clicked on submit button, not all fields populated
    echo "<script> window.alert('Bitte alle benötigten Felder ausfüllen!'); </script>";
    die();
	}
?>


</body>
</html>