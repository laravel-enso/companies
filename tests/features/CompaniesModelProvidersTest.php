<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;
use LaravelEnso\Companies\EnumServiceProvider;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Companies\SearchServiceProvider;
use LaravelEnso\People\Models\Person;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompaniesModelProvidersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed()
            ->actingAs(User::first());
    }

    #[Test]
    public function owner_helper_returns_configured_company(): void
    {
        $company = Company::factory()->test()->create();

        Config::set('enso.config.ownerCompanyId', $company->id);

        $this->assertTrue(Company::owner()->is($company));
    }

    #[Test]
    public function mandatary_returns_the_marked_person(): void
    {
        $company = Company::factory()->test()->create();
        [$mandatary, $otherPerson] = Person::factory()->test()->count(2)->create();

        $company->attachPerson($mandatary->id, 'Administrator');
        $company->attachPerson($otherPerson->id, 'Accountant');
        $company->updateMandatary($mandatary->id);

        $this->assertTrue($company->mandatary()->is($mandatary));
    }

    #[Test]
    public function attach_person_persists_position_and_default_flags(): void
    {
        $company = Company::factory()->test()->create();
        $person = Person::factory()->test()->create();

        $company->attachPerson($person->id, 'Director');

        $pivot = $person->fresh()->companies()->first()->pivot;

        $this->assertSame('Director', $pivot->position);
        $this->assertFalse((bool) $pivot->is_main);
        $this->assertFalse((bool) $pivot->is_mandatary);
    }

    #[Test]
    public function update_mandatary_toggles_single_association(): void
    {
        $company = Company::factory()->test()->create();
        [$firstPerson, $secondPerson] = Person::factory()->test()->count(2)->create();

        $company->attachPerson($firstPerson->id);
        $company->attachPerson($secondPerson->id);

        $company->updateMandatary($firstPerson->id);

        $this->assertTrue($company->fresh()->mandatary()->is($firstPerson));
        $this->assertDatabaseHas('company_person', [
            'company_id' => $company->id,
            'person_id' => $firstPerson->id,
            'is_mandatary' => true,
        ]);
        $this->assertDatabaseHas('company_person', [
            'company_id' => $company->id,
            'person_id' => $secondPerson->id,
            'is_mandatary' => false,
        ]);

        $company->updateMandatary($secondPerson->id);

        $this->assertTrue($company->fresh()->mandatary()->is($secondPerson));
        $this->assertDatabaseHas('company_person', [
            'company_id' => $company->id,
            'person_id' => $firstPerson->id,
            'is_mandatary' => false,
        ]);
        $this->assertDatabaseHas('company_person', [
            'company_id' => $company->id,
            'person_id' => $secondPerson->id,
            'is_mandatary' => true,
        ]);
    }

    #[Test]
    public function registers_search_provider_and_status_enum(): void
    {
        $searchProvider = new SearchServiceProvider(app());
        $enumProvider = new EnumServiceProvider(app());

        $this->assertSame('administration.companies', $searchProvider->register[Company::class]['permissionGroup']);
        $this->assertSame('name', $searchProvider->register[Company::class]['label']);
        $this->assertSame(\LaravelEnso\Companies\Enums\Statuses::class, $enumProvider->register['companyStatuses']);
    }
}
