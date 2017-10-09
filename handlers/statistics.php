<?php
require ($_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php');
require ($_SERVER['DOCUMENT_ROOT'].'/dbConnect.php');

class StatisticsHandler {

    public function __construct()
    {
        $dotenv = new Dotenv\Dotenv($_SERVER['DOCUMENT_ROOT']);
        $dotenv->load();

        $this->dbh = new dbConnect('mysql:host=' . getenv('HOST') . ';dbname=' . getenv('DBNAME') . ';charset=utf8', getenv('DBUSERNAME'), getenv('DBPASSWORD'));
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getTableData()
    {
        $stmt = $this->dbh->prepare("SELECT `email`, `bday`, `gender`, `discipline`, `discipline-music-style`, `discipline-music-profession`, `discipline-dance-style`, `discipline-dance-profession` FROM form_data");
        $stmt->execute();

        $result = $stmt->fetchAll();

        return $result;
    }

    public function getStatisticsData()
    {
        $stmt = $this->dbh->prepare("SELECT `discipline`, count(`discipline`) as data_nums FROM form_data GROUP BY `discipline`");
        $stmt->execute();

        $res = $stmt->fetchAll();
        $result = new stdClass();
        $total = 0;

        foreach ($res as $item) {
            $result->labels[] = $item['discipline'];
            $total += $item['data_nums'];
            $result->data_nums[] = $item['data_nums'];
        }

        foreach ($result->data_nums as $data_num) {
            $result->data[] = (100*$data_num)/$total;
        }

        die(json_encode($result));
    }
}

?>