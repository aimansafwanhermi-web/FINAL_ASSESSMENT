<style>
    label {
        display: inline-block;
        width: 15%;
    }
</style>

<form method="POST">

    <label for="student_name">Student Name:</label>
    <input type="text" id="student_name" name="student_name" value="<?php echo $student_name ?>"><br><br>

    <label for="matric_number">Matric Number:</label>
    <input type="text" id="matric_number" name="matric_number" value="<?php echo $matric_number ?>"><br><br>

    <label for="subject_name">Subject:</label>
    <input type="text" id="subject_name" name="subject_name" value="<?php echo $subject_name ?>"><br><br>

    <label for="subject_code">Subject Code:</label>
    <input type="text" id="subject_code" name="subject_code" value="<?php echo $subject_code ?>"><br><br>

    <label for="test1">Test 1:</label>
    <input type="number" id="test1" name="test1" value="<?php echo $test1 ?>"><br><br>

    <label for="test2">Test 2:</label>
    <input type="number" id="test2" name="test2" value="<?php echo $test2 ?>"><br><br>

    <label for="final">Final:</label>
    <input type="number" id="final" name="final" value="<?php echo $final ?>"><br><br>

    <input type="submit" name="submit" value="Add Result">

</form>