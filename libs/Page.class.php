<?php
class Page {
    
    var $request = null;
    var $path = null;
    var $ext = null;
    
    var $getFullPath = null;
    
    public function __construct($request, $path = './frontend/pages/', $ext = '.php') {
        if($request != '') $this->request = $request;
        if($path != '') $this->path = $path;
        if($ext != '') $this->ext = $ext;
        
        $this->getFullPath = $this->path.$this->request.$this->ext;
        
        $this->__existsFile();
    }
    
    private function __existsFile() {
        if(file_exists($this->getFullPath)) {
            $this->__getFile();
        } else {
            include_once($this->path.'index.php');
        }
    }
    
    private function __getFile() {
        global $db;
        return include_once($this->getFullPath);
    }
    
}
?>