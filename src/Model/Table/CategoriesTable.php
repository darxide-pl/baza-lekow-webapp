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
class CategoriesTable extends Table
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

        $this->setTable('drugcategory');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

    }
}