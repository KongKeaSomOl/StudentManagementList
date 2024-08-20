<?php
include 'db.php'; 


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $id = $conn->real_escape_string($_POST['student_id']);
    $name = $conn->real_escape_string($_POST['student_name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $university_id = $conn->real_escape_string($_POST['stu_university_id']);
    $faculty_id = $conn->real_escape_string($_POST['stu_faculty_id']);
    $province_id = $conn->real_escape_string($_POST['stu_province_id']);

    $sql = "INSERT INTO student (student_id, student_name, gender, stu_university_id, stu_faculty_id, stu_province_id)
            VALUES ('$id', '$name', '$gender', '$university_id', '$faculty_id', '$province_id')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>New student added successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}


if (isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['student_id']);
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
}


if (isset($_POST['delete'])) {
    $id = $conn->real_escape_string($_POST['student_id']);

    $sql = "DELETE FROM student WHERE student_id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Student deleted successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}


if (isset($_GET['edit'])) {
    $id = $conn->real_escape_string($_GET['edit']);
    $sql = "SELECT * FROM student WHERE student_id='$id'";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();
} else {
    $student = null;
}


$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 20px; }
        .details { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Student Management</h1>

    <form method="POST" action="">
        <div class="form-group">
            <label for="student_id">Student ID:</label>
            <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo htmlspecialchars($student['student_id'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="student_name">Student Name:</label>
            <input type="text" class="form-control" id="student_name" name="student_name" value="<?php echo htmlspecialchars($student['student_name'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="Male" <?php echo (isset($student['gender']) && $student['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo (isset($student['gender']) && $student['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="stu_university_id">University ID:</label>
            <select class="form-control" id="stu_university_id" name="stu_university_id" required>
                <option value="RULE" <?php echo (isset($student['stu_university_id']) && $student['stu_university_id'] == 'RULE') ? 'selected' : ''; ?>>RULE</option>
                <option value="RUFA" <?php echo (isset($student['stu_university_id']) && $student['stu_university_id'] == 'RUFA') ? 'selected' : ''; ?>>RUFA</option>
                <option value="RUPP" <?php echo (isset($student['stu_university_id']) && $student['stu_university_id'] == 'RUPP') ? 'selected' : ''; ?>>RUPP</option>
                <option value="NUM" <?php echo (isset($student['stu_university_id']) && $student['stu_university_id'] == 'NUM') ? 'selected' : ''; ?>>NUM</option>
            </select>
        </div>
        <div class="form-group">
            <label for="stu_faculty_id">Faculty ID:</label>
            <select class="form-control" id="stu_faculty_id" name="stu_faculty_id" required>
                <option value="LAW" <?php echo (isset($student['stu_faculty_id']) && $student['stu_faculty_id'] == 'LAW') ? 'selected' : ''; ?>>LAW</option>
                <option value="IT" <?php echo (isset($student['stu_faculty_id']) && $student['stu_faculty_id'] == 'IT') ? 'selected' : ''; ?>>IT</option>
                <option value="BANK" <?php echo (isset($student['stu_faculty_id']) && $student['stu_faculty_id'] == 'BANK') ? 'selected' : ''; ?>>BANK</option>
                <option value="ECONOMIC" <?php echo (isset($student['stu_faculty_id']) && $student['stu_faculty_id'] == 'ECONOMIC') ? 'selected' : ''; ?>>ECONOMIC</option>
            </select>
        </div>
        <div class="form-group">
            <label for="stu_province_id">Province ID:</label>
            <select class="form-control" id="stu_province_id" name="stu_province_id" required>
                <option value="Phnom Penh" <?php echo (isset($student['stu_province_id']) && $student['stu_province_id'] == 'Phnom Penh') ? 'selected' : ''; ?>>Phnom Penh</option>
                <option value="Kandal" <?php echo (isset($student['stu_province_id']) && $student['stu_province_id'] == 'Kandal') ? 'selected' : ''; ?>>Kandal</option>
                <option value="Siem Reap" <?php echo (isset($student['stu_province_id']) && $student['stu_province_id'] == 'Siem Reap') ? 'selected' : ''; ?>>Siem Reap</option>
                <option value="Preah Sihanoukville" <?php echo (isset($student['stu_province_id']) && $student['stu_province_id'] == 'Preah Sihanoukville') ? 'selected' : ''; ?>>Preah Sihanoukville</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="<?php echo isset($student) ? 'update' : 'add'; ?>"><?php echo isset($student) ? 'Update Student' : 'Add Student'; ?></button>
        <a href="studentList.php" class="btn btn-secondary m-3">View Student List</a>

    </form>

    <script>
    function resetForm() {
        document.getElementById('studentForm').reset();
    }
</script>
</body>
</html>
