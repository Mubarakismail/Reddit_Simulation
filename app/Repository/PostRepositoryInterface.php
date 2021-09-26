<?php

namespace App\Repository;

interface PostRepositoryInterface
{
    // show all posts in home page
    public function index();

    // show only one post in blank page
    public function show($id);

    // redirict to create page
    public function create();

    // store post in database
    public function store($request);

    //edit post redirection
    public function edit($id);

    //update post informations in database
    public function update($request);

    //delete post from database
    public function destroy($request);
}
