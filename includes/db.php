<?php

class db {

    static private $host;
    static private $user;
    static private $password;
    static private $encoding;
    static private $dbname;
    static $pdo;

    static function connect($aConf) {
        db::$host = $aConf['host'];
        db::$user = $aConf['user'];
        db::$password = $aConf['password'];
        db::$dbname = $aConf['database'];
        db::$encoding = @$aConf['encoding'];
        $dsn = "mysql:host=" . db::$host . ";dbname=" . db::$dbname . ";charset=" . db::$encoding;
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        try {            
            db::$pdo = new PDO($dsn, db::$user, db::$password, $opt);            
        } catch (PDOException $e) {
            die('Can not create connection with MySQL');
        }
    }
    
    static private function debugQuery($sQuery, $aParams = NULL) {
        if ($aParams !== NULL) {
            $iCount = count($aParams);            
            foreach ($aParams as $key => $val) {
                if ($val === NULL || ( is_string($val) && $val == 'NULL')) {
                    $aParams[$key] = "NULL";
                } elseif (is_string($val)) {
                    $aParams[$key] = preg_replace("/\?/", "###___###", $aParams[$key]);
                    if (!get_magic_quotes_gpc()) {
                        $aParams[$key] = '\'' . addslashes($val) . '\'';
                    } else {
                        $val = stripslashes($val);
                        $aParams[$key] = '\'' . addslashes($val) . '\'';
                    }
                    $aParams[$key] = str_replace('\\', '\\\\', $aParams[$key]);
                    $aParams[$key] = str_replace('$', '\$', $aParams[$key]);
                }
            }
            $aPattern = @array_fill(0, $iCount, '/\?/');
            $sQuery = @preg_replace($aPattern, $aParams, $sQuery, 1);
            $sQuery = @preg_replace("/###___###/", "?", $sQuery);            
        }
        return $sQuery;
    }

    static function query($sQuery, $aParams = NULL, $isDebug = FALSE) {
        $query = db::$pdo->prepare($sQuery);
        $result = $query->execute($aParams);
        if ($isDebug) {
            dump(db::debugQuery($sQuery, $aParams));
            dump($result);
        }
        if ($result == false) {
            return false;
        }
        return $query;
    }

    static function get($sQuery, $aParams = NULL, $isDebug = FALSE, $NO_HTML_SPESIAL_CHARS = FALSE, $use_id = false) { 
        $result = db::query($sQuery, $aParams, $isDebug);
        $aResult = array();
        while ($aRow = $result->fetch()) {
            if ($NO_HTML_SPESIAL_CHARS) {
                foreach ($aRow as $key => $val) {
                    $aRow[$key] = @htmlspecialchars($val);
                }
            }
            if ($use_id === false) {
                $aResult[] = @$aRow;
            } elseif ($use_id === true) {
                $aResult[@$aRow['id']] = @$aRow;
            } else {
                $aResult[@$aRow[$use_id]] = @$aRow;
            }
        }
        return @$aResult;
    }

    static function get_pager($sQuery, $perPage = '', $aParams = NULL, $isDebug = false) {
        global $sPageListing;
        global $SEARCH_ROWS_MAX;
        if ($perPage) {
            $SEARCH_ROWS_MAX = $perPage;
        }
        $countQuery = preg_replace("/(SELECT )[\w\s,.\*\+\-\/]*( FROM)/", "SELECT COUNT(*) FROM", $sQuery, 1);
        $iCount = db::get_one($countQuery);
        if (!$iCount) {
            if ($isDebug) {
                dump(db::debugQuery($countQuery, $aParams));
                dump($iCount);
            }
            return null;
        }
        include_once (ABS . 'includes/page_listing.php');
        $limit = " LIMIT " . $start . ", " . $SEARCH_ROWS_MAX;
        $sQuery = $sQuery . $limit;
        $result = db::get($sQuery, $aParams, $isDebug);
        if ($result) {
            return $result;
        } else {
            return null;
        }
    }

    static function get_one($sQuery, $aParams = NULL, $isDebug = FALSE, $NO_HTML_SPESIAL_CHARS = FALSE) {
        $result = db::query($sQuery, $aParams, $isDebug);
        if (!$result) {
            return null;
        }
        $aRow = $result->fetch(); 
        if(is_array($aRow)){
            $value = array_shift($aRow);
        }else{
            $value = '';
        }
        if ($NO_HTML_SPESIAL_CHARS) {
            return htmlspecialchars($value);
        }
        return $value;
    }

    static function get_row($sQuery, $aParams = NULL, $isDebug = FALSE, $NO_HTML_SPESIAL_CHARS = FALSE) {
        $result = db::query($sQuery, $aParams, $isDebug);
        if (!$result) {
            return null;
        }
        $aRow = $result->fetch();
        if ($NO_HTML_SPESIAL_CHARS) {
            foreach ($aRow as $key => $val) {
                $aRow[$key] = htmlspecialchars($val);
            }
        }
        return @$aRow;
    }

    static function get_last_id() {
        $result = db::$pdo->lastInsertId() ;
        return $result;
    }
    
    static function beginTransaction(){
        db::$pdo->beginTransaction() ;
    }
    
    static function rollBack(){
        db::$pdo->rollBack() ;
    }
    
    static function commit(){
        db::$pdo->commit() ;
    }

    static function clear($txt) {
        $txt = str_ireplace(' WHERE ', '', $txt);
        $txt = str_ireplace(' OR ', '', $txt);
        $txt = str_ireplace(' DELETE ', '', $txt);
        $txt = str_ireplace(' SELECT ', '', $txt);
        $txt = str_ireplace(' UPDATE ', '', $txt);
        $txt = str_ireplace(' SET ', '', $txt);
        $txt = str_ireplace(' ALTER ', '', $txt);
        $txt = str_ireplace(' DROP ', '', $txt);
        $txt = str_ireplace('<script', '', $txt);
        return $txt;
    }
    
}

?>