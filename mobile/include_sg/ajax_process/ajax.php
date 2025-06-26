<?php
include_once __DIR__ . "/../lib/common.php"; 

$result = array();

$result['post'] = $_POST;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['download_frm_first_name'];
    $lastName = $_POST['download_frm_last_name'];
    $companyName = $_POST['download_frm_company_name'];
    $email = $_POST['download_frm_email'];
    $regDate = date('Y-m-d H:i:s');
    $regIP = getIP();

    // 입력값 검증
    if (empty($firstName) || empty($lastName) || empty($companyName) || empty($email)) {
        $result['status'] = "empty";
    }

    // 데이터 삽입 쿼리 작성
    $dataSet = "
        first_name = ?,
        last_name = ?,
        company_name = ?,
        email = ?,
        regDate = ?,
        regip = ?
    ";

    $params = array(
        $firstName,
        $lastName,
        $companyName,
        $email,
        $regDate,
        $regIP
    );

    // 데이터베이스에 삽입
    $sql = Queryi("INSERT INTO pap_board_download_log_en SET $dataSet", $params);

    if ($sql['isInsert']) {
        //alert("다운로드 로그가 성공적으로 저장되었습니다.", $_SERVER['HTTP_REFERER']);
        $result['status'] = "success";
    } else {
        //alert("로그 저장 중 문제가 발생했습니다. 다시 시도해주세요.", $_SERVER['HTTP_REFERER']);
        $result['status'] = "error";
    }

    

    echo json_encode($result);
    exit;


}