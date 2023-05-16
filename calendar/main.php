<?php
// データベースの接続情報
$host = "localhost";
$userName = "tatsuya";
$password = "pw1234";
$dbName = "calendar";

$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";

try {
    // データベースへの接続
    $pdo = new PDO($dsn, $userName, $password);
    // エラーモードを例外モードに設定
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // イベントの追加
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $event = $_POST["event"];
        $date = $_POST["date"];
        
        if (empty($event) || empty($date)) {
            echo "イベント名と日付は必須です。";
        } else {
         
            $stmt = $pdo->prepare("INSERT INTO events (event, date) VALUES (:event, :date)");
            $stmt->bindParam(':event', $event);
            $stmt->bindParam(':date', $date);
               
            if ($stmt->execute()) {
                echo "イベントが追加されました。";
            } else {
                echo "エラー: イベントの追加に失敗しました。";
            }
        }
    }
    
    // イベントの取得
    $stmt = $pdo->query("SELECT * FROM events");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // var_dump($events);
    // echo "</pre>";
    
    if ($events) {
        foreach ($events as $row) {
            $id = $row["id"];
            $event = $row["event"];
            $date = $row["date"];
            
            echo "<p>イベント: $event</p>";
            echo "<p> 日付: $date </p>";
            echo "<a href='?delete=$id'>削除</a>";
        }
        echo "<br>";
        echo "<a href='form.php'>戻る</a>";
    } else {
        echo "イベントはありません。";
        echo "<a href='form.php'>戻る</a>";
    }
    //イベント削除
        if (isset($_GET["delete"])) {
            $deleteId = $_GET["delete"];
            $stmt = $pdo->prepare("DELETE FROM events WHERE id = :id");
            $stmt->bindParam(':id', $deleteId);
            if ($stmt->execute()) {
                echo "<br>";
                echo "イベントが削除されました。";
                echo '<hidden $_GET["delete"]>';
                
                // header("Location: form.php");
                // exit(); 
            } else {
                echo "エラー: イベントの削除に失敗しました。";
            }
        }
} catch(PDOException $e) {
    echo "データベースの接続に失敗しました: " . $e->getMessage();
}
$pdo = null;
?>