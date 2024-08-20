<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php'; 


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




if (isset($_POST['update'])) {
    $id = $conn->real_escape_string($_POST['student_id']);
    $name = $conn->real_escape_string($_POST['student_name']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $university_id = $conn->real_escape_string($_POST['stu_university_id']);

    $sql = "UPDATE student SET student_name='$name', gender='$gender', stu_university_id='$university_id' WHERE student_id='$id'";
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


$sql = "SELECT * FROM student";
$result = $conn->query($sql);


$totalStudents = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { margin-top: 20px; }
        .btn-sm { margin-right: 5px; }
        .options-column { width: 200px; } 
        .options-button { margin-right: 5px; } 
    </style>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this student?');
        }
    </script>
</head>
<body>
<div class="container">
    <h2 class="mt-5">Student List</h2>
    <div class="mb-3">
        <?php
        if ($totalStudents > 0) {
            echo "<div class='alert alert-info'>There are {$totalStudents} " . ($totalStudents > 1 ? "persons" : "person") . " in the list.</div>";
        } else {
            echo "<div class='alert alert-info'>There are no students in the list.</div>";
        }
        ?>
    </div>
    <?php if (isset($_GET['edit'])): ?>
    <div class="mb-3">
        <h4>Edit Student</h4>
        <?php
        $editId = $conn->real_escape_string($_GET['edit']);
        $sql = "SELECT * FROM student WHERE student_id='$editId'";
        $editResult = $conn->query($sql);
        $editStudent = $editResult->fetch_assoc();
        ?>
        <form method="POST" action="">
            <input type="hidden" name="student_id" value="<?php echo $editStudent['student_id']; ?>">
            <div class="form-group">
                <label for="student_name">Name</label>
                <input type="text" id="student_name" name="student_name" class="form-control" value="<?php echo htmlspecialchars($editStudent['student_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <input type="text" id="gender" name="gender" class="form-control" value="<?php echo htmlspecialchars($editStudent['gender']); ?>" required>
            </div>
            <div class="form-group">
                <label for="stu_university_id">University ID</label>
                <input type="text" id="stu_university_id" name="stu_university_id" class="form-control" value="<?php echo htmlspecialchars($editStudent['stu_university_id']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary" name="update">Update Student</button>
        </form>
    </div>
    <?php endif; ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th class="options-column">Options</th> 
            </tr>
        </thead>
        <tbody>
            <?php
            if ($totalStudents > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td><a href='student_detail.php?id={$row['student_id']}'>{$row['student_id']}</a></td>
                        <td>{$row['student_name']}</td>
                        <td>{$row['gender']}</td>
                        <td class='options-column'>
                            <a href='?edit={$row['student_id']}' class='btn btn-primary btn-sm options-button'>Update</a>
                            <form method='POST' action='' style='display:inline;' onsubmit='return confirmDelete();'>
                                <input type='hidden' name='student_id' value='{$row['student_id']}'>
                                <button type='submit' class='btn btn-danger btn-sm options-button' name='delete'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No students found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary m-3">Go to Add Student</a>
</div>
</body>
</html>

