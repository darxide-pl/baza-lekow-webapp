<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugtagTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugtagTable Test Case
 */
class DrugtagTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugtagTable
     */
    public $Drugtag;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drugtag'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Drugtag') ? [] : ['className' => 'App\Model\Table\DrugtagTable'];
        $this->Drugtag = TableRegistry::get('Drugtag', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Drugtag);

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
