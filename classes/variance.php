<?php
class Variance
{
    public $type;
    public $result = [];
    public $output = [];
    public $condition = [];
    public function __construct($type, $type1, $type2)
    {
        $this->type = $type;
        $this->calculateOutput($type1, $type2);
        $this->calculateCondition();
    }
    public function calculateOutput(Type $type1, SpecialType $type2)
    {
        if ($this->type == "flexible-budget") {
            for ($i = 0; $i < 10; $i++) {
                if (is_numeric($type1->output[$i])) {
                    array_push($this->result, $type1->output[$i] - $type2->output[$i]);
                    array_push($this->output, abs($this->result[$i]));
                } else {
                    array_push($this->result, "");
                    array_push($this->output, "");
                }
            }
        } else {
            for ($i = 0; $i < 10; $i++) {
                if (is_numeric($type1->output[$i])) {
                    array_push($this->result, $type2->output[$i] - $type1->output[$i]);
                    array_push($this->output, abs($this->result[$i]));
                } else {
                    array_push($this->result, "");
                    array_push($this->output, "");
                }
            }
        }
    }
    public function calculateCondition()
    {
        for ($i = 0; $i < 10; $i++) {
            if (($i >= 3 and $i <= 6) or $i == 8) {
                array_push($this->condition, (($this->result[$i] < 0) ? "F" : (($this->result[$i] > 0) ? "U" : "")));
            } else {
                array_push($this->condition, (($this->result[$i] < 0) ? "U" : (($this->result[$i] > 0) ? "F" : "")));
            }
        }
    }
}
?>