<?php
    $cfg['page_code'] = "results/casestudies_view";
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
                    <span>CASESTUDIES</span>
                </div>
            </div>
            <p class="sub_title ty02">Case Studies</p>
            <div class="sub_text results_sub01_view">
                <div class="contents_con">
                    <div class="title_txt">
                        <div class="title_con">
<<<<<<< o4is5m-codex/관리자-화면-casestudies-메뉴-수정-및-동적화
                            <span>{{<?=$self['subject']?>}}</span>
=======
                            <span><?=$self['subject']?></span>
>>>>>>> main
                        </div>
                        <div class="info_con">
                            <ul>
                                <li>
                                    <div class="list_div">
<<<<<<< o4is5m-codex/관리자-화면-casestudies-메뉴-수정-및-동적화
                                        <div class="writer_con"><span>{{<?=$self['name']?>}}</span></div>
=======
                                        <div class="writer_con"><span><?=$self['name']?></span></div>
>>>>>>> main
                                    </div>
                                </li>
                                <li>
                                    <div class="list_div">
                                        <div class="text01_con"><span>Date</span></div>
<<<<<<< o4is5m-codex/관리자-화면-casestudies-메뉴-수정-및-동적화
                                        <div class="text02_con"><span>{{<?=date('Y.m.d', strtotime($self['regDate']))?>}}</span></div>
=======
                                        <div class="text02_con"><span><?=date('Y.m.d', strtotime($self['regDate']))?></span></div>
>>>>>>> main
                                    </div>
                                </li>
                                <li>
                                    <div class="list_div">
                                        <div class="text01_con"><span>View</span></div>
<<<<<<< o4is5m-codex/관리자-화면-casestudies-메뉴-수정-및-동적화
                                        <div class="text02_con"><span>{{<?=$self['hit']?>}}</span></div>
=======
                                        <div class="text02_con"><span><?=$self['hit']?></span></div>
>>>>>>> main
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <?php if($self['files'][3]['realName']){ ?>
                        <div class="file_con">
<<<<<<< o4is5m-codex/관리자-화면-casestudies-메뉴-수정-및-동적화
                            <a href="<?=$cfg['href']?>/board/download.php?t=<?=$boardName?>&n=<?=$self['files'][3]['no']?>">{{<?=$self['files'][3]['realName']?>}}</a>
=======
                            <a href="<?=$cfg['href']?>/board/download.php?t=<?=$boardName?>&n=<?=$self['files'][3]['no']?>"><?=$self['files'][3]['realName']?></a>
>>>>>>> main
                        </div>
                        <?php } ?>
                    </div>
                    <div class="posts_con">
<<<<<<< o4is5m-codex/관리자-화면-casestudies-메뉴-수정-및-동적화
                        {{<?=$self['content']?>}}
=======
                        <?=$self['content']?>
>>>>>>> main
                    </div>
                    <div class="btn_con">
                        <a href="<?=$pageDir?>">List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once __DIR__."/../../footer.php"; ?>
