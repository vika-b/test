<?php
require ('vendor/autoload.php');
require ('dbConnect.php');
require ('vendor/fzaninotto/faker/src/autoload.php');

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

$dbh = new dbConnect('mysql:host=' . getenv('HOST') . ';charset=utf8', getenv('DBUSERNAME'), getenv('DBPASSWORD'));
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$dbh->query("CREATE DATABASE IF NOT EXISTS ". getenv('DBNAME'));
$dbh->query("use ". getenv('DBNAME'));
$dbh->query("CREATE TABLE IF NOT EXISTS `form_data` (
  `id` int( 11 ) AUTO_INCREMENT PRIMARY KEY,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `bday` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `discipline` varchar(50) NOT NULL,
  `discipline-music-style` varchar(50) DEFAULT NULL,
  `discipline-music-profession` varchar(50) DEFAULT NULL,
  `discipline-dance-style` varchar(50) DEFAULT NULL,
  `discipline-dance-profession` varchar(50) DEFAULT NULL
)");

$faker = Faker\Factory::create();

for ($i=1; $i < 21; $i++) {

    $stmt = $dbh->prepare("INSERT INTO form_data (`id`, `email`, `password`, `bday`, `gender`, `discipline`, `discipline-music-style`, `discipline-music-profession`, `discipline-dance-style`, `discipline-dance-profession`) VALUES (
              :id, 
              :email, 
              :password, 
              :b_day, 
              :gender, 
              :discipline, 
              :discipline_music_style, 
              :discipline_music_profession, 
              :discipline_dance_style, 
              :discipline_dance_profession
          )");

    $gender = ['Female', 'Male', 'Other'];
    $discipline = ['Music', 'Dance', 'Theater', 'Visual Arts', 'Literature', 'Film/Video'];
    $music_style = ['Jazz', 'Western classical', 'traditional/folkloric'];
    $music_profession = ['Instrumentalist', 'Vocalist', 'Composer', 'Songwriter', 'Educator'];
    $dance_style = ['Contemporary dance', 'tap dance', 'Tango', 'traditional/folklore', 'World'];
    $dance_profession = ['Choreographer', 'Performer', 'Educator'];
    $password_hash = password_hash($faker->password(), PASSWORD_BCRYPT);

    $k_gender = array_rand($gender);
    $k_discipline = array_rand($discipline);

    $value_music_style = '';
    $value_music_profession = '';
    $value_dance_style = '';
    $value_dance_profession = '';

    switch ($discipline[$k_discipline]) {
        case 'Music':
            $k_music_style = array_rand($music_style);
            $k_music_profession = array_rand($music_profession);
            $value_music_style = $music_style[$k_music_style];
            $value_music_profession = $music_profession[$k_music_profession];
            break;
        case 'Dance':
            $k_dance_style = array_rand($dance_style);
            $k_dance_profession = array_rand($dance_profession);
            $value_dance_style = $dance_style[$k_dance_style];
            $value_dance_profession = $dance_profession[$k_dance_profession];
            break;
        default:
            $value_music_style = '';
            $value_music_profession = '';
            $value_dance_style = '';
            $value_dance_profession = '';
    }

    $stmt->bindParam(':id', $i);
    $stmt->bindParam(':email', $faker->email);
    $stmt->bindParam(':password', $password_hash);
    $stmt->bindParam(':b_day', $faker->date());
    $stmt->bindParam(':gender', $gender[$k_gender]);
    $stmt->bindParam(':discipline', $discipline[$k_discipline]);
    $stmt->bindParam(':discipline_music_style', $value_music_style);
    $stmt->bindParam(':discipline_music_profession', $value_music_profession);
    $stmt->bindParam(':discipline_dance_style', $value_dance_style);
    $stmt->bindParam(':discipline_dance_profession', $value_dance_profession);

    $stmt->execute();
}