<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugspecializationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugspecializationTable Test Case
 */
class DrugspecializationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugspecializationTable
     */
    public $Drugspecialization;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drugspecialization'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Drugspecialization') ? [] : ['className' => 'App\Model\Table\DrugspecializationTable'];
        $this->Drugspecialization = TableRegistry::get('Drugspecialization', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Drugspecialization);

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
}
