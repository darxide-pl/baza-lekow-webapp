<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugtreatmentTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugtreatmentTable Test Case
 */
class DrugtreatmentTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugtreatmentTable
     */
    public $Drugtreatment;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drugtreatment'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Drugtreatment') ? [] : ['className' => 'App\Model\Table\DrugtreatmentTable'];
        $this->Drugtreatment = TableRegistry::get('Drugtreatment', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Drugtreatment);

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
