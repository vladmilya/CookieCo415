<?php
include_once '../includes/common.php';
app::checkAuth();

$activeMenu = 'pages';

$pageId = isset($_GET['id']) ? intval($_GET['id']) : 1;

$aPages = $oPages->get_pages_headers();

foreach($aPages as $p){
    $page = array();
    $page['title'] = $p['title'];
    $page['url'] = 'pages.php?id='.$p['id'];
    $page['active'] = $pageId == $p['id'] ? true : false;
    $aSubmenu[] = $page;
}

if($pageId){ 
    
    $aItem = $oPages->get_page_admin($pageId);
    
    if(isset($_GET['del_header_img'])){
        $ok = $oPages->del_top_img($pageId);
        header('Location: pages.php?id='.$pageId.'&updated=1');
        exit();
    }
    
    if(!empty($_GET['section'])){
        if(isset($_GET['del_sect_img_en'])){
            $ok = $oPages->del_section_img($_GET['section'], 'en');
            header('Location: pages.php?id='.$pageId.'&section='.$_GET['section'].'&updated=1#edit_section');
            exit();
        }
        if(isset($_GET['del_sect_img_fr'])){
            $ok = $oPages->del_section_img($_GET['section'], 'fr');
            header('Location: pages.php?id='.$pageId.'&section='.$_GET['section'].'&updated=1#edit_section');
            exit();
        }
    }
    
    if(isset($_GET['del_section'])){
        $ok = $oPages->delete_section($_GET['del_section']);
        header('Location: pages.php?id='.$pageId.'&updated=1');
        exit();
    }
    
    if(isset($_POST['sent'])){
        $ok = $oPages->edit_page($pageId);
        if($ok == 'ok') {
            header('Location: pages.php?id='.$pageId.'&updated=1'); 
            exit();
        }
        else $error = $ok;
    }
    
    if(!empty($_GET['section'])){
        if(isset($_POST['sent_section'])){
            $ok = $oPages->edit_section($_GET['section']);
            if($ok == 'ok') {
                header('Location: pages.php?id='.$pageId.'&updated=1'); 
                exit();
            }
            else $error = $ok;
        }
    }
    if(isset($_GET['section']) and intval($_GET['section']) == 0){
        if(isset($_POST['sent_section'])){
            $ok = $oPages->add_section($aItem['alias']);
            if($ok == 'ok') {
                header('Location: pages.php?id='.$pageId.'&updated=1'); 
                exit();
            }
            else $error = $ok;
        }
    }

    $aSections = $oPages->get_fixed_sections($aItem['alias']);

}

include 'templates/pages_tpl.php';