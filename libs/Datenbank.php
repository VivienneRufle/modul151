<?php
class Database {
    
    var $host = null;
    var $user = null;
    var $pass = null;
    var $name = null;
    
    var $linkID = null;
    var $queryID = null;
    
    var $recArray = array();
    
    /**
     * Datenbank Verbindung
     * @param string $host Server-Adresse (ex. localhost)
     * @param string $user PHPMyAdmin Benutzername
     * @param string $pass PHPMyAdmin Passwort
     * @param string $name PHPMyAdmin Datenbank Name
     */
    public function __construct($host, $user, $pass, $name) {
        $this->host = $host; //Server-Hostname (localhost)
        $this->user = $user; //Datenbank Benutzername
        $this->pass = $pass; //Datenbank Passwort
        $this->name = $name; //Datenbank selbst (tutforum)
        
        $this->__connect();
    }
    
    /**
     * Verbindungsaufbau
     */
    private function __connect() {
       // $this->linkID = mysqli_connect($this->host, $this->user, $this->pass);
        
        if($this->linkID === false) echo 'Verbindung zur Datenbank fehlgeschlagen.';
        else  $this->__selectDB($this->name);
    }
    
    /**
     * Selektiere die Datenbank
     * @param string $dbname Datenbank Name
     */
    private function __selectDB($dbname) {
        if($dbname != '') $this->name = $dbname;
       // if(mysqli_select_db($this->linkID, $this->name) === false) echo 'Datenbank '.$this->name.' wurde nicht gefunden';
    }
    

    
    /**
     * SQL-Statement an Datenbank senden
     * @param string $sql SQL-Statement
     * @param integer $limit Maximale Anzahl
     * @param integer $offset Minimale Anzahl
     * @return type Referenz-Rückgabe
     */
    public function __query($sql, $limit = 0, $offset = 0) {
        if($limit != 0) $sql .= " LIMIT $offset, $limit";
       // $this->queryID = mysqli_query($this->linkID, $sql);
        
        return $this->queryID;
    }
    
    /**
     * Liefert Datensatz als Array zürck
     * @param type $queryID SQL-Statement
     * @param type $type SQL-Type
     * @return array Rückgabe-Array
     */
    public function __fetchArray($queryID, $type = MYSQLI_BOTH) {
        if($this->queryID !== false) $this->queryID = $queryID;
       // $this->recArray = mysqli_fetch_array($this->queryID, $type);
        return $this->recArray;
    }
    
    /**
     * Liefert die Anzahl der Einträge
     * @param type $queryID SQL-Statement
     * @return type Anzahl als Referenz
     */
    public function __numRows($queryID) {
        if($this->queryID !== false) $this->queryID = $queryID;
        return mysqli_num_rows($queryID);
    }
    
    public function realString($value) {
        return mysqli_real_escape_string($this->linkID, $value);
    }

    /**
     * Datenbank Verbindung schliessen
     */
    public function __disconnect() {
        if($this->linkID) mysqli_close($this->linkID);
    }
}
?>