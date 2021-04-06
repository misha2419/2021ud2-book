<?php
include_once('config.php');

if (isset($_POST["submit"])) {

    $bookname =$_POST['bookname'];
    $booktype =$_POST['booktype'];
    $author =$_POST['author'];
    $publisher =$_POST['publisher'];
    $pubdate =$_POST['pubdate'];
    $price =$_POST['price'];
    $intro =$_POST['intro'];

try {
  $conn = new PDO("mysql:host=$servername;dbname=$bdname;charset=utf8", $username, $password);

  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  

  $sql = "INSERT INTO `book` (`bid`, `bookname`, `booktype`, `author`, `publisher`, `pubdate`, `price`, `intro`) VALUES (NULL, '$bookname', '$booktype', '$author', '$publisher', '$pubdate', '$price', '$intro')";
  $sth = $conn->prepare($sql);
  $sth->execute();
  //$ds = $sth->fetchAll(PDO::FETCH_ASSOC); 

  $msg = "資料新增成功";

} catch(PDOException $e) {
    $msg = "無法新增資料 Connection failed: " . $e->getMessage();
}

$conn = null;
}
?>

<?php include('header.html'); ?>
    
    <div class="container" id="main">
        <h1 class="text-center display-1 mt-5">圖書資料</h1>
        <?php
         if (isset($msg)) {
            echo '<p class="alert alert-success">'.$msg."</P>";
        }
        ?>
        
        <form action="" method="post">
            <div class="mb-3">
                <label for="bookname">書名</label>
                <input type="text" class="form-control" id="bookname" name="bookname" placeholder="請輸入書名" requied>
            </div>

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="booktype" id="inlineRadio1" value="1">
                <label class="form-check-label" for="inlineRadio1">平裝</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="booktype" id="inlineRadio2" value="2">
                <label class="form-check-label" for="inlineRadio2">精裝</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="booktype" id="inlineRadio3" value="3">
                <label class="form-check-label" for="inlineRadio3">盒裝</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="booktype" id="inlineRadio4" value="4">
                <label class="form-check-label" for="inlineRadio4">其他</label>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">作者</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="請輸入作者" required>
            </div>
            <div class="mb-3">
                <label class="publisher" for="publisher">出版社</label>
                <input type="text" class="form-control" id="publisher" name="publisher" placeholder="請輸入出版社" requied>
            </div>
            <div class="mb-3">
                <label for="pubdate">出版日期</label>
                <input type="date" class="form-control" id="pubdate" name="pubdate" value="<?php echo date('Y-m-d') ?>" requied>
            </div>
            <div class="mb-3">
                <label for="price">定價</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="請輸入定價" requied>
            </div>
            <div class="mb-3">
                <label for="intro" class="form-label">簡介</label>
                <textarea class="form-control" id="intro" name="intro" cols="80" rows="10"></textarea>
            </div>

            <div class="form-floating">
              <select class="form-select" id="floatingSelect" name="floatingSelect" aria-label="Floating label select example">
                <option selected>-打開選單-</option>
                <option value="1">懸疑</option>
                <option value="2">愛情</option>
                <option value="3">恐怖</option>
                <option value="4">科幻</option>
                <option value="5">其他</option>
              </select>
              <label for="floatingSelect">書本種類</label>
            </div>

            <div class="mb-3"></div>

            <div class="mb-3">
                <label for="exampleColorInput" class="form-label">顏色</label>
                <input type="color" class="form-control form-control-color" id="exampleColorInput" name="color" value="#563d7c" title="Choose your color">
            </div>
            
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">上傳封面</label>
                <input class="form-control" type="file" id="cover" name="cover" >
            </div>

            <div class="mb-3">
                <input type="checkbox" class="form-check-input" id="pubyn" name="pubyn">
                <label class="form-check-label" for="pubyn">是否公布</label>
            </div>

            <div>
            <button type="submit" class="btn btn-primary" name="submit">送出</button>
            </div>
        </form>
    </div>
    <?php include('footer.html'); ?>
