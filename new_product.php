<?php

	session_start();
	
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if ($_SESSION["login"]!=true){
		$_SESSION["error2"]="ログインしてください";
		header ( "Location:login.php" );
		exit();
	}

    $con = mysqli_connect("localhost" , "root" , "root" , "zaiko2019_yse");
	mysqli_set_charset($con,"UTF8");

	function getLastid($con){
		$sql = "select * from books";
		$result = $con->query($sql);
		return $result->num_rows+1;
	}

	function newProduct($con){
		$id			=getLastid($con);
		$title		=$_POST["title"];
		$author		=$_POST["author"];
		$salesDate	=$_POST["salesDate"];
		$isbn		=$_POST["isbn"];
		$price		=$_POST["price"];
		$stock		=$_POST["stock"];
		$sql = "INSERT INTO `books`(`id`, `title`, `author`, `salesDate`, `isbn`, `price`, `stock`) VALUES ($id,$title,$author,$salesDate,$isbn,$price,$stock)";
		return $con->query($sql);
	}

	if(@$_POST["add"]=="ok"){
		if(newProduct($con)){
			$_SESSION['success']="新商品を追加しました";
			header("location:zaiko_ichiran.php");
		}
	}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>入荷</title>
	<link rel="stylesheet" href="css/ichiran.css" type="text/css" />
</head>
<body>
	<!-- ヘッダ -->
	<div id="header">
		<h1>新商品追加</h1>
	</div>

	<!-- メニュー -->
	<div id="menu">
		<nav>
			<ul>
				<li><a href="zaiko_ichiran.php">書籍一覧</a></li>
			</ul>
		</nav>
	</div>

	<form action="new_product.php" method="post">
		<div id="pagebody">
			<!-- エラーメッセージ -->
			<div id="error"><?php echo @$_SESSION['error'];@$_SESSION['error']="";?></div>
			<div id="center">
				<table>
					<thead>
						<tr>
							<th id="id">ID</th>
							<th id="book_name">書籍名</th>
							<th id="author">著者名</th>
							<th id="salesDate">発売日</th>
							<th id="itemPrice">ISBN</th>
							<th id="stock">金額(円)</th>
							<th id="in">在庫数</th>
						</tr>
					</thead>

						<tr>
							<td><?php echo	getLastid($con);?></td>
							<td><input type='text' name='title' size='5' maxlength='11' required></td>
							<td><input type='text' name='author' size='5' maxlength='11' required></td>
							<td><input type='text' name='salesDate' size='5' maxlength='11' required></td>
							<td><input type='text' name='isbn' size='5' maxlength='13' required></td>
							<td><input type='text' name='price' size='5' maxlength='11' required></td>
							<td><input type='text' name='stock' size='5' maxlength='11' required></td>
						</tr>

				</table>
				<button type="submit" id="kakutei" formmethod="POST" name="add" value="ok">確定</button>
			</div>
		</div>
	</form>
	<!-- フッター -->
	<div id="footer">
		<footer>株式会社アクロイト</footer>
	</div>
</body>
</html>
