<?php
class app {
    
    public static function loadModel(){
        $aParams = func_get_args();
        $objectName = array_shift($aParams);
        $className = 'class_'.$objectName;
        $class = new ReflectionClass($className);
        if($class->hasMethod('__construct')){
            $obj = $class->newInstanceArgs($aParams);
        }else{
            $obj = $class->newInstance();
        }
        return $obj;
    }
    
    public static function auth($user, $pass, $success_redirect='', $failed_redirect=''){
        $login=db::get_one("SELECT login FROM ".PREF."admin_part WHERE login=? AND password=?",array(db::clear($user),md5($pass)));
        if(@$login){
            $_SESSION['admin_ids']=true;
            if($success_redirect){
                header("Location: ".$success_redirect);
                exit();
            }else{
                return true;
            }
        }else{
            if($failed_redirect){
                header("Location: ".$failed_redirect);
                exit();
            }else{
                return false;
            }
        }
    }
    
    public static function checkAuth($failed_redirect='login.php'){
        if(isset($_SESSION['admin_ids'])){
            return true;
        }else{
            if($failed_redirect){
                header("Location: ".$failed_redirect);
                exit();
            }else{
                return false;
            }
        }
    }
    
    public static function getSettings(){
        $aParams = db::get("SELECT * FROM ".PREF."settings");
        $aSettings = array();
        foreach($aParams as $k=>$v){
            $aSettings[$v['param']] = $v['value'];
        }
        return $aSettings;
    }
    
    public static function setSettings($param, $value){
        $ok = db::query("UPDATE ".PREF."settings SET value = ? WHERE param = ?", array($value, $param));
        return $ok;
    }
    
}