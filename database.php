<?php
$db = mysqli_connect('localhost', "root", "") or die('Unable to connect. Check your connection parameters.');

$query = 'CREATE DATABASE IF NOT EXISTS university_db';
mysqli_query($db, $query) or die(mysqli_error($db));

mysqli_select_db($db, 'university_db') or die(mysqli_error($db));

$query = 'CREATE TABLE student (
    student_id VARCHAR(10) NOT NULL,
    student_name VARCHAR(40) NOT NULL,
    gender VARCHAR(6) NOT NULL,
    stu_university_id VARCHAR(3) NOT NULL,
    stu_faculty_id VARCHAR(3) NOT NULL,
    stu_province_id VARCHAR(4) NOT NULL,
    PRIMARY KEY (student_id)
) ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'INSERT INTO student (student_id, student_name, gender, stu_university_id, stu_faculty_id, stu_province_id)
    VALUES
    ("Stu-00001", "Sreng Sineang", "Female", "U-1", "F-1", "P-01"),
    ("Stu-00002", "Huy Makara", "Male", "U-1", "F-2", "P-02"),
    ("Stu-00003", "Chean Sopheak", "Male", "U-2", "F-3", "P-03"),
    ("Stu-00004", "Heng Hay", "Male", "U-3", "F-1", "P-04"),
    ("Stu-00005", "Phen Sophana", "Male", "U-2", "F-2", "P-01")';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'CREATE TABLE university (
    university_id VARCHAR(3) NOT NULL,
    university_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (university_id)
) ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'INSERT INTO university (university_id, university_name)
    VALUES
    ("U-1", "RULE"),
    ("U-2", "NUM"),
    ("U-3", "BBU")';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'CREATE TABLE faculty (
    faculty_id VARCHAR(3) NOT NULL,
    faculty_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (faculty_id)
) ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'INSERT INTO faculty (faculty_id, faculty_name)
    VALUES
    ("F-1", "Economics"),
    ("F-2", "IT"),
    ("F-3", "Law")';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'CREATE TABLE province (
    province_id VARCHAR(4) NOT NULL,
    province_name VARCHAR(30) NOT NULL,
    PRIMARY KEY (province_id)
) ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'INSERT INTO province (province_id, province_name)
    VALUES
    ("P-01", "Phnom Penh"),
    ("P-02", "Kandal"),
    ("P-03", "Kampot"),
    ("P-04", "Kep")';
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'UniversityDB Database successfully created!';
echo '<br>';
echo 'Data inserted successfully!';
?>
