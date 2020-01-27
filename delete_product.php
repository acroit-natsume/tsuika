<?php
/* 
【機能】
書籍の出荷数を指定する。確定ボタンを押すことで確認画面へ出荷個数を引き継いで遷移す
る。

【エラー一覧（エラー表示：発生条件）】
このフィールドを入力して下さい(吹き出し)：出荷個数が未入力
出荷する個数が在庫数を超えています：出荷したい個数が在庫数を超えている
数値以外が入力されています：入力された値に数字以外の文字が含まれている
*/

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	function getId($id,$con){
		$sql = "select * from books";
		$result = $con->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				return $row;
			}	
		}
	}
	$con = mysqli_connect("localhost" , "root" , "root" , "zaiko2019_yse");
	mysqli_set_charset($con,"UTF8");
	$sql = "select * from books";
	$rst = mysqli_query($con,$sql) or die("select失敗".mysqli_error($con));


?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>出荷</title>
<link rel="stylesheet" href="css/ichiran.css" type="text/css" />
</head>
<body>
<!-- ヘッダ -->
<div id="header">
	<h1>商品削除</h1>
</div>

<!-- メニュー -->
<div id="menu">
	<nav>
		<ul>
			<li><a href="zaiko_ichiran.php?page=1">書籍一覧</a></li>
		</ul>
	</nav>
</div>

<form action="syukka_kakunin.php" method="post">
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
						<th id="itemPrice">金額(円)</th>
						<th id="stock">在庫数</th>
					</tr>
				</thead>

                                <tr>
                                        <td>1</td>
                                        <td>レイリ(6)</td>
                                        <td>岩明均/室井大資</td>
                                        <td>2017年04月07日</td>
                                        <td>648</td>
                                        <td>50</td>
                                </tr>

                                <tr>
                                        <td>2</td>
                                        <td>弱虫ペダル（50）</td>
                                        <td>渡辺航</td>
                                        <td>2017年04月07日</td>
                                        <td>463</td>
                                        <td>24</td>
                                </tr>

                                <tr>
                                        <td>3</td>
                                        <td>セトウツミ（7）</td>
                                        <td>此元和津也</td>
                                        <td>2017年04月07日</td>
                                        <td>463</td>
                                        <td>67</td>
                                </tr>

			</table>
			<button type="submit" id="kakutei" formmethod="POST" name="decision" value="1">確定</button>
		</div>
	</div>
</form>
<!-- フッター -->
<div id="footer">
	<footer>株式会社アクロイト</footer>
</div>
</body>
</html>
