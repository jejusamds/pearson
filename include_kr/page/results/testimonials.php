<?
        $cfg['page_code'] = "results/testimonials";
        include_once __DIR__."/../../lib/common.php";

        $boardName = "testimonials_kr";
        $tableName = $cfg['db']['prefix']."board_".$boardName;
        $fileTableName = $cfg['db']['prefix']."boardFile";
        $pageDir = "/results/testimonials/";

        include_once __DIR__."/../../header.php";
        include_once __DIR__."/../board/board.core.php";
        if($_GET['v'] != "" || $_GET['pl'] != ""){
                include_once __DIR__."/../board/skin.view.".$cfg['board']['skin']['view'][$boardName].".php";
        } else {
                include_once __DIR__."/../board/skin.list.".$cfg['board']['skin']['list'][$boardName].".php";
        }
        include_once __DIR__."/../../footer.php";
?>
