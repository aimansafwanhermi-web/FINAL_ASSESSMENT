<?php
include "header.php";
include "db.php";

if (isset($_POST['submit'])) {

    $student_name = $_POST['student_name'];
    $matric_number = $_POST['matric_number'];
    $subject_name = $_POST['subject_name'];
    $subject_code = $_POST['subject_code'];
    $test1 = $_POST['test1'];
    $test2 = $_POST['test2'];
    $final = $_POST['final'];

    // Calculate total based on weightage
    $total = ($test1 * 0.20) + ($test2 * 0.30) + ($final * 0.50);

    // Calculate grade
    if ($total >= 80) {
        $grade = 'A';
    } elseif ($total >= 65) {
        $grade = 'B';
    } elseif ($total >= 50) {
        $grade = 'C';
    } elseif ($total >= 40) {
        $grade = 'D';
    } else {
        $grade = 'E';
    }

    $sql = $conn->prepare("INSERT INTO result
    (Student_name, matric_number, Subject_code, subject_name, test_1, test_2, final, total, grade)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $sql->bind_param(
        "ssssiiids",
        $student_name,
        $matric_number,
        $subject_code,
        $subject_name,
        $test1,
        $test2,
        $final,
        $total,
        $grade
    );

    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Insert failed: " . $sql->error;
    }
}

$student_name = "";
$matric_number = "";
$subject_name = "";
$subject_code = "";
$test1 = "";
$test2 = "";
$final = "";
?>

<h2>Add Results</h2>

<?php
include "form.php";
include "footer.php";
?>