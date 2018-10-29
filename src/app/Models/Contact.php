<?php

namespace LaravelEnso\Companies\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;

class Contact extends Model
{
    use LogsActivity;

    protected $guarded = [];

    protected $loggableLabel = 'person.name';
    protected $loggable = ['position'];
    protected $loggableRelation = ['company' => 'name'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
