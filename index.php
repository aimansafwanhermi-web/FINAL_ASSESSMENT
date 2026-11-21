<?php

session_start();

include 'auth.php';
include 'db.php';
include 'header.php';

$search = $_GET['search'] ?? '';

$like = "%$search%";

$sql = $conn->prepare("SELECT * FROM result
WHERE Student_name LIKE ? OR matric_number LIKE ?
OR subject_name LIKE ? OR Subject_code LIKE ?");

$sql->bind_param("ssss", $like, $like, $like, $like);

$sql->execute();

$result = $sql->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Final Assessment</title>
</head>

<body>

<h2>Students Records</h2>

<a href="add.php">+ Add Results</a>

<form method="get">
    <input type="text" name="search" placeholder="Search by name or ID" value="<?php echo $search; ?>">
    <button type="submit">Search</button>
    <a href="index.php">Show All</a><br><br>
</form>

<div>
    <table border="1">
        <thead>
            <tr>
                <th>No.</th>
                <th>Student Name</th>
                <th>Matric No.</th>
                <th>Subject</th>
                <th>Subject Code</th>
                <th>Test 1</th>
                <th>Test 2</th>
                <th>Final</th>
                <th>Total (100%)</th>
                <th>Grade</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['Student_name'] . "</td>";
                echo "<td>" . $row['matric_number'] . "</td>";
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['Subject_code'] . "</td>";
                echo "<td>" . $row['test_1'] . "</td>";
                echo "<td>" . $row['test_2'] . "</td>";
                echo "<td>" . $row['final'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . $row['grade'] . "</td>";
                echo "<td>";

                echo "<button><a href='edit.php?id=" . $row['id'] . "'>Edit</a></button>";

                echo "<form method='post' action='delete.php' onsubmit='return confirm(\"Are you sure you want to delete this record?\")' style='display:inline;'>";
                echo "<input type='hidden' name='delete' value='delete'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<input type='submit' value='Delete'>";
                echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>

</body>
</html>