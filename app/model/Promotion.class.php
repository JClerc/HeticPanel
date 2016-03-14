<?php

class Promotion extends Model {

    protected $properties = [
        'year'   => 0,
        'groups' => []
    ];
    
    public function create($year, array $groups) {

        $ids = [];
        foreach ($groups as $group) {
            $ids[] = $group->getId();
        }

        return $this->make([
            'year' => $teacher->getId(),
            'groups' => implode(',', $ids),
        ]);

    }

    private function setProperty($key, $value) {
        if ($key === 'groups') {
            $groups = explode(',', $value);
            $value = [];
            foreach ($groups as $id) {
                $group = new Group;
                $value[] = $group->fromId($id);
            }
        }
        parent::setProperty($key, $value);
    }

    public function hasStudent(User $student) {
        foreach ($this->groups as $group) {
            if ($group->hasStudent($student)) {
                return true;
            }
        }
        return false;
    }

    public function getGroups() {
        return $this->groups;
    }

    public function addGroup(Group $group) {
        $this->removeGroup($group);
        $this->groups[] = $group;
    }

    public function removeGroup(Group $group) {
        foreach ($this->groups as $key => $value) {
            if ($group->equals($value)) {
                unset($this->groups[$key]);
                return true;
            }
        }
        return false;
    }

}
