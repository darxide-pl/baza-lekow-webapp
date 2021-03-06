<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Drug Model
 *
 * @property \Cake\ORM\Association\HasMany $DrugCategory
 * @property \Cake\ORM\Association\HasMany $DrugDescription
 * @property \Cake\ORM\Association\HasMany $DrugForm
 * @property \Cake\ORM\Association\HasMany $DrugSpecialization
 * @property \Cake\ORM\Association\HasMany $DrugSubstance
 * @property \Cake\ORM\Association\HasMany $DrugTreatment
 * @property \Cake\ORM\Association\BelongsToMany $Comment
 * @property \Cake\ORM\Association\BelongsToMany $Tag
 *
 * @method \App\Model\Entity\Drug get($primaryKey, $options = [])
 * @method \App\Model\Entity\Drug newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Drug[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Drug|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Drug patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Drug[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Drug findOrCreate($search, callable $callback = null, $options = [])
 */
class DrugsTable extends Table
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

        $this->setTable('drug');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');


        $this->belongsToMany('Categories' , [
                'foreignKey' => 'drug_id', 
                'targetForeignKey' => 'category_id', 
                'joinTable' => 'drug_category'
            ]);

        $this->belongsToMany('Substances' , [
                'foreignKey' => 'drug_id', 
                'targetForeignKey' => 'substance_id', 
                'joinTable' => 'drug_substance'
            ]);        

        $this->belongsToMany('Specializations' , [
                'foreignKey' => 'drug_id', 
                'targetForeignKey' => 'specialization_id', 
                'joinTable' => 'drug_specialization'
            ]);        

        $this->belongsToMany('Forms' , [
                'foreignKey' => 'drug_id', 
                'targetForeignKey' => 'form_id', 
                'joinTable' => 'drug_form'
            ]);

        $this->belongsToMany('Treatments' , [
                'foreignKey' => 'drug_id', 
                'targetForeignKey' => 'treatment_id', 
                'joinTable' => 'drug_treatment'
            ]);        

        $this->belongsToMany('Tags' , [
                'foreignKey' => 'drug_id', 
                'targetForeignKey' => 'tag_id', 
                'joinTable' => 'drug_tag'
            ]);

        $this->hasMany('Comments' , [
                'foreignKey' => 'drug_id'
            ]);
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
            ->dateTime('add_date')
            ->requirePresence('add_date', 'create')
            ->notEmpty('add_date');

        $validator
            ->dateTime('last_modify')
            ->requirePresence('last_modify', 'create')
            ->notEmpty('last_modify');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->integer('views')
            ->requirePresence('views', 'create')
            ->notEmpty('views');

        $validator
            ->boolean('public')
            ->allowEmpty('public');

        return $validator;
    }
}
