<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Drugsubstance Model
 *
 * @method \App\Model\Entity\Drugsubstance get($primaryKey, $options = [])
 * @method \App\Model\Entity\Drugsubstance newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Drugsubstance[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Drugsubstance|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Drugsubstance patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Drugsubstance[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Drugsubstance findOrCreate($search, callable $callback = null, $options = [])
 */
class SubstancesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('drugsubstance');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        return $validator;
    }
}
