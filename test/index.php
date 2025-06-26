<?php
// DB 연결
$host = "localhost";
$user = "db_user";
$pass = "db_password";
$dbname = "testdb";
$conn = mysqli_connect($host, $user, $pass, $dbname);

// 폼 제출 시 데이터 저장
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memo = mysqli_real_escape_string($conn, $_POST["memo"]);
    $sql = "INSERT INTO memos (content) VALUES ('$memo')";
    mysqli_query($conn, $sql);
}

// 저장된 메모 불러오기
$result = mysqli_query($conn, "SELECT * FROM memos ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head><title>메모장</title></head>
<body>
    <form method="post">
        <textarea name="memo"></textarea>
        <button type="submit">저장</button>
    </form>
    <h2>저장된 메모</h2>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div><?= htmlspecialchars($row['content']) ?></div>
    <?php endwhile; ?>
</body>
</html>
