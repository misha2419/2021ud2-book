<?php
include_once('config.php');

try {
  $conn = new PDO("mysql:host=$servername;dbname=$bdname", $username, $password);

  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "SELECT * FROM `book`";
  $sth = $conn->prepare($sql);
  $sth->execute();
  $ds = $sth->fetchAll(PDO::FETCH_ASSOC); 

  //echo "Connected successfully";

} catch(PDOException $e) {
  echo "無法連接 Connection failed: " . $e->getMessage();
}

$conn = null;
?>

<!-- html hearder part -->
<?php include('header.html'); ?>

  <div class="container" id="main">
  <h1 class="text-center my-3">Book Store</h1>
  <table class="table">
    <tr>
      <td>書名</td>
      <td>作者</td>
      <td>出版社</td>
      <td>出版日期</td>
      <td>定價</td>
      <td>類型</td>
      <th><a href="db_add.php">新增</a></th>
    </tr>
    <?php
        foreach ($ds as $d){
          $btype = array('1'=>"平裝", '2'=>"精裝", '3'=>"盒裝", '4'=>"其他");
          echo "<tr>";
          echo '<td><a href="db_show.php?bid=' . $d['bid'] . '">';
          echo  $d['bookname'] ."</a></td>";
          echo "<td>". $d['author'] ."</td>";
          echo "<td>". $d['publisher'] ."</td>";
          echo "<td>". $d['pubdate'] ."</td>";
          echo "<td>". $d['price'] ."</td>";
          echo "<td>". $btype[$d['booktype']] ."</td>";
          echo "<td>";
          echo '<a href="db_edit.php?bid='. $d['bid']. '">修改 </a>';
          echo '<a href="db_delete.php?bid='. $d['bid'].'" onclick="return confirm(\'確定要刪除這筆資料嗎?\');">刪除</a>';
          echo "</td>";
          echo "</tr>";
        }
        ?>
  </table>
      </div>
      <?php include('footer.html'); ?>
