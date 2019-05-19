<?php

namespace LaravelEnso\Companies\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Tables\app\Traits\TableCache;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;
use LaravelEnso\Comments\app\Traits\Commentable;
use LaravelEnso\Addresses\app\Traits\Addressable;
use LaravelEnso\Documents\app\Traits\Documentable;
use LaravelEnso\Discussions\app\Traits\Discussable;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class Company extends Model
{
    use Addressable, Commentable, CreatedBy, Discussable,
        Documentable, UpdatedBy, TableCache;

    protected $fillable = [
        'name', 'email', 'phone', 'fax', 'bank', 'bank_account',
        'obs', 'pays_vat', 'is_tenant',
    ];

    protected $casts = ['pays_vat' => 'boolean', 'is_tenant' => 'boolean'];

    public function people()
    {
        return $this->belongsToMany(Person::class)
            ->withPivot('position');
    }

    public function isTenant()
    {
        return $this->is_tenant;
    }

    public function scopeTenant($query)
    {
        $query->whereIsTenant(true);
    }

    public function mandatary()
    {
        return $this->people()
            ->withPivot('position')
            ->wherePivot('is_mandatary', true)
            ->first();
    }

    public function removeMandatary($mandataryId)
    {
        $this->people()
            ->updateExistingPivot($mandataryId, [
                'is_mandatary' => false,
            ]);
    }

    public function setMandatary($mandataryId)
    {
        $this->people()
            ->updateExistingPivot($mandataryId, [
                'is_mandatary' => true,
            ]);
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
                'The company is assigned to resources in the system and cannot be deleted'
            ));
        }

        return ['message' => __('The company was successfully deleted')];
    }
}
