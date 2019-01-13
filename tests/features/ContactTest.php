<?php

use Faker\Factory;
use Tests\TestCase;
use LaravelEnso\Core\app\Models\User;
use LaravelEnso\Companies\app\Models\Company;
use LaravelEnso\Companies\app\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use LaravelEnso\FormBuilder\app\TestTraits\EditForm;
use LaravelEnso\FormBuilder\app\TestTraits\DestroyForm;
use LaravelEnso\VueDatatable\app\Traits\Tests\Datatable;

class ContactTest extends TestCase
{
    use Datatable, DestroyForm, EditForm, RefreshDatabase;

    private $permissionGroup = 'administration.companies';
    private $testModel;

    protected function setUp()
    {
        parent::setUp();

        // $this->withoutExceptionHandling();

        $this->seed()
            ->actingAs(User::first());

        $this->testModel = factory(Contact::class)
            ->make();

        $this->company = factory(Company::class)
            ->create();
    }

    /** @test */
    public function can_view_create_form()
    {
        $this->get(route($this->permissionGroup.'.contacts.create', [$this->company->id], false))
            ->assertStatus(200)
            ->assertJsonStructure(['form']);
    }

    /** @test */
    public function can_store_contact()
    {
        $response = $this->post(
            route('administration.companies.contacts.store', [], false),
            $this->testModel->toArray()
        );

        Contact::whereName($this->testModel->name)
            ->first();

        $response->assertStatus(200)
            ->assertJsonStructure(['message']);
    }

    /** @test */
    public function can_update_contact()
    {
        $this->testModel->save();

        unset($this->testModel->person, $this->testModel->company);

        $this->testModel->position = 'updated';

        $this->patch(
            route('administration.companies.contacts.update', $this->testModel->id, false),
            $this->testModel->toArray()
        )->assertStatus(200)
        ->assertJsonStructure(['message']);

        $this->assertEquals('updated', $this->testModel->fresh()->position);
    }

    /** @test */
    public function can_get_option_list()
    {
        $this->testModel->save();

        $this->get(route('administration.companies.contacts.options', [
            'query' => $this->testModel->person->name,
            'limit' => 10,
        ], false))
        ->assertStatus(200)
        ->assertJsonFragment([
            'person_id' => $this->testModel->person->id,
        ]);
    }
}
