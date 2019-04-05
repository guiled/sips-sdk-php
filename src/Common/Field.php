<?php

namespace Worldline\Sips\Common;

class Field
{

    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            if ($value != null) {
                if ($value instanceof Field) {
                    $array[$key] = $value->toArray();
                } else {
                    $array[$key] = $value;
                }
            }
        }
        ksort($array);
        return $array;
    }
}