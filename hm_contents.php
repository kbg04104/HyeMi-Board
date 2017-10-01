<?php

session_start();

$id = $_GET['id'];
$subject = $_GET['sub'];
$contents = $_GET['con'];

if(isset($_SESSION['id'])){
    $nick = $_SESSION['name'];
    //echo "<script>document.getElementById('nickname').value =.".$_SESSION['name']."</script>";
}

/*--- DB연결 & 쿼리 넣기 --*/
$db_conn = mysqli_connect("localhost","root","autoset", "yjc_test");
$db_select = mysqli_select_db($db_conn,"ci_board");
$query = "select * from ci_board where board_id=$id";
$result = mysqli_query($db_conn,$query);

/*--- 조회수 올리기 ---*/
if(!isset($_COOKIE[$id])){
    setcookie($id, '', time() + 3600*24, '/');
    $query = "update ci_board set hits = hits+ +1 where board_id = $id";
    mysqli_query($db_conn, $query);
}

/*--- 글보기 형식 ---*/
echo "<table style= 'border: solid 1px #ffffff; padding: 5%; text-align: center ' width='1000' align='center'>";
while ($row = mysqli_fetch_array($result)) {

    echo "<tr>";
    echo "<td><h1>".$row[subject]."</h1></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<th>작성자</th>";
    echo "<td>".$row[user_name]."</td>";
    echo "<th>날짜</th>";
    echo "<td>".$row[reg_date]."</td>";
    echo "<tr>";
    echo "</tr>";
    echo "<tr>";
    echo "<th style='padding: 4%'>내용</th>";
    echo "<td>".$row[contents]."</td>";
    echo "</tr>";
    echo "</table>";

}

/*---- 수정 폼 ---*/
echo "<form align = 'center' id = 'editupdate' method = 'get' action='hm_edit.php' style='display: none'>";
echo "<input type= 'submit' value='수정╭( ･ㅂ･)و'>";
echo "<input type = 'hidden' name = 'mode' value='edit'>";
echo "<input type= 'hidden' name='id' value='$id'>";
echo "<input type = 'hidden' name = 'sub' value = '$subject'>";
echo "<input type = 'hidden' name = 'con' value= '$contents'>";
echo "</form>";
/*--- 삭제 폼 ---*/
echo "<form align = 'center' id = 'editdelete' method = 'get' action='hm_delete.php' style='display: none'>";
echo "<input type= 'submit' value='삭제( •᷄ὤ•᷅)？'>";
echo "<input type= 'hidden' name='mode' value='delete'>";
echo "<input type= 'hidden' name='id' value='$id'>";
echo "</form>";
/*--- 댓글 폼 ---*/
echo "<form style='margin: auto; text-align: center;' method='get' action='hm_coment.php'>";
echo "<table board = 1 style= 'border: solid 1px #ffffff; text-align: center ' width='100' align='center'>";
echo "<h2 style='text-align: center'>댓글창</h2>";
echo "<tr>";
echo "<h3 style='text-align: center; display: inline-block'>닉네임</h3>";
echo "<input style='width: 100px' type = text name = 'nick' id = 'nickname' value='$nick'>";
echo "<tr>";
echo "<td><textarea name='pid'></textarea></td>";
echo "<td><input type='submit' value = '입력'></td>";
echo "<input type='hidden' name='id' value='$id'>";
echo"</tr>";
echo "</table>";
echo "</form>";


$queryCom = "select * from ci_board where board_pid=$id";
$resultCom = mysqli_query($db_conn,$queryCom);

echo "<table border='1' style= 'border: solid 1px #ffffff; text-align: center ' width='300' align='center'>";
while($row = mysqli_fetch_array($resultCom))
    if($row['user_name']==''){
        echo "<tr><td>noname</td><td>".$row['contents']."</td></tr>";
    }else {
        echo "<tr><td>" . $row['user_name'] . "</td><td>" . $row['contents'] . "</td></tr>";
    }
echo "</table>";

/*--- 로그인이 됐을 때 ---*/
if(isset($_SESSION['id'])) {
    //수정, 삭제 폼이 보이게 함
    echo "<script>document.getElementById('editupdate').style.display='';</script>";
    echo "<script>document.getElementById('editdelete').style.display='';</script>";
}

?>