<?php
include('course.php');
class Courses{
    private $db;
    
    function __construct() {
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE); // Anslut till databasen
        
        if($this->db->connect_errno > 0){
            die('unable to connect to database ['. $this->db->connect_error . ']');
        }
    }

    public function get($id){
        $statement = $this->db->prepare("SELECT * FROM courses WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
        
        $result = $statement->get_result();

        if(!$result){
            die('There was an error running the query [' . $this->db->error. ']');
        }
        $row = $result->fetch_assoc(); // Hämta en rad
        if(!$row){ // Om kursen inte finns
            return null;
        }
        $course=new Course($row['Id'], $row['Code'], $row['Name'], $row['Progression'], $row['CourseSyllabus']);
        
        return $course;
        
    }
    public function getAll() {
        $sql = "SELECT * FROM courses";
        $result = $this ->db->query($sql);

        if(!$result){
            die('There was an error running the query [' . $this->db->error. ']');
        }
        $courses = array();

        // Loopa igenom alla rader/kurser
        while($row = $result->fetch_assoc()){
            $course=new Course($row['Id'], $row['Code'], $row['Name'], $row['Progression'], $row['CourseSyllabus']);
            array_push($courses,$course); // Lägg till kursen till listan med kurser
        }
        return $courses;
    }

    public function addCourse($course){
        // Spara kursen i databasen
        $statement = $this->db->prepare("INSERT INTO courses (Name, Progression, Code, Coursesyllabus) Values (?, ?, ?, ?)");
        $statement->bind_param("ssss",$course->name,$course->progression,$course->code,$course->courseSyllabus);
        $statement->execute();
    }

    public function delete($id){
        // Ta bort kursen från databasen
        $statement = $this->db->prepare("DELETE FROM courses WHERE id = ?");
        $statement->bind_param("i", $id);
        $statement->execute();
    }
    public function update($course){
        // Uppdatera en kurs ifall den finns
        $statement = $this->db->prepare("UPDATE courses SET Name = ?, Progression = ?, Code = ?, Coursesyllabus = ? WHERE Id = ?");
        $statement->bind_param("sssss",$course->name,$course->progression,$course->code,$course->courseSyllabus,$course->id);
        $statement->execute();
    }

}