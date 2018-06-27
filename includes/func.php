<?php
function dump($var){
    echo("<pre>");
    	print_r($var);
    echo("</pre><hr>\n");
}

function  del_dir($dirname)  {
        if  (is_dir($dirname))
                $dir_handle  =  @opendir($dirname);
        if  (!@$dir_handle)
                return  false;
        while($file  =  readdir($dir_handle))  {
                if  ($file  !=  "."  &&  $file  !=  "..")  {
                        if  (!is_dir($dirname."/".$file))
                                unlink($dirname."/".$file);
                        else
                                del_dir($dirname.'/'.$file);                       
                }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return  true;
}

function check_auth($fail_redirect=''){
    if(isset($_SESSION['user_cookie415'])){
        $aAuth = $_SESSION['user_cookie415'];
        return $aAuth;
    }else{
        if($fail_redirect){
            header('Location: '.$fail_redirect);die;
        }else{
            return false;
        }
    }
}

function getTimezones(){
    $timezones = DateTimeZone::listIdentifiers();
    $zones = array();
    foreach( $timezones as $key => $zone ){
        $dateTimeZone = new DateTimeZone($zone);
        $dateTime = new DateTime("now", $dateTimeZone);
        $gmtOffset = secToHoursMin($dateTimeZone->getOffset($dateTime));
        $zones[$zone] = 'GMT '. ($gmtOffset['h'] >= 0 ? '+'.$gmtOffset['h'] :  $gmtOffset['h']).":".(abs($gmtOffset['m']) >= 10 ? abs($gmtOffset['m']) : abs($gmtOffset['m']).'0');
    }
    return @$zones ? $zones : false;
}

function secToHoursMin($seconds){
    if($seconds >= 0){
        $sign = 1;
    }else{
        $sign = -1;
    }
    $absSeconds = abs($seconds);
    $hours = floor($absSeconds/3600);
    if($hours > 0){
        $rest = $absSeconds - $hours*3600;
        $minutes= floor($rest/60);
        
    }else{
        $minutes= floor($absSeconds/60);        
    }
    if($minutes >= 0 and $minutes < 10){
        $minutes = '0'.$minutes;
    }
    if($sign < 0){
        $minutes = '-'.$minutes;
    }
    return array('h'=>$hours*$sign,'m'=>$minutes);
}

function time2seconds($time='00:00:00'){
    list($hours, $mins, $secs) = explode(':', $time);
    return ($hours * 3600 ) + ($mins * 60 ) + $secs;
}

function HMtoDec($hours){
    $aHM = explode(':', $hours);
    $decMin = round($aHM[1]/60, 2);
    $decHours = $aHM[0]+$decMin;
    return $decHours;
}

function timeRange($start, $end, $step){
    $aStart = date_parse($start);
    $aEnd = date_parse($end);
    if($aEnd['hour'] < $aStart['hour']){
        $lastMonthDay = get_last_day_of_month($aEnd['month'], $aEnd['year']);
        if($aEnd['day'] < $lastMonthDay){
            $aEnd['day']++;
        }else{
            $aEnd['day'] = 1;
            if($aEnd['month'] < 12){
                $aEnd['month']++;
            }else{
                $aEnd['month'] = 1;
                $aEnd['year']++;
            }
        }
    }
    
    $aRange = array();
    $startMin = $aStart['month'].'/'.$aStart['day'].'/'.$aStart['year'].' '.$aStart['hour'].':'.$aStart['minute'];
    $endMin = $aEnd['month'].'/'.$aEnd['day'].'/'.$aEnd['year'].' '.$aEnd['hour'].':'.$aEnd['minute'];
    $startTS = strtotime($startMin);
    $endTS = strtotime($endMin);
    $k = 0;
    for($i = $startTS;$i < $endTS;$i+=$step*3600){ 
        $aRange[$k]['s'] = strftime('%H:%M',$i);
        $aRange[$k]['e'] = strftime('%H:%M',$i+$step*3600);
        $k++;
    }
    if(!empty($aRange)) return $aRange;
    else return false;
}

function decimal_to_time($dec) {
    $seconds = $dec * 3600;
    $hours = floor($dec);
    $seconds -= $hours * 3600;
    $minutes = floor($seconds / 60);
    $seconds -= $minutes * 60;
    return lz($hours).":".lz($minutes);
}

function lz($num){
    return (strlen($num) < 2) ? "0{$num}" : $num;
}

function time_to_decimal($time) {
    $timeArr = explode(':', $time);
    $decTime = $timeArr[0] + ($timeArr[1]/60) + (@$timeArr[2]/60); 
    return $decTime;
}

function date_us2db ($date) {
	//m?*d?*yy* => yyyy.mm.dd
	if ($date === '')
		return '';
	@list ($month, $day, $year) = preg_split ("/\//", trim($date));
	if (@checkdate($month, $day, $year))
	    return '20'.$year.'-'.$month.'-'.$day;
	else
	    return '';
}

function get_last_day_of_month($mm, $yy) {
    for ($dd = 28; $dd <= 31; $dd++) {
        $tdate = getdate(mktime(0, 0, 0, $mm, $dd, $yy));
        if ($tdate["mon"] != $mm)
        	break;
    }
    $dd--;
    return $dd;
}

function get_month_name($m){
    global $aLang;
    switch($m){
        case 1: $mn = $aLang['January'];break;
        case 2: $mn = $aLang['February'];break;
        case 3: $mn = $aLang['March'];break;
        case 4: $mn = $aLang['April'];break;
        case 5: $mn = $aLang['May'];break;
        case 6: $mn = $aLang['June'];break;
        case 7: $mn = $aLang['July'];break;
        case 8: $mn = $aLang['August'];break;
        case 9: $mn = $aLang['September'];break;
        case 10: $mn = $aLang['October'];break;
        case 11: $mn = $aLang['November'];break;
        case 12: $mn = $aLang['December'];break;
    }
    return $mn;
}

function get_short_month_name($m){
    global $aLang;
    switch($m){
        case 1: $mn = $aLang['Jan'];break;
        case 2: $mn = $aLang['Feb'];break;
        case 3: $mn = $aLang['Mar'];break;
        case 4: $mn = $aLang['Apr'];break;
        case 5: $mn = $aLang['May'];break;
        case 6: $mn = $aLang['Jun'];break;
        case 7: $mn = $aLang['Jul'];break;
        case 8: $mn = $aLang['Aug'];break;
        case 9: $mn = $aLang['Sep'];break;
        case 10: $mn = $aLang['Oct'];break;
        case 11: $mn = $aLang['Nov'];break;
        case 12: $mn = $aLang['Dec'];break;
    }
    return $mn;
}

function get_short_month_name_en($m){
    switch($m){
        case 1: $mn = 'Jan';break;
        case 2: $mn = 'Feb';break;
        case 3: $mn = 'Mar';break;
        case 4: $mn = 'Apr';break;
        case 5: $mn = 'May';break;
        case 6: $mn = 'Jun';break;
        case 7: $mn = 'Jul';break;
        case 8: $mn = 'Aug';break;
        case 9: $mn = 'Sep';break;
        case 10: $mn = 'Oct';break;
        case 11: $mn = 'Nov';break;
        case 12: $mn = 'Dec';break;
    }
    return $mn;
}

function sortableHeader($name, $link, $sort_param, $sort_order, $default = false, $selected_sort_param=''){
    if(strstr($link, '?')){
        $glue = '&';
    }else{
        $glue = '?';
    }
    if(empty($sort_order) or $sort_order == 'DESC'){
        $sorting = 'ASC';
    }else{
        $sorting = 'DESC';
    }
    echo '<a href="'. $link.$glue.'ordby='.$sort_param.'&ord='.$sorting.'" class="sortingHeader">
                    '.$name;
    if($selected_sort_param == $sort_param or ($default and !$selected_sort_param)){
        if(empty($sort_order) or $sort_order == 'ASC'){
            $arrow_ending = 'top';
        }else{
            $arrow_ending = 'bottom';
        }
        echo ' <span class="glyphicon glyphicon-triangle-'.$arrow_ending.'" aria-hidden="true"></span>';
    }                   
    echo '</a>';
}

function generate_password($length = 8,$number=false) {
    srand((double)microtime()*1000000);
    if($number){
        $min= pow(10,$length-1);
        $max= pow(10,$length)-1;
        $unique_str = rand($min,$max);
    }else{
        $unique_str = md5(rand(0,9999999));
        $unique_str = substr( $unique_str, 0, $length);
    }
    return $unique_str;
}

function post_curl_request($url, $data){
    $sData = '';
    if(is_array($data)){
        $aData = array();
        foreach($data as $k=>$v){
            if(is_array($v)){
                foreach($v as $paramItemVal){
                    $aData[] = $k.'='.urlencode($paramItemVal);
                }
            }else{
                $aData[] = $k.'='.urlencode($v);
            }
        }
        $sData.= implode('&', $aData);
    }
    //$url.=$sData; 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_TIMEOUT, 300);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $sData); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_DNS_USE_GLOBAL_CACHE,FALSE);
    $result = curl_exec($ch); //dump($result);
    return $result; 
}

function download($filename, $mimetype='image/jpeg') {
	if (!file_exists($filename)) die('File not found');

	$from=$to=0; $cr=NULL;

	if (isset($_SERVER['HTTP_RANGE'])) {
		$range=substr($_SERVER['HTTP_RANGE'], strpos($_SERVER['HTTP_RANGE'], '=')+1);
		$from=strtok($range, '-');
		$to=strtok('/'); if ($to>0) $to++;
		if ($to) $to-=$from;
		header('HTTP/1.1 206 Partial Content');
		$cr='Content-Range: bytes ' . $from . '-' . (($to)?($to . '/' . $to+1):filesize($filename));
	} else	header('HTTP/1.1 200 Ok');

	$etag=md5($filename);
	$etag=substr($etag, 0, 8) . '-' . substr($etag, 8, 7) . '-' . substr($etag, 15, 8);
	header('ETag: "' . $etag . '"');

	header('Accept-Ranges: bytes');
	header('Content-Length: ' . (filesize($filename)-$to+$from));
	if ($cr) header($cr);

	header('Connection: close');
	header('Content-Type: ' . $mimetype);
	header('Last-Modified: ' . gmdate('r', filemtime($filename)));
	$f=fopen($filename, 'r');
	header('Content-Disposition: attachment; filename="' . basename($filename) . '";');
	if ($from) fseek($f, $from, SEEK_SET);
	if (!isset($to) or empty($to)) {
		$size=filesize($filename)-$from;
	} else {
		$size=$to;
	}
	$downloaded=0;
	while(!feof($f) and !connection_status() and ($downloaded<$size)) {
		echo fread($f, 512000);
		$downloaded+=512000;
		flush();
	}
	fclose($f);
}

if (!function_exists('file_put_contents')) {
    function file_put_contents($filename, $data) {
        $f = @fopen($filename, 'w');
        if (!$f) {
            return false;
        } else {
            $bytes = fwrite($f, $data);
            fclose($f);
            return $bytes;
        }
    }
}

if (!function_exists('scandir')) {
    function scandir($dir) {
        $dh  = opendir($dir);
        while (false !== ($filename = readdir($dh))){
            $files[] = $filename;
        }
        sort($files);
        return $files;
    }
}

function sort_array($array,$key,$type='asc'){
    $sorted_array = array();
    if(@is_array($array) and count($array)>0){
        foreach($array as $k=>$row){
            @$key_values[$k] = $row[$key];
        }
        if($type == 'asc' ){
            asort($key_values);
        }
        else{
            arsort($key_values);
        }
        foreach($key_values as $k=>$v){
           $sorted_array[] = $array[$k];
        }
        return $sorted_array;
    }
    else{
        return false;
    }

}

function translit($str){
    $tr = array(
    "А"=>"A","Б"=>"B","В"=>"V","Г"=>"G",
    "Д"=>"D","Е"=>"E","Ж"=>"J","З"=>"Z","И"=>"I",
    "Й"=>"Y","К"=>"K","Л"=>"L","М"=>"M","Н"=>"N",
    "О"=>"O","П"=>"P","Р"=>"R","С"=>"S","Т"=>"T",
    "У"=>"U","Ф"=>"F","Х"=>"H","Ц"=>"TS","Ч"=>"CH",
    "Ш"=>"SH","Щ"=>"SCH","Ъ"=>"","Ы"=>"Y","Ь"=>"",
    "Ї"=>"yi","Є"=>"E","І"=>"i",
    "Э"=>"E","Ю"=>"YU","Я"=>"YA","а"=>"a","б"=>"b",
    "в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
    "з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
    "м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
    "с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
    "ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
    "ы"=>"y","ь"=>"","э"=>"e","ё"=>"e","ю"=>"yu","я"=>"ya",
    "ї"=>"yi","є"=>"e","і"=>"i"
    );
    $result = strtr($str,$tr);
    $result = strtolower($result);
    $result=preg_replace('/[^\.0-9a-zA-Z ]/', '', $result);
    $result = str_replace(' ','-',$result);
    return $result;
}

function phone_number_format($number){
    $sect2 = substr($number,-4);
    $sect1 = substr($number,-7,3);
    $code = substr($number,-10,3);
    return $code."-".$sect1."-".$sect2;
}

function cropStr($str, $size){ 
    if(mb_strlen($str) > $size){
        $ending = '...';
    }else{
        $ending = '';
    }
    return mb_substr($str,0,$size,'utf-8').$ending;  
}

function bytesToKb($val){
    return round($val/1024);
}

function language_link($link, $lang){
    if(strstr($link, '://')){
        return $link;
    }else{
        return substr(HOST, 0, strlen(HOST)-1).($lang=='en' ? '' : ('/'.$lang)).$link;
    }
}

function array_to_csv($header,$data,$file_name, $cell_separator=';'){
    header( 'Content-Type: text/csv' );
    header( 'Content-Disposition: attachment;filename='.$file_name );
    if(count($data) == 0){
        echo "Data empty";
    }else{
        $header_count = count($header);
        if(count(current($data)) != $header_count){
            echo 'Header doesn\'t match data rows';
        }else{
            $header_row = '';
            foreach($header as $k=>$h){
                if($k<$header_count-1){
                    $separator = $cell_separator;
                }else{
                    $separator = '';
                }
                $header_row.='"'.str_replace('"', '""',$h).'"'.$separator;
            }
            $data_rows = '';
            foreach($data as $d){
                $count_data_row = count($d);                
                $i = 0;
                foreach($d as $n=>$v){
                    if($i<$count_data_row-1){
                        $separator = $cell_separator;
                    }else{
                        $separator = '';
                    }
                    $data_rows.='"'.str_replace('"', '""',$v).'"'.$separator;
                    $i++;
                }
                $data_rows.="\r\n";
            }
            $csv = $header_row."\r\n".$data_rows;
            echo $csv;
        }
    }
}

function getClientIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP'])){
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function escapePostGet() {    
    if (!empty($_POST)) {
       foreach ($_POST as $key => $value) {
           if(is_array($value)){
               foreach($value as $k=>$val){
                   if(is_array($val)){
                       foreach($val as $n=>$v){
                           $_POST[$key][$k][$n] = htmlspecialchars($v, ENT_QUOTES);
                       }
                   }else{
                        $_POST[$key][$k] = htmlspecialchars($val, ENT_QUOTES);
                   }
               }
           }else{
                $_POST[$key] = htmlspecialchars($value, ENT_QUOTES);
           }
       }
    }    
    if (!empty($_GET)) {
       foreach ($_GET as $key => $value) {
           $_GET[$key] = htmlspecialchars($value, ENT_QUOTES);
       }
    }
}

?>
