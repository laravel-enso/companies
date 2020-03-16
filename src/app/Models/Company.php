<?php

namespace LaravelEnso\Companies\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use LaravelEnso\Addresses\App\Traits\Addressable;
use LaravelEnso\Comments\App\Traits\Commentable;
use LaravelEnso\Discussions\App\Traits\Discussable;
use LaravelEnso\Documents\App\Traits\Documentable;
use LaravelEnso\DynamicMethods\App\Traits\Relations;
use LaravelEnso\Helpers\App\Traits\AvoidsDeletionConflicts;
use LaravelEnso\People\App\Models\Person;
use LaravelEnso\Rememberable\App\Traits\Rememberable;
use LaravelEnso\Tables\App\Traits\TableCache;
use LaravelEnso\TrackWho\App\Traits\CreatedBy;
use LaravelEnso\TrackWho\App\Traits\UpdatedBy;

class Company extends Model
{
    use Addressable, AvoidsDeletionConflicts, Commentable, CreatedBy, Discussable,
        Documentable, Relations, Rememberable, TableCache, UpdatedBy;

    protected $fillable = [
        'name', 'email', 'phone', 'fax', 'website', 'bank', 'bank_account',
        'obs', 'pays_vat', 'is_tenant', 'fiscal_code', 'reg_com_nr', 'status',
    ];

    protected $casts = ['pays_vat' => 'boolean', 'is_tenant' => 'boolean'];

    public function people()
    {
        return $this->belongsToMany(Person::class)
            ->withPivot('position');
    }

    public static function owner()
    {
        return App::make(static::class)
            ->cacheGet(config('enso.config.ownerCompanyId'));
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

    public function attachPerson(int $personId, ?string $position = null)
    {
        $this->people()->attach($personId, [
            'is_main' => false,
            'is_mandatary' => false,
            'position' => $position,
        ]);
    }

    public function updateMandatary(?int $mandataryId)
    {
        $pivotIds = $this->people->pluck('id')->reduce(fn ($pivot, $value) => $pivot
            ->put($value, ['is_mandatary' => $value === $mandataryId]), new Collection()
        )->toArray();

        $this->people()->sync($pivotIds);
    }
}
