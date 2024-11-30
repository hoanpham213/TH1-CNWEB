<?php
// Đọc lại nội dung từ file Quiz.txt để lấy đáp án
$filename = "Quiz.txt";
$questions = [];

if (file_exists($filename)) {
    $content = file_get_contents($filename);
    $lines = explode("\n", $content);

    $currentQuestion = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) {
            continue;
        }

        if (str_starts_with($line, "ANSWER:")) {
            $currentQuestion['answer'] = trim(substr($line, 7));
            $questions[] = $currentQuestion;
            $currentQuestion = [];
        } elseif (preg_match("/^[A-D]\./", $line)) {
            $currentQuestion['options'][] = $line;
        } else {
            if (!isset($currentQuestion['question'])) {
                $currentQuestion['question'] = $line;
            } else {
                $currentQuestion['question'] .= " " . $line;
            }
        }
    }
} else {
    die("Tệp Quiz.txt không tồn tại.");
}

// Tính toán kết quả
$score = 0;
$total = count($questions);

foreach ($questions as $index => $question) {
    $userAnswer = $_POST["q$index"] ?? null;
    if ($userAnswer === $question['answer']) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết Quả</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Kết Quả Bài Thi</h1>
        <p class="text-center">Số câu trả lời đúng: <strong><?php echo $score; ?></strong> / <?php echo $total; ?></p>
        <a href="quiz.php" class="btn btn-primary">Làm lại bài thi</a>
    </div>
</body>
</html>
