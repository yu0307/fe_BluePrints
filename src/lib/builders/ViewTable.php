<?php

namespace feiron\fe_blueprints\lib\builders;

use feiron\fe_blueprints\lib\BluePrintsViewBuilderBase;

class ViewTable extends BluePrintsViewBuilderBase {

    protected $headers;
    protected $headerDef;

    public function __construct($MethodDefinition = null, $ModelList){
        parent::__construct(($MethodDefinition??[]), $ModelList);
        $this->headers = [];
        $this->headerDef = [];
        $baseModel = null;
        foreach (($this->ViewDefinition['FieldList'] ?? []) as $fieldDefinition) {
            if (!isset($baseModel)) $baseModel = $this->ModelList[$fieldDefinition['modelName']];
            if (count($fieldDefinition['Fields'] ?? []) > 0) {
                if (isset($fieldDefinition['type']) && $fieldDefinition['type'] == 'with') {
                    if (in_array(strtolower($baseModel->getRelationType($fieldDefinition['modelName'])), ['onetomany', 'manytomany'])) {
                        $fieldName = $fieldDefinition['modelName'];
                        array_push($this->headerDef, ("
                                                    ['data'=>null, 'defaultContent'=>'<button dataTarget=\"" . strtolower($fieldName) . "s\" class=\"dt_details btn btn-sm btn-mini btn-primary\">View Details</button>','className'=>'disableFilter','searchable'=>false,'orderable'=>false]"));
                        array_push($this->headers, ("'" . ($fieldDefinition['label'] ?? $fieldName) . "'"));
                        continue;
                    }
                }
                foreach ($fieldDefinition['Fields'] as $field) {
                    array_push($this->headerDef, ("
                                                    ['data'=>'" . $fieldDefinition['modelName'] . '~' . $field->name . "']"));
                    array_push($this->headers, ("'" . ($field->label ?? $field->name) . "'"));
                }
            }
        }
    }

    public function BuildView(): string{
        return '<div class="container-fluid">
                        <div class="row">
                            <div class="panel-group" id="My_DataTable">
                                <fe-data-table
                                    id="DataTable_'. $this->ViewDefinition['name']. '"
                                    header-bg="none"
                                    '.((($this->ViewDefinition['headerSearch']??false)===true)? ':enable-header-search="true"':'').'
                                    :header-list=\'['.join(',', $this->headers). ']\'
                                    :js-settins=\'["serverSide" => true, "ajax" => [ "url" => route("bpr_dTable_sr_'. $this->ViewDefinition["name"]. '"), "type" => "POST"],"columns" => [' . join(',', $this->headerDef) . '] ]\'
                                >

                                </fe-data-table>
                            </div>
                        </div>
                    </div>';
    }
}