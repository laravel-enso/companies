<?php

namespace LaravelEnso\Companies\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;

class Contact extends Model
{
    use CreatedBy, LogsActivity, UpdatedBy;

    protected $guarded = [];

    protected $loggableLabel = 'name';

    protected $loggable = ['position'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function getNameAttribute()
    {
        return $this->person->name;
    }

    public function getCompanyNameAttribute()
    {
        return $this->company->name;
    }
}
