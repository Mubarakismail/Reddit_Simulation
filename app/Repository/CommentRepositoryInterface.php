<?php

namespace App\Repository;

interface CommentRepositoryInterface
{
    // store comment in database
    public function store($request);

    //update comment informations in database
    public function update($request);

    //delete comment from database
    public function destroy($request);
}
