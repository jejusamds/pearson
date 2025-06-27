<?php
$cfg['page_code'] = "results/casestudies";
include_once __DIR__ . "/../../lib/common.php";

$boardName = "casestudies_kr";
$tableName = $cfg['db']['prefix'] . "board_" . $boardName;
$fileTableName = $cfg['db']['prefix'] . "boardFile";
$pageDir = "/results/casestudies/";

$boardCoreOnly = true;
include_once __DIR__ . "/../board/board.core.php";
include_once __DIR__ . "/../../header.php";
?>
<? include_once __DIR__ . "/../../header.php"; ?>
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
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                            </span>
                        </div>
                    </div>

                    <div class="list_con">
                        <ul>
                            <?php foreach ($rs as $row) { ?>
                                <li>
                                    <a href="/results/casestudies_view?v=<?=$row['no']?>">
                                        <div class="list_div">
                                            <div class="title_con">
                                                <span><?= $row['subject'] ?></span>
                                            </div>

                                            <div class="img_con">
                                                <img src="<?=$row['files'][0]['originalSrc']?>" alt="logo" >
                                            </div>

                                            <div class="list_con">
                                                <ul>
                                                    <li>
                                                        <div class="list_div">
                                                            <div class="img_con">
                                                                <img src="/include_sg/images/sub/results_sub01_list_con_list_con_icon01.svg"
                                                                    alt="아이콘">
                                                            </div>

                                                            <div class="text01_con">
                                                                <span>
                                                                    <span class="color_text"><?=$row['tmp1']?> :</span> <?=$row['tmp5']?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_div">
                                                            <div class="img_con">
                                                                <img src="/include_sg/images/sub/results_sub01_list_con_list_con_icon02.svg"
                                                                    alt="아이콘">
                                                            </div>

                                                            <div class="text01_con">
                                                                <span>
                                                                    <span class="color_text"><?=$row['tmp2']?> :</span> <?=$row['tmp6']?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_div">
                                                            <div class="img_con">
                                                                <img src="/include_sg/images/sub/results_sub01_list_con_list_con_icon03.svg"
                                                                    alt="아이콘">
                                                            </div>

                                                            <div class="text01_con">
                                                                <span>
                                                                    <span class="color_text"><?=$row['tmp3']?> :</span> <?=$row['tmp7']?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="list_div">
                                                            <div class="img_con">
                                                                <img src="/include_sg/images/sub/results_sub01_list_con_list_con_icon04.svg"
                                                                    alt="아이콘">
                                                            </div>

                                                            <div class="text01_con">
                                                                <span>
                                                                    <span class="color_text"><?=$row['tmp4']?> :</span> <?=$row['tmp8']?>
                                                                </span>
                                                            </div>
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
            </div> <!--   sub_text end   -->
        </div> <!--    sub_box end   -->
    </div><!--   sub_content_box end   -->
</div><!--  sub_content_wrap end   -->

<? include_once __DIR__ . "/../../footer.php"; ?>