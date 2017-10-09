<?php
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require ($_SERVER['DOCUMENT_ROOT'].'/dbConnect.php');

class FormHandler {
    protected $email;
    protected $password;
    protected $birth_date;
    protected $gender;
    protected $discipline;
    protected $discipline_music;
    protected $discipline_music_profession;
    protected $discipline_dance;
    protected $discipline_dance_profession;
    protected $dbh;
    public $errors;

    public function __construct(
        $email,
        $password,
        $birth_date,
        $gender,
        $discipline,
        $discipline_music,
        $discipline_music_profession,
        $discipline_dance,
        $discipline_dance_profession
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->birth_date = $birth_date;
        $this->gender = $gender;
        $this->discipline = $discipline;
        $this->discipline_music = $discipline_music;
        $this->discipline_music_profession = $discipline_music_profession;
        $this->discipline_dance = $discipline_dance;
        $this->discipline_dance_profession = $discipline_dance_profession;
        $this->errors = '';

        $dotenv = new Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();

        $this->dbh = new dbConnect('mysql:host=' . getenv('HOST') . ';dbname=' . getenv('DBNAME') . ';charset=utf8', getenv('DBUSERNAME'), getenv('DBPASSWORD'));
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function validate() {
        if(empty($this->email) || empty($this->password) || empty($this->birth_date) || empty($this->gender) || empty($this->discipline)) {
            $this->errors .= '<div class="error">All fields are required!</div>';
        }
        if(!empty($this->discipline) && $this->discipline=='Music') {
            if(empty($this->discipline_music) || empty($this->discipline_music_profession)) {
                $this->errors .= '<div class="error">Music fields are required!</div>';
            }
        }
        if(!empty($this->discipline) && $this->discipline=='Dance') {
            if(empty($this->discipline_dance) || empty($this->discipline_dance_profession)) {
                $this->errors .= '<div class="error">Dance fields are required!</div>';
            }
        }

        if(!empty($this->errors))
            return false;
        else
            return true;
    }

    public function saveFormData()
    {
        $stmt = $this->dbh->prepare("INSERT INTO form_data (`email`, `password`, `bday`, `gender`, `discipline`, `discipline-music-style`, `discipline-music-profession`, `discipline-dance-style`, `discipline-dance-profession`) VALUES (
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
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $password_hash);
        $stmt->bindParam(':b_day', $this->birth_date);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':discipline', $this->discipline);
        $stmt->bindParam(':discipline_music_style', $this->discipline_music);
        $stmt->bindParam(':discipline_music_profession', $this->discipline_music_profession);
        $stmt->bindParam(':discipline_dance_style', $this->discipline_dance);
        $stmt->bindParam(':discipline_dance_profession', $this->discipline_dance_profession);

        $stmt->execute();
    }
}

?>