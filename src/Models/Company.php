<?php

namespace LaravelEnso\Companies\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\RoutesNotifications;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Addresses\Traits\Addressable;
use LaravelEnso\DynamicMethods\Contracts\DynamicMethods;
use LaravelEnso\DynamicMethods\Traits\Abilities;
use LaravelEnso\Helpers\Traits\AvoidsDeletionConflicts;
use LaravelEnso\Helpers\Traits\CascadesMorphMap;
use LaravelEnso\People\Models\Person;
use LaravelEnso\Rememberable\Traits\Rememberable;
use LaravelEnso\Tables\Traits\TableCache;
use LaravelEnso\TrackWho\Traits\CreatedBy;
use LaravelEnso\TrackWho\Traits\UpdatedBy;

class Company extends Model implements DynamicMethods
{
    use Abilities, Addressable, AvoidsDeletionConflicts, CascadesMorphMap, CreatedBy;
    use HasFactory, Rememberable, RoutesNotifications, TableCache, UpdatedBy;

    protected $guarded = ['id'];

    protected $rememberableKeys = ['id', 'name', 'fiscal_code'];

    public function people()
    {
        return $this->belongsToMany(Person::class)
            ->withPivot('position');
    }

    public static function owner()
    {
        return static::cacheGet(Config::get('enso.config.ownerCompanyId'));
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
        $pivotIds = $this->people->pluck('id')->reduce(
            fn ($pivot, $value) => $pivot
                ->put($value, ['is_mandatary' => $value === $mandataryId]),
            new Collection()
        )->toArray();

        $this->people()->sync($pivotIds);
    }

    protected function casts(): array
    {
        return [
            'pays_vat' => 'boolean',
            'is_public_institution' => 'boolean',
        ];
    }
}
