<?php
// Đọc nội dung từ file Quiz.txt
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

        // Phân tích nội dung từng dòng
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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Thi Trắc Nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Bài Thi Trắc Nghiệm</h1>
        <form action="result.php" method="POST">
            <?php foreach ($questions as $index => $question): ?>
                <div class="mb-4">
                    <h5>Câu <?php echo $index + 1; ?>: <?php echo $question['question']; ?></h5>
                    <?php foreach ($question['options'] as $option): ?>
                        <div>
                            <input type="radio" id="q<?php echo $index; ?>_<?php echo $option[0]; ?>" name="q<?php echo $index; ?>" value="<?php echo $option[0]; ?>">
                            <label for="q<?php echo $index; ?>"><?php echo $option; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>
    </div>
</body>
</html>
