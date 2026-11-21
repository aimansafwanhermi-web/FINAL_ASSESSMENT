<?php
include 'db.php';
include 'header.php';

// Get ID
$id = $_GET['id'] ?? 0;

// Get existing record
$sql = $conn->prepare("SELECT * FROM result WHERE id = ?");
$sql->bind_param("i", $id);
$sql->execute();
$row = $sql->get_result()->fetch_assoc();

$student_name = $row['Student_name'];
$matric_number = $row['matric_number'];
$subject_name = $row['subject_name'];
$subject_code = $row['Subject_code'];
$test1 = $row['test_1'];
$test2 = $row['test_2'];
$final = $row['final'];

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

    $sql = $conn->prepare("UPDATE result SET
    Student_name = ?,
    matric_number = ?,
    Subject_code = ?,
    subject_name = ?,
    test_1 = ?,
    test_2 = ?,
    final = ?,
    total = ?,
    grade = ?
    WHERE id = ?");

    $sql->bind_param(
        "ssssiiidsi",
        $student_name,
        $matric_number,
        $subject_code,
        $subject_name,
        $test1,
        $test2,
        $final,
        $total,
        $grade,
        $id
    );

    if ($sql->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Update failed: " . $sql->error;
    }
}
?>

<h2>Edit Results</h2>

<form method="post">

    Student Name:
    <input type="text" name="student_name"
    value="<?php echo $student_name; ?>" required><br><br>

    Matric Number:
    <input type="text" name="matric_number"
    value="<?php echo $matric_number; ?>" required><br><br>

    Subject Name:
    <input type="text" name="subject_name"
    value="<?php echo $subject_name; ?>" required><br><br>

    Subject Code:
    <input type="text" name="subject_code"
    value="<?php echo $subject_code; ?>" required><br><br>

    Test 1:
    <input type="number" name="test1"
    value="<?php echo $test1; ?>" required><br><br>

    Test 2:
    <input type="number" name="test2"
    value="<?php echo $test2; ?>" required><br><br>

    Final:
    <input type="number" name="final"
    value="<?php echo $final; ?>" required><br><br>

    <input type="submit" name="submit" value="Update Results">

</form>

<?php
include "footer.php";
?>