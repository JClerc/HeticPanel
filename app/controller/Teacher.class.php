<?php

class TeacherController extends Controller {

    const DEPENDENCIES = ['Auth'];

    // Students doesnt have a panel
    const PERMISSION_REQUIRED = User::TEACHER;

    public function index() {}

    public function roll() {}

}
