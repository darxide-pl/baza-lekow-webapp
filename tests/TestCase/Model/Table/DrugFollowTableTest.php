<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugFollowTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugFollowTable Test Case
 */
class DrugFollowTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugFollowTable
     */
    public $DrugFollow;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drug_follow',
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
        'app.comments',
        'app.users',
        'app.roles'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DrugFollow') ? [] : ['className' => 'App\Model\Table\DrugFollowTable'];
        $this->DrugFollow = TableRegistry::get('DrugFollow', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DrugFollow);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
