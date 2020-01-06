<?php

class Category {
    
    /**
     * Kategorien ID
     */
    var $catID = null;
    
    /**
     * Kategorien Titel
     */
    var $cTitle = null;
    
    /**
     * Kategorien Anzahl
     */
    var $countCategory = null;
    
    /**
     * Foren ID
     */
    var $boardID = null;
    
    /**
     * Foren Titel
     */
    var $bTitle = null;
    
    /**
     * Foren Anzahl
     */
    var $countBoard = null;
    
    
    /**
     * Themen ID
     */
    var $threadID = null;
    
    /**
     * Themen Titel
     */
    var $tTitle = null;
    
    /**
     * Themen Anzahl
     */
    var $countThread = null;
    
    /**
     * HTML DIV-Container Element
     */
    var $htmlDIV = '';
    
    /**
     * Breadcrumb (Seiten-Navigation) DIV-Container Element
     */
    var $bcDIV = '';
    
    /**
     * Datenbank Klasse
     */
    var $db = null;
    
    /**
     * UserID
     */
    var $UserID = null;
    
    /**
     * Kategorie Klasse START
     * @param object $db Datenbank Klasse
     */
    public function __construct($db) {
        $this->db = $db;
    }
    
    /**
     * Gibt alle Kategorien aus
     */
    public function getCategories() {
        $sql = $this->db->__query("SELECT * FROM kategorie");
        while($row = $this->db->__fetchArray($sql)) {
            $this->catID = $row['CatID'];
            $this->cTitle = $row['Title'];
            $this->htmlDIV = '<div class="container">';
                $this->htmlDIV .= '<div class="row">';
                    $this->htmlDIV .= '<div class="col-md-12">';
                        $this->htmlDIV .= '<div class="panel panel-primary">';
                            $this->htmlDIV .= '<div class="panel-heading">';
                                $this->htmlDIV .= '<a class="getlink" href="index.php?page=cat&amp;catid='.$this->catID.'">'.$this->cTitle.'</a>';
                            $this->htmlDIV .= '</div>';
                            $this->getBoards($this->catID);
                        $this->htmlDIV .= '</div>';
                    $this->htmlDIV .= '</div>';
                $this->htmlDIV .= '</div>';
            $this->htmlDIV .= '</div>';
            
            echo $this->htmlDIV;
        }
    }
    
    /**
     * Gebe alle Foren zur Kategorie ID aus
     * @param integer $catid Kategorie ID
     */
    private function getBoards($catid) {
        $this->catID = $catid;
        
        $sql = $this->db->__query("SELECT * FROM foren WHERE CatID = '{$this->catID}'");
        $this->countBoard = $this->db->__numRows($sql);
        if($this->countBoard > 0) {
            while($row = $this->db->__fetchArray($sql)) {
                $this->boardID = $row['FID'];
                $this->bTitle = $row['Title'];
                
                $this->htmlDIV .= '<div class="panel-body">';
                    $this->htmlDIV .= '<div class="col-md-5">';
                        $this->htmlDIV .= '<a href="index.php?page=board&amp;fid='.$this->boardID.'">';
                            $this->htmlDIV .= $this->bTitle;
                        $this->htmlDIV .= '</a>';
                    $this->htmlDIV .= '</div>';
                    $this->htmlDIV .= '<div class="col-md-2"></div>';
                    $this->htmlDIV .= '<div class="col-md-4"></div>';
                $this->htmlDIV .= '</div>';
            }
        } else {
            $this->htmlDIV .= '<div class="panel-body">';
                $this->htmlDIV .= '<div class="col-md-5"></div>';
                $this->htmlDIV .= '<div class="col-md-2">Keine Foren vorhanden</div>';
                $this->htmlDIV .= '<div class="col-md-4"></div>';
            $this->htmlDIV .= '</div>';
        }
    }
    
    /**
     * Gebe eine Kategorie aus
     * @param integer $catid Kategorie ID
     */
    public function getCategory($catid) {
        if($catid != 0 || $catid != '') $this->catID = $catid;
        $sql = $this->db->__query("SELECT * FROM kategorie WHERE CatID='{$this->catID}'");
        $row = $this->db->__fetchArray($sql);
        $this->cTitle = $row['Title'];
        $this->catID = $row['CatID'];
        $this->countCategory = $this->db->__numRows($sql);
        if($this->countCategory > 0) {
            $this->htmlDIV = '<div class="container">';
                $this->htmlDIV .= '<div class="row">';
                    $this->htmlDIV .= '<div class="col-md-12">';
                        $this->htmlDIV .= '<div class="panel panel-primary">';
                            $this->htmlDIV .= '<div class="panel-heading">';
                                $this->htmlDIV .= $this->cTitle;
                            $this->htmlDIV .= '</div>';
                            $this->getBoards($this->catID);
                        $this->htmlDIV .= '</div>';
                    $this->htmlDIV .= '</div>';
                $this->htmlDIV .= '</div>';
            $this->htmlDIV .= '</div>';
        } else {
            $this->htmlDIV .= '<div class="container">';
            $this->htmlDIV .= 'Keine Kategorie gefunden';
            $this->htmlDIV .= '</div>';
        }
        
        $this->getBreadcrumb($this->catID);
        echo $this->htmlDIV;
    }
    
    /**
     * Gebe die Seiten-Navigation aus
     * @param integer $catid Katgorie ID
     * @param integer $fid Foren ID
     * @param integer $tid Themen ID
     */
    private function getBreadcrumb($catid = 0, $fid = 0, $tid = 0) {
        $this->bcDIV = "<div class=\"container\">";
            $this->bcDIV .= "<ol class=\"breadcrumb\">";
                $this->bcDIV .= "<li><a href=\"index.php\">Startseite</a></li>";
                if($catid > 0 && $fid == 0) $this->bcDIV .= "<li class=\"active\">{$this->cTitle}</li>";
                if($catid > 0 && $fid > 0 && $tid == 0) $this->bcDIV .= "<li><a href=\"index.php?page=cat&amp;catid={$catid}\">{$this->getCategoryTitle($catid)}</a></li><li class=\"active\">{$this->getBoardTitle($fid)}</li>";
                if($catid > 0 && $fid > 0 && $tid > 0) $this->bcDIV .= "<li><a href=\"index.php?page=cat&amp;catid={$catid}\">{$this->getCategoryTitle($catid)}</a></li><li><a href=\"index.php?page=board&amp;fid={$fid}\">{$this->getBoardTitle($fid)}</a></li><li class=\"active\">{$this->getThreadTitle($tid)}</li>";
            $this->bcDIV .= "</ol>";
        $this->bcDIV .= "</div>";
        
        echo $this->bcDIV;
    }
    
    /**
     * Gebe ein Foren aus
     * @param integer $fid Foren ID
     */
    public function getBoard($fid) {
        if($fid != 0 || $fid != '') $this->boardID = $fid;
        $sql = $this->db->__query("SELECT * FROM foren WHERE FID = '{$this->boardID}'");
        $this->countBoard = $this->db->__numRows($sql);
        if($this->countBoard > 0) {
            $row = $this->db->__fetchArray($sql);
            $this->bTitle = $row['Title'];

            $this->htmlDIV = '<div class="container">';
                $this->htmlDIV .= '<div class="row">';
                    $this->htmlDIV .= '<div class="col-md-12">';
                        $this->htmlDIV .= '<div class="panel panel-primary">';
                            $this->htmlDIV .= '<div class="panel-heading">';
                                $this->htmlDIV .= $this->bTitle;
                            $this->htmlDIV .= '</div>';
                            $this->getThreads($this->boardID);
                        $this->htmlDIV .= '</div>';
                    $this->htmlDIV .= '</div>';
                $this->htmlDIV .= '</div>';
            $this->htmlDIV .= '</div>';
        } else $this->htmlDIV = 'Kein Board vorhanden';
        
        $this->getBreadcrumb($row['CatID'], $this->boardID);
        
        echo $this->htmlDIV;
    }
    
    /**
     * Gebe alle Themen zur Foren ID aus
     * @param integer $fid Foren ID
     */
    private function getThreads($fid) {        
        if($fid != 0 || $fid != '') $this->boardID = $fid;
        $sql = $this->db->__query("SELECT * FROM themen WHERE FID = '{$this->boardID}'");
        $this->countThread = $this->db->__numRows($sql);
        while($row = $this->db->__fetchArray($sql)) {
            if($row['PostCount'] == 0 || $row['PostCount'] >= 2) $beitrag = 'Beitr&auml;ge';
            else $beitrag = 'Beitrag';
            
            $dateCreate = date_create($row['CreateDate']);
            $datum = date_format($dateCreate, "d.m.Y");
            $uhrzeit = date_format($dateCreate, "H:i");
            
            $this->htmlDIV .= '<div class="fContent panel-body">';
                $this->htmlDIV .= '<div class="col-md-5">';
                    $this->htmlDIV .= '<div class="row">';
                        $this->htmlDIV .= '<div class="col-md-12">';
                            $this->htmlDIV .= '<a href="index.php?page=thread&amp;tid='.$row['TID'].'">'.$this->encoding($row['Title'], false).'</a>';
                        $this->htmlDIV .= '</div>';
                        $this->htmlDIV .= '<div class="col-md-12">';
                            $this->htmlDIV .= '<span class="label label-info author">Erstellt von '.$this->getUser($row['UserID']).'</span>';
                        $this->htmlDIV .= '</div>';
                    $this->htmlDIV .= '</div>';
                $this->htmlDIV .= '</div>';
                $this->htmlDIV .= '<div class="col-md-2" style="line-height: 34px; font-size: 13px;">'.$row['PostCount'].' '.$beitrag.'</div>';
                $this->htmlDIV .= '<div class="col-md-4" style="font-size: 12px;">Letzter Beitrag wurde von '.$this->getUser($row['UserID']).' erfasst<br />';
                    $this->htmlDIV .= 'Erstellt am <i class="fa fa-calendar" title="'.$datum.'"></i> '.$datum.' ';
                    $this->htmlDIV .= 'um <i class="fa fa-clock-o" title="'.$uhrzeit.'"></i> '.$uhrzeit.' ';
                    $this->htmlDIV .= '<a href="#" class="btn btn-xs btn-warning pull-right">...gehe zu</a> ';
                $this->htmlDIV .= '</div>';
            $this->htmlDIV .= '</div>';
        }
    }
    
    /**
     * Gebe ein Thema aus
     * @param integer $tid Themen ID
     */
    public function getThread($tid) {
        if($tid != 0 || $tid != '') $this->threadID = $tid;

        $fidSQL = $this->db->__query("SELECT t.TID, t.FID, f.FID, f.Title FROM themen t LEFT JOIN foren f ON(t.FID = f.FID) WHERE t.TID = '{$this->threadID}'");
        $fRow = $this->db->__fetchArray($fidSQL);
        
        $cidSQL = $this->db->__query("SELECT f.CatID, c.CatID, c.Title FROM foren f LEFT JOIN kategorie c ON(f.CatID = c.CatID) WHERE f.FID = '{$fRow['FID']}'");
        $cRow = $this->db->__fetchArray($cidSQL);
        
        $sqlGanz = $this->db->__query("SELECT t.*, f.FID as ForenID, f.Title as fTitle, c.CatID as CID, c.Title as CTitle FROM themen t LEFT JOIN foren f ON(t.FID = f.FID) LEFT JOIN kategorie c ON(f.CatID = c.CatID) WHERE t.TID = '{$this->threadID}'");
        $row = $this->db->__fetchArray($sqlGanz);
        
        echo $this->getBreadcrumb($row['CID'], $row['ForenID'], $this->threadID);
    }
    
    /**
     * Gebe den Titel der Kategorie aus
     * @param integer $catid Kategorie ID
     * @return string
     */
    private function getCategoryTitle($catid) {
        $sql = $this->db->__query("SELECT Title FROM kategorie WHERE CatID = '{$catid}'");
        $row = $this->db->__fetchArray($sql);
        return $this->encoding($row['Title'], false);
    }
    
    /**
     * Gebe den Titel des Foren aus
     * @param integer $fid Foren ID
     * @return string
     */
    private function getBoardTitle($fid) {
        $sql = $this->db->__query("SELECT Title FROM foren WHERE FID = '{$fid}'");
        $row = $this->db->__fetchArray($sql);
        return $this->encoding($row['Title'], false);
    }
    
    /**
     * Gebe den Titel des Themas aus
     * @param integer $tid Themen ID
     * @return string
     */
    public function getThreadTitle($tid) {
        $sql = $this->db->__query("SELECT Title FROM themen WHERE TID = '{$tid}'");
        $row = $this->db->__fetchArray($sql);
        return $this->encoding($row['Title'], false);
    }
    
    /**
     * Gebe die Nachricht aus
     * @param integer $tid Themen ID
     * @return string Message
     */
    public function getThreadMessage($tid) {
        $sql = $this->db->__query("SELECT Message FROM themen WHERE TID = '{$tid}'");
        $row = $this->db->__fetchArray($sql);
        return $this->encoding($row['Message']);
    }
    
    /**
     * Setze Zeilenumbrüche
     * @param string $value Eingabewert
     * @return nl2br value
     */
    private function getNl2br($value) {
        return nl2br($value);
    }
    
    /**
     * Gebe Inhalt als UTF8 zurück
     * @param string $value Eingabewert
     * @param bool $nLine NewLine(HTML BR-Tag)
     * @return string $value
     */
    public function encoding($value, $nLine = true) {
        if($nLine === true) $value = $this->getNl2br($value);
        
        return utf8_encode($value);
    }
    
    /**
     * Gebe den Usernamen aus
     * @param type $userid UserID
     * @return string Username
     */
    public function getUser($userid) {
        if($userid != 0 || $userid != '') $this->UserID = $userid;
        $sql = $this->db->__query("SELECT * FROM users WHERE UserID = '{$this->UserID}'");
        $row = $this->db->__fetchArray($sql);
        return $row['Username'];
    }
    
    public function getRegDate($userid) {
        if($userid != 0 || $userid != '') $this->UserID = $userid;
        $sql = $this->db->__query("SELECT * FROM users WHERE UserID = '{$this->UserID}'");
        $row = $this->db->__fetchArray($sql);
        return $this->getDate($row['RegDate']);
    }


    /**
     * Gebe das Datum aus
     * @param string $datum Datum
     * @param string $type Datumsformat
     * return string Datum
     */
    public function getDate($datum, $type = "d.m.Y") {
        $dateCreate = date_create($datum);
        $datum = date_format($dateCreate, $type);
        echo $datum;
    }
    
    /**
     * Gebe die Uhrzeit aus
     * @param string $zeit Datum
     * @param string $type Datumsformat
     * return string Uhrzeit
     */
    public function getTime($zeit, $type = "H:i") {
        $timeCreate = date_create($zeit);
        $zeit = date_format($timeCreate, $type);
        echo $zeit;
    }
}
?>