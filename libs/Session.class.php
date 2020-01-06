<?php
class Session {
    
    const SESSION_STARTED = true;
    const SESSION_NOT_STARTED = false;
    
    private $sessionState = self::SESSION_NOT_STARTED;
    
    private static $instance;
    
    private function __construct() { }
    
    public static function getInstance() {
        if(!isset(self::$instance)) {
            self::$instance = new self;
        }
        
        self::$instance->startSession();
        
        return self::$instance;
    }
    
    public function startSession() {
        if($this->sessionState == self::SESSION_NOT_STARTED) {
            $this->sessionState = session_start();
        }
        
        return $this->sessionState;
    }
    
    public function __set($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    public function __get($name) {
        return isset($_SESSION[$name]);
    }
    
    public function __unset($name) {
        unset($_SESSION[$name]);
    }
    
    public function destroy() {
        if($this->sessionState == self::SESSION_STARTED) {
            $this->sessionState = !session_destroy();
            unset($_SESSION);
            
            return !$this->sessionState;
        }
        
        return false;
    }
}
?>