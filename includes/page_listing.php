<?php
$s_page=1;
if (isset($_GET['pg'])) {
    $s_page = intval($_GET['pg']);
    $start = ($s_page-1) * $SEARCH_ROWS_MAX;
}else{
    $start=0;
}   
// prepare page listing
$aTmp = preg_split("/(&?pg=\d+)/", $_SERVER['REQUEST_URI']);
$moduleFile = '';
foreach ($aTmp as $val) {
    $moduleFile .= $val; 
}
if (strpos($moduleFile, '?')=== false) {
    $moduleFile .= '?';
}else{
    $moduleFile .= '&';
}
$countpage = @intval(($iCount - 1) / $SEARCH_ROWS_MAX) + 1;
if($countpage > $s_page + 3){
    $more_b = '...';
}else{
    $more_b = '';
}
if($s_page - 3 > 1){
    $more_m = '<li>...</li>';
}else{
    $more_m = '';
}
if ($s_page != 1){
        $pervpage = '<li><a  href="'.$moduleFile.'pg='. ($s_page - 1) .'" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>'.$more_m;
}
if ($s_page != $countpage){
    $nextpage = $more_b.' <li><a  href="'.$moduleFile.'pg='. ($s_page + 1) .'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>';
}
if($s_page - 3 > 0) $s_page3left = '<li><a  href= "'.$moduleFile.'pg='. ($s_page - 3) .'">'. ($s_page - 3) .'</a></li>';
if($s_page - 2 > 0) $s_page2left = '<li><a  href= "'.$moduleFile.'pg='. ($s_page - 2) .'">'. ($s_page - 2) .'</a></li>';
if($s_page - 1 > 0) $s_page1left = '<li><a  href= "'.$moduleFile.'pg='. ($s_page - 1) .'">'. ($s_page - 1) .'</a></li>';
if($s_page + 3 <= $countpage) $s_page3right = '<li><a  href= "'.$moduleFile.'pg='. ($s_page + 3) .'">'. ($s_page + 3) .'</a></li>';
if($s_page + 2 <= $countpage) $s_page2right = '<li><a  href= "'.$moduleFile.'pg='. ($s_page + 2) .'">'. ($s_page + 2) .'</a></li>';
if($s_page + 1 <= $countpage) $s_page1right = '<li><a  href= "'.$moduleFile.'pg='. ($s_page + 1) .'">'. ($s_page + 1) .'</a></li>';
if(@$iCount > $SEARCH_ROWS_MAX){
    $sPageListing = @$pervpage.@$s_page3left.@$s_page2left.@$s_page1left.'<li class="active"><a href="#">'.$s_page.'<span class="sr-only">(current)</span></a></li>'.@$s_page1right.@$s_page2right.@$s_page3right.@$nextpage;
}else{
    $sPageListing = '';
}
if($sPageListing){
    $sPageListing = '<nav><ul class="pagination">'.$sPageListing.'</ul></nav>';
}
?>