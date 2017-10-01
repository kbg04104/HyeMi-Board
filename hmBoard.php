<?php
/*--- 글쓰기 폼 ---*/
php?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title</title>
<style>

</style>
</head>
    <!--<h1 style="color: coral">HYEMI BOARD</h1>-->
    <body style="margin: auto; text-align: center; padding: 3%;">
        <form method="get" action="hm_db.php" name="hmBoard"">
         Title <input type = "text" id = "hm" name = "title" style="width: 30%"><br>
            <br>
            <textarea name="contents" cols="72" rows="20" ></textarea><br>
            <input type="button" value = "작성" onclick="titleman()">
            <input type="hidden" value="write" name="mode">
            <input type = "button" value="취소" onclick="deleteman()">
        </form>
    </body>
    <script>
        /*--- 제목 입력을 안했을 시 ---*/
        function titleman() {
            var title = document.getElementById("hm");
            if( title.value.trim() == '' ) {
                alert("제목을 입력하시오");
            }else
                document.hmBoard.submit();
        }
        /*--- 취소 버튼을 누르면 list로 ---*/
        function deleteman() {
            location.href = 'hm_list.php';
        }
    </script>
</head>
</html>

