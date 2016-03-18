<?php

class Promotion extends Model {

    protected $properties = [
        'year'   => 0,
        'groups' => []
    ];
    
    public function create($year, array $groups) {
        return $this->insert([
            'year' => $year,
            'groups' => $groups,
        ]);
    }

    public function hasStudent($student) {
        foreach ($this->getGroup() as $group) {
            if ($group->hasStudent($student)) {
                return true;
            }
        }
        return false;
    }

    public function getGroup($id) {
        return $this->getCollection('Group', $id);
    }

    public function getGroups() {
        return $this->getCollection('Group');
    }

    public function hasGroup($id = null) {
        return $this->hasCollection('Group', $id);
    }

    public function addGroup($id) {
        return $this->addCollection('Group', $id);
    }

    public function removeGroup($id) {
        return $this->removeCollection('Group', $id);
    }

}
