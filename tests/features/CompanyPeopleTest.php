<?php

use Faker\Factory;
use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\People\app\Models\Person;
use LaravelEnso\Companies\app\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompanyPeopleTest extends TestCase
{
    use RefreshDatabase;

    private $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->company = factory(Company::class)
            ->create();

        $this->testModel = factory(Person::class)
            ->make();
    }

    /** @test */
    public function can_view_create_form()
    {
        $this->get(route('administration.companies.people.create', [$this->company->id], false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    /** @test */
    public function can_view_edit_form()
    {
        $this->setCompany();

        $this->get(route('administration.companies.people.edit', [$this->testModel->id], false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    /** @test */
    public function can_associate_person()
    {
        $this->testModel->save();
        $this->testModel->company_id = $this->company->id;

        $response = $this->post(
            route('administration.companies.people.store', [], false),
            $this->testModel->toArray()
        );

        Person::whereName($this->testModel->name)
            ->first();

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }

    /** @test */
    public function can_update_person()
    {
        $this->setCompany();
        $this->testModel->position = 'updated';

        $this->patch(
            route('administration.companies.people.update', [$this->testModel->id], false),
            $this->testModel->toArray()
        )->assertStatus(200)
        ->assertJsonStructure(['message']);

        $this->assertEquals('updated', $this->testModel->fresh()->position);
    }

    /** @test */
    public function can_get_option_list()
    {
        $this->setCompany();

        $this->get(route('administration.people.options', [
            'query' => $this->testModel->name,
            'limit' => 10,
        ], false))
        ->assertStatus(200)
        ->assertJsonFragment([
            'id' => $this->testModel->id,
        ]);
    }

    /** @test */
    public function can_dissociate_person()
    {
        $this->setCompany();

        $this->delete(route('administration.companies.people.destroy', [$this->testModel->id], false))
            ->assertStatus(200);

        $this->assertNull($this->testModel->fresh()->company_id);
    }

    public function setCompany()
    {
        $this->testModel->company_id = $this->company->id;
        $this->testModel->save();
    }
}
