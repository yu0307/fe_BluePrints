<?php

namespace feiron\fe_BluePrints\lib\builders;

use feiron\fe_BluePrints\lib\BluePrintsMethodBuilderBase;

class DisplayCollection extends BluePrintsMethodBuilderBase {

    public function __construct($MethodDefinition = null, $ModelList){
        parent::__construct(($MethodDefinition??[]), $ModelList);
    }

    public function BuildMethod(): string
    {

        return $this->PrepareModels() . '
        ' . $this->PrepareInputs() . '
                        $withData=["collection"=>($query->get()??new Collection([]))->toArray()];
        ';
    }

}