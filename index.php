<?php
require_once "CRUD.php";
require_once "number_id.php";
require_once "function.php";
require_once "registered_mail.php";
require_once "addressee.php";
require_once "sender.php";


$numberId = new NumberId();
$mail = new RegisteredMail();
$sender = new Sender();
$addressee = new Addressee();

//require_once "table_mails.php";
//require_once "tracking_mails.php";
require_once "form_processing_mail.php";
//require_once "form_update_mail.php";
//require_once "create_id.php";
//require_once "view_id.php";

