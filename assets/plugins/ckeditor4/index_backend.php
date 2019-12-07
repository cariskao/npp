<?php
require("./connMysql.php");

$sql_load = "SELECT * FROM `index_backend` WHERE `id` = 2";
$mysql_member = mysqli_query($con, $sql_load);
$row_member = mysqli_fetch_assoc($mysql_member);

// Undefined index解决方法
// php提示Notice: Undefined index问题,Undefined index:是指你的代码里存在：“变量还未定义、赋值就使用”的错误，这个不是致命错误，不会让你的php代码运行强行中止，但是有潜在的出问题的危险......

$title = isset($_POST['title']) ? $_POST['title'] : '';
$schoolSelect = isset($_POST['schoolSelect']) ? $_POST['schoolSelect'] : '';
$text = isset($_POST['editor1']) ? $_POST['editor1'] : '';

// $sql = "INSERT INTO backend_index (title,school,context) VALUES ('$title','$schoolSelect', '$text')";
$sql = "UPDATE `index_backend` SET ";
$sql .= "`title` = '$title',`school` = '$schoolSelect',`context` = '$text'";
$sql .= "WHERE `id` = " . 2;

if (!(empty($title) || empty($schoolSelect) || empty($text))) {
   if ($con->query($sql) === TRUE) {
      // echo '<script>alert("更新成功");</script>';
      header('Location: ?update=success');
      exit();
   } else {
      echo "Error: " . $sql . "<br>" . $con->error;
      echo '<script>alert("更新失敗");</script>';
   }
   $con->close();
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
   <script src="./ckeditor/ckeditor.js"></script>
   <script>
      // 使用js的submit()
      /*
      function processData() {
         if (!empty($_POST['editor1']))
            setData = CKEDITOR.instances.editor1.setData($_POST['editor1']);
         var getData = CKEDITOR.instances.editor1.getData();
         alert(getData);
         form.submit();
      }*/
   </script>
</head>

<body>
   <h1>首頁後台<a href="index.php" style="font-size:20px">返回前台</a></h1>
   <div style="font-size:20px;color:red">
      <?php
      if (isset($_GET['update']) && $_GET['update'] === 'success') {
         echo '更新成功!';
      }
      ?>
   </div>
   <form action="" method="post" name="form">
      <input type="text" id="title" name="title" class="form-control" placeholder="文章標題" required>
      <input type="text" id="schoolSelect" name="schoolSelect" class="form-control" placeholder="學校" required>
      <textarea name="editor1" id="editor1">
      <?php
      if (mysqli_num_rows($mysql_member) > 0)
         echo $row_member['context'];
      ?>
      </textarea>
      <script>
         CKEDITOR.replace("editor1", {
            filebrowserBrowseUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserUploadUrl: 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
            filebrowserImageBrowseUrl: 'filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
            // width: 1000,
            // height: 800,
            // language: '',
            toolbarCanCollapse: true, // ui可縮起來
         });
      </script>
      <!-- 使用js的submit -->
      <!-- <input type="button" value="送出" onclick="processData()"> -->
      <input type="submit" value='送出'>
   </form>
   <fieldset style="margin-top:30px">
      <legend>結果顯示</legend>
      <?php
      if (mysqli_num_rows($mysql_member) > 0)
         echo $row_member['context'];
      else
         echo "尚未送出資料";
      ?>
   </fieldset>
</body>

</html>