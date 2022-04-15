<?php
session_start();
if (isset($_SESSION['email'])) $email = $_SESSION['email'];
else $email = NULL;
if (isset($_SESSION['codice_utente'])) $codice_utente = $_SESSION['codice_utente'];
else $codice_utente = NULL;
if (isset($_SESSION['nickname'])) $nickname = $_SESSION['nickname'];
else $nickname = NULL;
?>
