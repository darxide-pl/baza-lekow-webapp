<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugRobotTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugRobotTable Test Case
 */
class DrugRobotTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugRobotTable
     */
    public $DrugRobot;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drug_robot'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DrugRobot') ? [] : ['className' => 'App\Model\Table\DrugRobotTable'];
        $this->DrugRobot = TableRegistry::get('DrugRobot', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DrugRobot);

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
