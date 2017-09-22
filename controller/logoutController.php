<?php
session_start();
unset($_SESSION['user']);
setFlash('Vous êtes maintenant déconnecter');
header('Location: '.BASE_URL);
die();