<?php
include('includes/config.php');
include('classes/courses.php');

header("Content-Type: application/json; charset=UTF-8"); // Returnera JSON

// Aktivera CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type");

$method = $_SERVER['REQUEST_METHOD']; // Läs ut vilket verb anropet har

switch($method){
    case 'GET':
        get();
    break;
    case 'POST':
        post();
    break;
    case 'DELETE':
        delete();
    break;
    case 'PUT':
        put();
    break;
}
function get(){
    http_response_code(200);
    $courses = new Courses();
    $response = $courses->getAll();
    echo json_encode($response); // Returnera alla kurser som JSON
}

function post(){
    http_response_code(200);
    $data = json_decode(file_get_contents('php://input'), true); // Hämta anropets data och konvertera från JSON
    $courses = new Courses();
    $name = $data['name'];
    $code = $data['code'];
    $progression = $data['progression'];
    $courseSyllabus = $data['coursesyllabus'];
    $course=new Course(0, $code, $name, $progression, $courseSyllabus);
    $courses->addCourse($course);
}
function delete(){
    http_response_code(200);
    $data = json_decode(file_get_contents('php://input'), true);  // Hämta anropets data och konvertera från JSON
    $courses = new Courses();
    $id = $data['id'];
    $courses->delete($id);
}
function put(){
    http_response_code(200);
    $data = json_decode(file_get_contents('php://input'), true);  // Hämta anropets data och konvertera från JSON
    $courses = new Courses();
    $id = $data['id'];
    $name = $data['name'];
    $code = $data['code'];
    $progression = $data['progression'];
    $courseSyllabus = $data['coursesyllabus'];
    $course=new Course($id, $code, $name, $progression, $courseSyllabus);
    $courses->update($course);
}
?>
