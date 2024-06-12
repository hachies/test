<?php
include 'db.php';

class Gebruiker {
    private $dbh;
    private $tableUser = 'gebruikers';

    public function __construct(DB $dbh) 
    {
        $this->dbh = $dbh;
    }

    public function hash($wachtwoord) : string {
        return password_hash($wachtwoord, PASSWORD_DEFAULT);
    }

    public function getAllGebruikers() : array 
    {
        return $this->dbh->execute("SELECT * from $this->tableUser")->fetchAll();
    }

    public function getOneGebruiker($id) : array 
    {
        return $this->dbh->execute("SELECT * from $this->tableUser where id = ?", [$id])->fetch();
    }

    public function insertGebruiker($email, $wachtwoord, $rol) : PDOStatement | false
    {
        return $this->dbh->execute("INSERT INTO $this->tableUser (email, wachtwoord, rol) values (?,?,?)", [$email, $this->hash($wachtwoord), $rol]);
    }

    public function editGebruiker($email, $wachtwoord, $id) : PDOStatement 
    {
        return $this->dbh->execute("UPDATE $this->tableUser SET email = ?, wachtwoord = ? where id = ?", [$email,  $this->hash($wachtwoord), $id]);
    }

    public function deleteGebruiker($id) : PDOStatement 
    {
        return $this->dbh->execute("DELETE FROM $this->tableUser where id = ?", [$id]);
    }

    public function login($email, $rol) : array | bool 
    {
        $user = $this->dbh->execute("SELECT * FROM $this->tableUser WHERE email = ?",[$email])->fetch();
        
        if ($user && $user['rol'] === $rol) {
            return $user;
        } else {
            return false;
        }
    }
}

$user = new Gebruiker($myDb);
?>
