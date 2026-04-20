<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\People\Models\Person;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompaniesPeopleTest extends TestCase
{
    use RefreshDatabase;

    private Company $company;
    private Person $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed()
            ->actingAs(User::first());

        $this->company = Company::factory()->test()->create();
        $this->testModel = Person::factory()->test()->create();
    }

    #[Test]
    public function can_view_create_form(): void
    {
        $this->get(route('administration.companies.people.create', [$this->company->id], false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    #[Test]
    public function can_view_edit_form(): void
    {
        $this->associatePerson();

        $this->get(route(
            'administration.companies.people.edit',
            [$this->company->id, $this->testModel->id],
            false
        ))->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    #[Test]
    public function can_list_associated_people(): void
    {
        $this->associatePerson('Administrator');

        $this->get(route('administration.companies.people.index', [$this->company->id], false))
            ->assertStatus(200)
            ->assertJsonFragment([
                'id'       => $this->testModel->id,
                'position' => 'Administrator',
            ]);
    }

    #[Test]
    public function can_associate_person(): void
    {
        $response = $this->post(route('administration.companies.people.store', [], false), [
            'company_id' => $this->company->id,
            'id'         => $this->testModel->id,
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertTrue($this->testModel->fresh()->companies()->first()->id === $this->company->id);
    }

    #[Test]
    public function rejects_duplicate_person_association(): void
    {
        $this->associatePerson();

        $this->post(route('administration.companies.people.store', [], false), [
            'company_id' => $this->company->id,
            'id'         => $this->testModel->id,
        ])->assertStatus(302)
            ->assertSessionHasErrors(['id']);
    }

    #[Test]
    public function can_update_person(): void
    {
        $this->associatePerson();

        $this->patch(route('administration.companies.people.update', [$this->testModel->id], false), [
            'company_id' => $this->company->id,
            'id'         => $this->testModel->id,
            'position'   => 'updated',
        ])->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertEquals('updated', $this->testModel->fresh()->companies()->first()->pivot->position);
    }

    #[Test]
    public function can_get_option_list(): void
    {
        $this->associatePerson();

        $this->get(route('administration.people.options', [
            'query' => $this->testModel->name,
            'limit' => 10,
        ], false))->assertStatus(200)
            ->assertJsonFragment(['id' => $this->testModel->id]);
    }

    #[Test]
    public function can_dissociate_non_mandatary_person(): void
    {
        $this->associatePerson();

        $this->delete(route(
            'administration.companies.people.destroy',
            [$this->company->id, $this->testModel->id],
            false
        ))->assertStatus(200);

        $this->assertCount(0, $this->testModel->fresh()->companies);
    }

    #[Test]
    public function can_dissociate_sole_mandatary_person(): void
    {
        $this->associatePerson();
        $this->company->updateMandatary($this->testModel->id);

        $this->delete(route(
            'administration.companies.people.destroy',
            [$this->company->id, $this->testModel->id],
            false
        ))->assertStatus(200);

        $this->assertCount(0, $this->testModel->fresh()->companies);
    }

    #[Test]
    public function cannot_dissociate_mandatary_when_other_people_are_attached(): void
    {
        $otherPerson = Person::factory()->test()->create();

        $this->associatePerson();
        $this->company->attachPerson($otherPerson->id);
        $this->company->updateMandatary($this->testModel->id);

        $this->delete(route(
            'administration.companies.people.destroy',
            [$this->company->id, $this->testModel->id],
            false
        ))->assertStatus(488)
            ->assertJsonFragment([
                'message' => __('You cannot dissociate the mandatary unless is the only one attached on this company'),
            ]);
    }

    private function associatePerson(?string $position = null): void
    {
        $this->testModel->companies()->attach($this->company->id, [
            'is_main'      => false,
            'is_mandatary' => false,
            'position'     => $position,
        ]);
    }
}
