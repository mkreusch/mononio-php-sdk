<?php

namespace Montonio\Structs;

abstract class AbstractStruct
{
    public function __construct($dataArray = null)
    {
        if (is_array($dataArray)) {
            $this->setFromArray($dataArray);
        }
        return $this;
    }

    public function setFromArray($dataArray): void
    {
        foreach ($dataArray as $fieldName => $fieldValue) {
            $methodName = 'set' . ucfirst($fieldName);
            if (is_array($fieldValue)) {
                $className = __NAMESPACE__ . '\\' . ucfirst($fieldName);
                if (class_exists($className)) {
                    $fieldValue = new $className($fieldValue);
                }
            }
            if (method_exists($this, $methodName)) {
                $this->{$methodName}($fieldValue);
            }
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $return = [];
        foreach (array_keys(get_object_vars($this)) as $property) {
            if (!isset($this->{$property})) {
                continue;
            }
            if (is_object($this->{$property}) && method_exists($this->{$property}, 'toArray')) {
                $value = $this->{$property}->toArray();
            } elseif (is_array($this->{$property})) {
                $value = [];
                foreach ($this->{$property} as $propertyElementKey => $propertyElementValue) {
                    $value[$propertyElementKey] = (is_object($propertyElementValue) && method_exists($propertyElementValue, 'toArray')) ? $propertyElementValue->toArray() : $propertyElementValue;
                }
            } else {
                $value = $this->{$property};
            }

            $return[$property] = $value;
        }
        return $return;
    }

}