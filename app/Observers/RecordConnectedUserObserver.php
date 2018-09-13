<?php

namespace AvisoNavAPI\Observers;

use Illuminate\Support\Facades\Auth;

class RecordConnectedUserObserver {

    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function creating($model)
    {
        $model->created_by = $this->user->username;
        $model->updated_by = $this->user->username;
    }

    public function updating($model)
    {
        $model->updated_by = $this->user->username;
    }
}