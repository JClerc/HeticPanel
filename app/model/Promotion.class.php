<?php

class Promotion extends DataModel {

    protected $properties = [
        'year'   => 0,
        'groups' => []
    ];

    public function validate($year, array $groups = []) {

        Validate::isInteger($year, 'L\'année est incorrecte.');

        Validate::isEmpty(Promotion::find([
            'year' => $year,
        ]), 'Une promotion avec cette année existe déjà.');

        Validate::isArray($groups, 'La liste des groupes est incorrecte.');

    }
    
    public function create($year, array $groups) {

        $this->validate($year, $groups);

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

    public function getYear() {
        return $this->get('year');
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

    public static function sort($list) {
        usort($list, function ($a, $b) { return $a->getYear() - $b->getYear(); });
        return $list;
    }

    protected function onDelete() {
        $groups = Group::make()->find();
        foreach ($groups as $group) {
            if ($group->getPromotion()->getId() === $this->getId()) {
                $group->set('promotion', 0);
                $group->save();
            }
        }
    }

}
