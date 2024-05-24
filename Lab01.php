<?php

// Function get data from file
function getStudents($file) {

    $students = array();

    // Open file
    $fp = fopen($file, "r");

    // Check if open file successful
    if ($fp) {

        // Read data
        while (($line = fgets($fp)) !== false) {

            // Parse data
            $data = explode("|", $line);

            // Save data
            $students[] = array(
                "id" => $data[0],
                "name" => $data[1],
                "birthday" => $data[2],
                "averageMark" => $data[3],
            );
        }

        // Close file
        fclose($fp);

    } else {

        // Display error of open file fail
        echo "Error: Can't open file StudentData.txt";

    }

    return $students;
}

// Function search Student
function findStudent($students, $id, $name) {

    $found = false;
    $studentInfo = array();

    foreach ($students as $student) {

        // Compare ID or name of Student
        if (($id && $id == $student["id"]) || ($name && $name == $student["name"])) {

            // Find student
            $found = true;
            $studentInfo = $student;
            break;

        }
    }

    return $found ? $studentInfo : null;
}

// The function takes the student with the highest and lowest average score
function getMinMaxAverageMark($students) {

    $max = $min = $students[0]["averageMark"];
    $maxStudent = $minStudent = $students[0];

    foreach ($students as $student) {

        // Find the student with the highest average score
        if ($student["averageMark"] > $max) {
            $max = $student["averageMark"];
            $maxStudent = $student;
        }

        // Find the student with the lowest average score
        if ($student["averageMark"] < $min) {
            $min = $student["averageMark"];
            $minStudent = $student;
        }
    }

    return array(
        "max" => array(
            "student" => $maxStudent,
            "averageMark" => $max,
        ),
        "min" => array(
            "student" => $minStudent,
            "averageMark" => $min,
        ),
    );
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
</head>
<body>

<h1>Danh sách sinh viên</h1>
<?php
    // Get ID or name information from URL
    if (isset($_GET['Id'])) {
        $id = $_GET['Id'];
    } else {
        $id = null;
    }

    if (isset($_GET['Name'])) {
        $name = $_GET['Name'];
    } else {
        $name = null;
    }

    // Get info student from file
    $students = getStudents("./data/StudentData.txt");

    // Search student
    $found = false;
    $studentInfo = array();

    if ($id || $name) {
        $studentInfo = findStudent($students, $id, $name);
        $found = !empty($studentInfo);
    }

    // Take the students with the highest and lowest average scores
    $minmaxAverageMark = getMinMaxAverageMark($students);
?>

<table border="1">
    <tr><th>StudentID</th><th>StudentName</th><th>BirthDay</th><th>AverageMark</th></tr>
    <?php foreach ($students as $student): ?>
        <tr
            <?php echo ($student["id"] == $minmaxAverageMark["max"]["student"]["id"]) ? " style='background-color: #00ff00;'" : ""; ?>
            <?php echo ($student["id"] == $minmaxAverageMark["min"]["student"]["id"]) ? " style='background-color: #ff0000;'" : ""; ?>>
            <td><?php echo $student["id"]; ?></td>
            <td><?php echo $student["name"]; ?></td>
            <td><?php echo $student["birthday"]; ?></td>
            <td><?php echo $student["averageMark"]; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php if ($id || $name): ?>
<?php if ($found): ?>
<h2>Search Found</h2>
<table border="1">
    <tr><th>StudentID</th><th>
    <tr><th>StudentID</th><th>StudentName</th><th>BirthDay</th><th>AverageMark</th></tr>
    <tr>
        <td><?php echo $studentInfo["id"]; ?></td>
        <td><?php echo $studentInfo["name"]; ?></td>
        <td><?php echo $studentInfo["birthday"]; ?></td>
        <td><?php echo $studentInfo["averageMark"]; ?></td>
    </tr>
</table>
    <?php else: ?>
        <h2>Not Found</h2>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>
