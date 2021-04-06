<?php
include_once('config.php');

if (isset($_GET['bid'])) {

    $bid = $_GET['bid'];
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$bdname", $username, $password);
      
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $sql = "SELECT * FROM `book` WHERE `book`.`bid`=".$bid;
      $sth = $conn->prepare($sql);
      $sth->execute();
      $ds = $sth->fetchAll(PDO::FETCH_ASSOC);
      $d = $ds[0];

      // print_r($d);
    
      // foreach ($ds as $d) {
      // echo "書名:" . $d['bookname'];
      //  echo "作者:" . $d['author'];
      //  echo "<hr>";
      // }
    
    } catch(PDOException $e) {
    
      echo "無法連線 Connection failed: " . $e->getMessage();
    
    }
    
    $conn = null;

} else {

  header("Location:blist.php");

}
?>
<?php include('header.html'); ?>

  <div class="container"  id="main">
  <h1 class="text-center my-3">Book details</h1>
  <table class="table">
    <tr><th nowrap>出版日期</th><td><?php echo $d['pubdate'];?></td></tr>
    <tr><th>書名</th><td><?php echo $d['bookname'];?></td>   </tr>
    <tr><th>作者</th><td><?php echo $d['author'];?></td></tr>
    <tr><th>出版社</th><td><?php echo $d['publisher'];?></td></tr>
    <tr><th>定價</th><td><?php echo $d['price'];?></td></tr>
    <tr><th>類型</th><td><?php echo $d['booktype'];?></td></tr>
    <tr><th>內容</th><td><?php echo nl2br($d['intro']);?></td></tr>
    </tr>
<?php
    $btype = array('1'=>"平裝", '2'=>'精裝', '3'=>'盒裝', '4'=>'其他');   
?>    
  </table>

  </div>
  <?php include('footer.html'); ?>