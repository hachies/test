<?php
class DB {
    private $dbh;

    public function __construct($db, $host = "localhost", $user = "root", $pass = "")
    {
        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$db;" , $user, $pass);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connectie fout: " . $e->getMessage());
        }
    }

    public function execute($query, $params = array()) {
        try {
            $stmt = $this->dbh->prepare($query);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            die("Query fout: " . $e->getMessage());
        }
    }

    public function fetchAll($stmt) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetch($stmt) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

$myDb = new DB('itlyceum');
?>
