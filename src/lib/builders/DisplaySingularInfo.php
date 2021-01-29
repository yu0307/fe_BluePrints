<?php

namespace feiron\fe_blueprints\lib\builders;

use feiron\fe_blueprints\lib\BluePrintsMethodBuilderBase;

class DisplaySingularInfo extends BluePrintsMethodBuilderBase {

    public function __construct($MethodDefinition = null, $ModelList){
        parent::__construct(($MethodDefinition??[]), $ModelList);
    }

    public function BuildMethod(): string{

        return $this->PrepareModels().'
        '. $this->PrepareInputs(). '
                        $withData=array_merge($withData,(($query->first()??new Collection([]))->toArray()));
        ';
    }
}