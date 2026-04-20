<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Forms\TestTraits\DestroyForm;
use LaravelEnso\Forms\TestTraits\EditForm;
use LaravelEnso\Tables\Traits\Tests\Datatable;
use LaravelEnso\Users\Models\User;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CompaniesCrudTest extends TestCase
{
    use Datatable;
    use DestroyForm;
    use EditForm;
    use RefreshDatabase;

    private string $permissionGroup = 'administration.companies';
    private Company $testModel;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = Company::factory()->test()->make();
    }

    #[Test]
    public function can_view_create_form(): void
    {
        $this->get(route($this->permissionGroup.'.create', false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    #[Test]
    public function can_store_company(): void
    {
        $response = $this->post(
            route('administration.companies.store', [], false),
            $this->testModel->toArray()
        );

        $company = Company::whereName($this->testModel->name)->first();

        $response->assertStatus(200)
            ->assertJsonStructure(['message'])
            ->assertJsonFragment([
                'redirect' => 'administration.companies.edit',
                'param'    => ['company' => $company->id],
            ]);
    }

    #[Test]
    public function rejects_invalid_fiscal_code_on_store(): void
    {
        $response = $this->post(
            route('administration.companies.store', [], false),
            array_merge($this->testModel->toArray(), ['fiscal_code' => '0'])
        );

        $response->assertStatus(302)
            ->assertSessionHasErrors(['fiscal_code']);
    }

    #[Test]
    public function can_update_company(): void
    {
        $this->testModel->save();
        $this->testModel->name = 'updated';

        $this->patch(
            route('administration.companies.update', $this->testModel->id, false),
            $this->testModel->toArray()
        )->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertEquals(
            $this->testModel->name,
            $this->testModel->fresh()->name
        );
    }

    #[Test]
    public function rejects_mandatary_that_is_not_associated_to_company(): void
    {
        $company = Company::factory()->test()->create();
        $person = \LaravelEnso\People\Models\Person::factory()->test()->create();

        $this->patch(route('administration.companies.update', $company->id, false), [
            ...$company->toArray(),
            'mandatary' => $person->id,
        ])->assertStatus(302)
            ->assertSessionHasErrors(['mandatary']);
    }

    #[Test]
    public function get_option_list(): void
    {
        $this->testModel->save();

        $this->get(route('administration.companies.options', [
            'query' => $this->testModel->name,
            'limit' => 10,
        ], false))->assertStatus(200)
            ->assertJsonFragment(['name' => $this->testModel->name]);
    }
}
