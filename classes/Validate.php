<?php

class Validate
{
    private $_passed = false,
        $_errors = array(),
        $_db = null;

    /**
     * Validate constructor.
     */
    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    /**
     * @param $source
     * @param array $items
     * @return $this
     */
    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            foreach ($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                $itemName = $rules['name'];
                if ($rule === 'required' && empty($value)) {
                    $this->addError("{$itemName} is required");
                } else if (!empty($value)) {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("{$item} Must be a minimum of {$rule_value} characters");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("{$item} Must be a maximum of {$rule_value} characters");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("{$rule_value} Must match {$itemName}");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));

                            if ($check->count()) {
                                $this->addError("{$itemName} Already exists");
                            }
                            break;
                    }
                }
            }
        }

        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    /**
     * @param $error
     */
    private function addError($error)
    {
        $this->_errors[] = $error;
    }

    /**
     * @return array
     */
    public function errors()
    {
        return $this->_errors;
    }

    /**
     * @return bool
     */
    public function passed()
    {
        return $this->_passed;
    }
}