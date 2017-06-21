<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugCommentTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugCommentTable Test Case
 */
class DrugCommentTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugCommentTable
     */
    public $DrugComment;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drug_comment',
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
        'app.devices',
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
        $config = TableRegistry::exists('DrugComment') ? [] : ['className' => 'App\Model\Table\DrugCommentTable'];
        $this->DrugComment = TableRegistry::get('DrugComment', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DrugComment);

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
