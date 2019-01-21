<?php

namespace LaravelEnso\Companies\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\Discussions\app\Traits\Discussable;
use LaravelEnso\ActivityLog\app\Traits\LogsActivity;
use LaravelEnso\CommentsManager\app\Traits\Commentable;
use LaravelEnso\AddressesManager\app\Traits\Addressable;
use LaravelEnso\DocumentsManager\app\Traits\Documentable;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Company extends Model
{
    use Addressable, Commentable, CreatedBy, Discussable,
        Documentable, LogsActivity, UpdatedBy;

    protected $guarded = [];

    protected $casts = ['pays_vat' => 'boolean'];

    protected $loggableLabel = 'name';

    protected $loggable = ['name', 'email', 'phone'];

    public function mandatary()
    {
        return $this->belongsTo(Person::class, 'mandatary_id');
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function delete()
    {
        try {
            parent::delete();
        } catch (\Exception $e) {
            throw new ConflictHttpException(__(
                'The company has activity in the system and cannot be deleted'
            ));
        }

        return ['message' => 'The company was successfully deleted'];
    }
}
