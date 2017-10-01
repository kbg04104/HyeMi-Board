<?php
//?searchName=title&searchValue=짱구

/*--- 데이터 받기 ---*/
$searchName = $_GET['searchName'];
$searchValue = $_GET['searchValue'];

//1.쿼리문
//2.DB에 쿼리 요청, 원하는 데이터받기
//3.결과값을~~~받아서~~~~~~~~~~~~~~~~~리스트 페이지에 나타내기
$db_conn = mysqli_connect("localhost","root","autoset","yjc_test");
$db_select = mysqli_select_db($db_conn, "ci_board");
$query = "select * from ci_board where $searchName like '%$searchValue%'";
$result = mysqli_query($db_conn,$query);
$row = mysqli_num_rows($result);
$cols = mysqli_num_fields($result);

/*for ( $i = 0 ; $row > $i ; $i++ ) {
    $array = mysqli_fetch_array($result);
    for ( $j = 0 ; $j < $cols ; $j++) {
        echo $array[$j];
    }
    echo "<br>";
}*/





?>