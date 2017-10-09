<?php
require ('handlers/form.php');

$request = new stdClass();

$email = (isset($_POST['email'])) ? $_POST['email'] : null;
$password = (isset($_POST['password'])) ? $_POST['password'] : null;
$birth_date = (isset($_POST['birth-date'])) ? $_POST['birth-date'] : null;
$gender = (isset($_POST['gender'])) ? $_POST['gender'] : null;
$discipline = (isset($_POST['discipline'])) ? $_POST['discipline'] : null;
$discipline_music = (isset($_POST['discipline-music'])) ? $_POST['discipline-music'] : null;
$discipline_music_profession = (isset($_POST['discipline-music-profession'])) ? $_POST['discipline-music-profession'] : null;
$discipline_dance = (isset($_POST['discipline-dance'])) ? $_POST['discipline-dance'] : null;
$discipline_dance_profession = (isset($_POST['discipline-dance-profession'])) ? $_POST['discipline-dance-profession'] : null;

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
   $frm = new FormHandler(
       $email,
       $password,
       $birth_date,
       $gender,
       $discipline,
       $discipline_music,
       $discipline_music_profession,
       $discipline_dance,
       $discipline_dance_profession
   );

   $is_valid = $frm->validate();

   if(!$is_valid) {
       $request->errors = $frm->errors;
   }
   else {
       $frm->saveFormData();
   }

   die(json_encode($request));
}
?>