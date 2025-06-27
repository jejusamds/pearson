<?php
$cfg['page_code'] = "results/casestudies_view";
include_once __DIR__ . "/../../lib/common.php";

$boardName = "casestudies_kr";
$tableName = $cfg['db']['prefix'] . "board_" . $boardName;
$fileTableName = $cfg['db']['prefix'] . "boardFile";
$pageDir = "/results/casestudies/";


$boardCoreOnly = true;
include_once __DIR__ . "/../board/board.core.php";
if ($_GET['v'] != "" || $_GET['pl'] != "") {
    if ($_COOKIE[md5("cki_" . $boardName . "_" . $self['no'] . "_hit")] != base64_encode($self['no'])) {
        try {
            Queryi("UPDATE $tableName SET hit = hit + 1 WHERE no = ?", array($self['no']));
        } catch (PDOException $e) {
            // do nothing on error
        }
        setcookie(md5("cki_" . $boardName . "_" . $self['no'] . "_hit"), base64_encode($self['no']), time() + (86400 * 36500), "/", $_SERVER["SERVER_NAME"]);
    }
}
include_once __DIR__ . "/../../header.php";
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
                            <span><?= $self['subject'] ?></span>
                        </div>

                        <div class="info_con">
                            <ul>
                                <li>
                                    <div class="list_div">
                                        <div class="writer_con">
                                            <div class="writer_con"><span><?= $self['name'] ?></span></div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_div">
                                        <div class="text01_con">
                                            <span>
                                                Date
                                            </span>
                                        </div>

                                        <div class="text02_con">
                                            <span><?= date('Y.m.d', strtotime($self['regDate'])) ?></span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="list_div">
                                        <div class="text01_con">
                                            <span>
                                                View
                                            </span>
                                        </div>

                                        <div class="text02_con">
                                            <div class="text02_con"><span><?= $self['hit'] ?></span></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <?php
                        if ($self['files'][3]['realName']) { ?>
                            <div class="file_con">
                                <a
                                    href="<?= $cfg['href'] ?>/board/board.download_new/?b=<?= $boardName ?>&n=<?= $self['files'][3]['no'] ?>"><?= $self['files'][3]['realName'] ?></a>

                            </div>
                        <?php } ?>
                    </div>

                    <div class="posts_con">
                        <?= $self['content'] ?>
                    </div>

                    <div class="btn_con">
                        <a href="/results/casestudies/">
                            List
                        </a>
                    </div>
                </div>
            </div> <!--   sub_text end   -->

        </div> <!--    sub_box end   -->
    </div><!--   sub_content_box end   -->
</div><!--  sub_content_wrap end   -->

<? include_once __DIR__ . "/../../footer.php"; ?>