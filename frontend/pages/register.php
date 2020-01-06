<?php
include_once('../../libs/config.php');
include_once('../../libs/Datenbank.php');

$db = new Database($cfg['host'], $cfg['user'], $cfg['pass'], $cfg['name']);

if(isset($_POST)) {
    $username = $db->realString($_POST['username']);
    $passwd = $db->realString(sha1($_POST['passwd1']));
    $mailer = $db->realString($_POST['mailer']);
    $userID = 0;
    
    $sql = $db->__query("SELECT * FROM users WHERE Username = '{$username}'");
    $row = $db->__numRows($sql);
    
    $sql2 = $db->__query("SELECT * FROM users WHERE Email = '{$mailer}'");
    $row2 = $db->__numRows($sql2);
    
    if($row >= 1) {
        echo 1; // Fehler Benutzer vergeben
    } else {
        if($row2 >= 1) {
            echo 2; // Fehler Mail vergeben
        } else {
            $db->__query("INSERT INTO users (Username, Passwort, Email, RegDate) VALUES('{$username}', '$passwd', '$mailer', NOW())");
            echo "success";
        }
    }
}
?>