<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * DrugFollow Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Drugs
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\DrugFollow get($primaryKey, $options = [])
 * @method \App\Model\Entity\DrugFollow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DrugFollow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DrugFollow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DrugFollow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DrugFollow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DrugFollow findOrCreate($search, callable $callback = null, $options = [])
 */
class FollowsTable extends Table
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

        $this->setTable('drug_follow');
        $this->setDisplayField('drug_id');
        $this->setPrimaryKey(['drug_id', 'user_id']);

        $this->belongsTo('Drugs', [
            'foreignKey' => 'drug_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['drug_id'], 'Drugs'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }
}
