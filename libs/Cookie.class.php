<?php
class Cookie {
    
    public $cookieName = null;      # @var string
    public $cookieValue = null;     # @var string
    public $cookieExpire = null;    # @var int (Timestamp)
    public $cookiePath = null;      # @var string (Default path)
    public $cookieDomain = null;    # @var string (Default domain)
    public $cookieSecure = false;   # @var bool (HTTPS)
    public $cookieHttpOnly = false;  # @var bool
    
    private $cookieErrorReport = "Faild to the Cookie";
    
    public function __construct() { }
    
    public function create($name, $value, $day, $path, $secure = false, $httpOnly = true) {
        $this->cookieName = $name;
        $this->cookieValue = $value;
        $this->cookieExpire = $this->setExpirationDate($day);
        $this->cookiePath = $path;
        $this->cookieSecure = $this->isSecure();
        $this->cookieHttpOnly = $httpOnly || true;
        
        $this->setCookies();
    }
    
    private function isSecure() {
        if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
            return true;
        } else {
            return false;
        }
    }
    
    private function setExpirationDate($day) {
        $toTime = (time() + ((($day * 24) * 60) * 60));
        return $toTime;
    }
    
    private function setCookies() {
        if(!setcookie($this->cookieName, $this->cookieValue, $this->cookieExpire, $this->cookiePath, $this->cookieDomain, $this->cookieSecure, $this->cookieHttpOnly)) {
            throw new Exception($this->cookieErrorReport);
        }
    }
    
    public function getCookie($name) {
        return (isset($_COOKIE[$name])) ? true : false;
    }
    
    public function deleteCookies($name, $value = '', $exp = 3600) {
        $this->cookieName = $name;
        $this->cookieValue = $value;
        $this->cookieExpire = (time() - $exp);
        
        $this->setCookies();
    }
}
?>