<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugnotificationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugnotificationTable Test Case
 */
class DrugnotificationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugnotificationTable
     */
    public $Drugnotification;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drugnotification',
        'app.users',
        'app.roles',
        'app.drugs',
        'app.categories',
        'app.drug_category',
        'app.substances',
        'app.drug_substance',
        'app.specializations',
        'app.drug_specialization',
        'app.forms',
        'app.drug_form',
        'app.treatments',
        'app.drug_treatment',
        'app.tags',
        'app.drug_tag',
        'app.comments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Drugnotification') ? [] : ['className' => 'App\Model\Table\DrugnotificationTable'];
        $this->Drugnotification = TableRegistry::get('Drugnotification', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Drugnotification);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
