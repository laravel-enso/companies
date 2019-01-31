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
use LaravelEnso\Multitenancy\app\Traits\SystemConnection;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Company extends Model
{
    use Addressable, Commentable, CreatedBy, Discussable,
        Documentable, LogsActivity, UpdatedBy, SystemConnection;

    protected $guarded = [];

    protected $casts = ['pays_vat' => 'boolean'];

    protected $loggableLabel = 'name';

    protected $loggable = ['name', 'email', 'phone'];

    protected $cachedTable = 'companies';

    public function mandatary()
    {
        return $this->belongsTo(Person::class, 'mandatary_id');
    }

    public function people()
    {
        return $this->hasMany(Person::class);
    }

    public function isTenant()
    {
        return $this->is_tenant;
    }

    public function scopeTenants($query)
    {
        $query->whereIsTenant(true);
    }

    public function delete()
    {
        if ($this->isTenant()) {
            throw new ConflictHttpException(__(
                'The company is a tenant and cannot be deleted'
            ));
        }

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
