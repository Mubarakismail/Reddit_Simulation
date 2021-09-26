<?php

namespace App\Repository;

interface CommentRepositoryInterface
{
    // show all comments in home page
    public function index();

    // show only one comment in blank page
    public function show($id);

    // redirict to create page
    public function create();

    // store comment in database
    public function store($request);

    //edit comment redirection
    public function edit($id);

    //update comment informations in database
    public function update($request);

    //delete comment from database
    public function destroy($request);
}
