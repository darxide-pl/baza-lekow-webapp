<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrugTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrugTable Test Case
 */
class DrugTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DrugTable
     */
    public $Drug;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.drug',
        'app.drug_category',
        'app.drug_description',
        'app.drug_form',
        'app.drug_specialization',
        'app.drug_substance',
        'app.drug_treatment',
        'app.comment',
        'app.drug_comment',
        'app.tag',
        'app.drug_tag'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Drug') ? [] : ['className' => 'App\Model\Table\DrugTable'];
        $this->Drug = TableRegistry::get('Drug', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Drug);

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
