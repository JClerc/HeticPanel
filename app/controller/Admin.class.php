<?php

class AdminController extends Controller {

    const DEPENDENCIES = ['Flash'];

    const PERMISSION_REQUIRED = User::STAFF;

    public function index() {}
    
}
