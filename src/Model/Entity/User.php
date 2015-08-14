<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity.
 */
class User extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
	
	public function parentNode()
	{
		if (!$this->id) {
			return null;
		}
		if (isset($this->group_id)) {
			$groupId = $this->group_id;
		} else {
			$Users = TableRegistry::get('Users');
			$user = $Users->find('all', ['fields' => ['group_id']])->where(['id' => $this->id])->first();
			$groupId = $user->group_id;
		}
		if (!$groupId) {
			return null;
		}
		return ['Groups' => ['id' => $groupId]];
	}
}
