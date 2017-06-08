<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugformTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugformTable Test Case
 */
class DrugformTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugformTable
     */
    public $Drugform;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drugform'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Drugform') ? [] : ['className' => 'App\Model\Table\DrugformTable'];
        $this->Drugform = TableRegistry::get('Drugform', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Drugform);

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
