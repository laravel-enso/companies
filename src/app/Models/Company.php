<?php

namespace LaravelEnso\Companies\app\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\Addresses\app\Traits\Addressable;
use LaravelEnso\Comments\app\Traits\Commentable;
use LaravelEnso\Discussions\app\Traits\Discussable;
use LaravelEnso\Documents\app\Traits\Documentable;
use LaravelEnso\DynamicMethods\app\Traits\Relations;
use LaravelEnso\Helpers\app\Traits\AvoidsDeletionConflicts;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Rememberable\app\Traits\Rememberable;
use LaravelEnso\Tables\app\Traits\TableCache;
use LaravelEnso\TrackWho\app\Traits\CreatedBy;
use LaravelEnso\TrackWho\app\Traits\UpdatedBy;

class Company extends Model
{
    use Addressable, AvoidsDeletionConflicts, Commentable, CreatedBy, Discussable,
        Documentable, Relations, Rememberable, TableCache, UpdatedBy;

    protected $fillable = [
        'name', 'email', 'phone', 'fax', 'bank', 'bank_account', 'obs',
        'pays_vat', 'is_tenant', 'fiscal_code', 'reg_com_nr', 'status',
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

    public function attachPerson(int $personId, string $position = null)
    {
        $this->people()->attach($personId, [
            'is_main' => false,
            'is_mandatary' => false,
            'position' => $position,
        ]);
    }

    public function updateMandatary(?int $mandataryId)
    {
        $pivotIds = $this->people->pluck('id')
            ->reduce(function ($pivot, $value) use ($mandataryId) {
                return $pivot->put($value, ['is_mandatary' => $value === $mandataryId]);
            }, collect())->toArray();

        $this->people()->sync($pivotIds);
    }
}
