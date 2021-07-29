<?php
    class Type {
        public $type;
        public $unitsSold;
        public $sellingPriceUnit;
        public $directMaterialUnit;
        public $directManufacturingLaborUnit;
        public $variableManufacturingOverheadUnit;
        public $fixedManufacturingOverhead;
        public $output = [];
        public $revenue;
        public $directMaterial;
        public $directManufacturingLabor;
        public $variableManufacturingOverhead;
        public $totalVariableCost;
        public $contributionMargin;
        public $operatingIncome;
        public function __construct($type) 
        {
            $this->type = $type;
            $this->getUserInput();
            $this->calculateOutput();
        }
        public function getUserInput()
        {
            if (!empty($_POST)) {
                $categoryInputName = ['_units_sold', '_selling_price_unit', '_direct_material_unit', '_direct_manufacturing_labor_unit', '_variable_manufacturing_overhead_unit', '_fixed_manufacturing_overhead'];
                $categoryInputNameOfType = [];
                for ($i=0; $i < count($categoryInputName); $i++) { 
                    array_push($categoryInputNameOfType, $this->type . $categoryInputName[$i]);
                }
                $this->unitsSold = $_POST[$categoryInputNameOfType[0]];
                $this->sellingPriceUnit = $_POST[$categoryInputNameOfType[1]];
                $this->directMaterialUnit = $_POST[$categoryInputNameOfType[2]];
                $this->directManufacturingLaborUnit = $_POST[$categoryInputNameOfType[3]];
                $this->variableManufacturingOverheadUnit = $_POST[$categoryInputNameOfType[4]];
                $this->fixedManufacturingOverhead = $_POST[$categoryInputNameOfType[5]];
            }
        }
        public function calculateOutput()
        {
            array_push($this->output, $this->unitsSold);
            $this->revenue = $this->unitsSold * $this->sellingPriceUnit;
            array_push($this->output, $this->revenue);
            array_push($this->output, "");
            $this->directMaterial = $this->unitsSold * $this->directMaterialUnit;
            array_push($this->output, $this->directMaterial);
            $this->directManufacturingLabor = $this->unitsSold * $this->directManufacturingLaborUnit;
            array_push($this->output, $this->directManufacturingLabor);
            $this->variableManufacturingOverhead = $this->unitsSold * $this->variableManufacturingOverheadUnit;
            array_push($this->output, $this->variableManufacturingOverhead);
            $this->totalVariableCost = $this->directMaterial + $this->directManufacturingLabor + $this->variableManufacturingOverhead;
            array_push($this->output, $this->totalVariableCost);
            $this->contributionMargin = $this->revenue - $this->totalVariableCost;
            array_push($this->output, $this->contributionMargin);
            array_push($this->output, $this->fixedManufacturingOverhead);
            $this->operatingIncome = $this->contributionMargin - $this->fixedManufacturingOverhead;
            array_push($this->output, $this->operatingIncome);
        }
    }
    class SpecialType extends Type
    {
        public function getUserInput()
        {
            if (!empty($_POST)) {
                $categoryInputName = ['_units_sold', '_selling_price_unit', '_direct_material_unit', '_direct_manufacturing_labor_unit', '_variable_manufacturing_overhead_unit', '_fixed_manufacturing_overhead'];
                $categoryInputNameOfType = [];
                array_push($categoryInputNameOfType, "actual" . $categoryInputName[0]);
                for ($i=1; $i < count($categoryInputName); $i++) { 
                    array_push($categoryInputNameOfType, "budgeted" . $categoryInputName[$i]);
                }
                $this->unitsSold = $_POST[$categoryInputNameOfType[0]];
                $this->sellingPriceUnit = $_POST[$categoryInputNameOfType[1]];
                $this->directMaterialUnit = $_POST[$categoryInputNameOfType[2]];
                $this->directManufacturingLaborUnit = $_POST[$categoryInputNameOfType[3]];
                $this->variableManufacturingOverheadUnit = $_POST[$categoryInputNameOfType[4]];
                $this->fixedManufacturingOverhead = $_POST[$categoryInputNameOfType[5]];
            }
        }
    }
    
?>