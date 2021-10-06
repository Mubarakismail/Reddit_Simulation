<?php

namespace App\Repository;

interface CommunityRepositoryInterface
{
     // show all communities in home page
     public function index();

     // show only one community in blank page
     public function show($id);

     // store community in database
     public function store($request);

     //update community informations in database
     public function update($request);

     //delete community from database
     public function destroy($request);
}
