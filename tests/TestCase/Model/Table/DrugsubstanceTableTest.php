<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugsubstanceTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugsubstanceTable Test Case
 */
class DrugsubstanceTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugsubstanceTable
     */
    public $Drugsubstance;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drugsubstance'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Drugsubstance') ? [] : ['className' => 'App\Model\Table\DrugsubstanceTable'];
        $this->Drugsubstance = TableRegistry::get('Drugsubstance', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Drugsubstance);

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
