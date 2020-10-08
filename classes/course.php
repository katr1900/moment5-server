<?php

class Course{
    public $id;
    public $code;
    public $name;
    public $progression;
    public $courseSyllabus;

    function __construct($id, $code, $name, $progression, $courseSyllabus) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->progression = $progression;
        $this->courseSyllabus = $courseSyllabus;
    }
}