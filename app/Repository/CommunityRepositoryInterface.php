<?php

namespace App\Repository;

interface CommunityRepositoryInterface
{
     // show all communities in home page
     public function index();

     // show only one community in blank page
     public function show($id);

     // redirict to create page
     public function create();

     // store community in database
     public function store($request);

     //edit community redirection
     public function edit($id);

     //update community informations in database
     public function update($request);

     //delete community from database
     public function destroy($request);
}
