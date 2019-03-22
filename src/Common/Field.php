<?php

namespace Worldline\Sips\Common;

class Field
{

    public function toArray(): array
    {
        $array = [];
        foreach ($this as $key => $value) {
            if ($value != null) {
                $array[$key] = $value;
            }
        }
        ksort($array);
        return $array;
    }
}