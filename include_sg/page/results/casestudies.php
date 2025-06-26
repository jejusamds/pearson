<?php
    $cfg['page_code'] = "results/casestudies";
    include_once __DIR__."/../../lib/common.php";

    $boardName = "casestudies_en";
    $tableName = $cfg['db']['prefix']."board_".$boardName;
    $fileTableName = $cfg['db']['prefix']."boardFile";
    $pageDir = "/results/casestudies/";

    $boardCoreOnly = true;
    include_once __DIR__."/../board/board.core.php";
    include_once __DIR__."/../../header.php";
?>
<div class="sub_content_wrap">
    <div class="sub_content_box">
        <div class="sub_box">
            <div class="sub_loc">
                <div class="location">
                    <span>HOME</span>
                    <i></i>
                    <span>RESULTS</span>
                    <i></i>
                    <span>CASE STUDIES</span>
                </div>
            </div>
            <p class="sub_title ty02">Case Studies</p>
            <div class="sub_text results_sub01">
                <div class="contents_con">
                    <div class="txt_con">
                        <div class="text01_con">
                            <span>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </span>
                        </div>
                    </div>
                    <div class="list_con">
                        <ul>
<?php foreach($rs as $row){ ?>
                            <li>
                                <a href="<?=$pageDir?>?v=<?=$row['no']?>">
                                    <div class="list_div">
                                        <div class="title_con">
                                            <span>{{<?=$row['subject']?>}}</span>
                                        </div>
                                        <div class="img_con">
                                            <img src="<?=$row['files'][0]['originalSrc']?>" alt="logo" >
                                        </div>
                                        <div class="list_con">
                                            <ul>
                                                <li>
                                                    <div class="list_div">
                                                        <div class="img_con"><img src="/include_sg/images/sub/results_sub01_list_con_list_con_icon01.svg" alt="icon" ></div>
                                                        <div class="text01_con"><span><span class="color_text">Technology :</span> {{<?=$row['tmp1']?>}}</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="list_div">
                                                        <div class="img_con"><img src="/include_sg/images/sub/results_sub01_list_con_list_con_icon02.svg" alt="icon" ></div>
                                                        <div class="text01_con"><span><span class="color_text">Market :</span> {{<?=$row['tmp2']?>}}</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="list_div">
                                                        <div class="img_con"><img src="/include_sg/images/sub/results_sub01_list_con_list_con_icon03.svg" alt="icon" ></div>
                                                        <div class="text01_con"><span><span class="color_text">Project :</span> {{<?=$row['tmp3']?>}}</span></div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="list_div">
                                                        <div class="img_con"><img src="/include_sg/images/sub/results_sub01_list_con_list_con_icon04.svg" alt="icon" ></div>
                                                        <div class="text01_con"><span><span class="color_text">Result :</span> {{<?=$row['tmp4']?>}}</span></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </li>
<?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once __DIR__."/../board/board.paginate.php"; ?>
<?php include_once __DIR__."/../../footer.php"; ?>
