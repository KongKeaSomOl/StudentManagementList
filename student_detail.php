<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php'; 


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM student WHERE student_id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-warning'>Student not found.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-warning'>No student ID provided.</div>";
    exit;
}

if (isset($_POST['update'])) {
    $name = $conn->real_escape_string($_POST['student_name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $university_id = $conn->real_escape_string($_POST['stu_university_id']);
    $faculty_id = $conn->real_escape_string($_POST['stu_faculty_id']);
    $province_id = $conn->real_escape_string($_POST['stu_province_id']);

    $sql = "UPDATE student SET student_name='$name', gender='$gender', stu_university_id='$university_id',
            stu_faculty_id='$faculty_id', stu_province_id='$province_id' WHERE student_id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Student updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }

   
    $result = $conn->query("SELECT * FROM student WHERE student_id='$id'");
    $student = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-5">Student Details</h2>
    
 
    <form method="POST" action="">
        <input type="hidden" name="student_id" value="<?php echo htmlspecialchars($student['student_id']); ?>">
        <div class="form-group">
            <label for="student_name">Name:</label>
            <input type="text" class="form-control" id="student_name" name="student_name" value="<?php echo htmlspecialchars($student['student_name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="Male" <?php echo ($student['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($student['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="stu_university_id">University ID:</label>
            <select class="form-control" id="stu_university_id" name="stu_university_id" required>
                <option value="RULE" <?php echo ($student['stu_university_id'] == 'RULE') ? 'selected' : ''; ?>>RULE</option>
                <option value="RUFA" <?php echo ($student['stu_university_id'] == 'RUFA') ? 'selected' : ''; ?>>RUFA</option>
                <option value="RUPP" <?php echo ($student['stu_university_id'] == 'RUPP') ? 'selected' : ''; ?>>RUPP</option>
                <option value="NUM" <?php echo ($student['stu_university_id'] == 'NUM') ? 'selected' : ''; ?>>NUM</option>
            </select>
        </div>
        <div class="form-group">
            <label for="stu_faculty_id">Faculty ID:</label>
            <select class="form-control" id="stu_faculty_id" name="stu_faculty_id" required>
                <option value="LAW" <?php echo ($student['stu_faculty_id'] == 'LAW') ? 'selected' : ''; ?>>LAW</option>
                <option value="IT" <?php echo ($student['stu_faculty_id'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                <option value="BANK" <?php echo ($student['stu_faculty_id'] == 'BANK') ? 'selected' : ''; ?>>BANK</option>
                <option value="ECONOMIC" <?php echo ($student['stu_faculty_id'] == 'ECONOMIC') ? 'selected' : ''; ?>>ECONOMIC</option>
            </select>
        </div>
        <div class="form-group">
            <label for="stu_province_id">Province ID:</label>
            <select class="form-control" id="stu_province_id" name="stu_province_id" required>
                <option value="Phnom Penh" <?php echo ($student['stu_province_id'] == 'Phnom Penh') ? 'selected' : ''; ?>>Phnom Penh</option>
                <option value="Kandal" <?php echo ($student['stu_province_id'] == 'Kandal') ? 'selected' : ''; ?>>Kandal</option>
                <option value="Siem Reap" <?php echo ($student['stu_province_id'] == 'Siem Reap') ? 'selected' : ''; ?>>Siem Reap</option>
                <option value="Preah Sihanoukville" <?php echo ($student['stu_province_id'] == 'Preah Sihanoukville') ? 'selected' : ''; ?>>Preah Sihanoukville</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="update">Update Student</button>
    </form>
    
    <a href="studentList.php" class="btn btn-secondary mt-3">Go to list</a>
</div>
</body>
</html>
