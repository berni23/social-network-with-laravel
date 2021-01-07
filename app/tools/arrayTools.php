
<?php

class arrayTools
{
    static function objectToArray($object)
    {
        $array = [];
        //  $keys = get_object_vars($object);
        foreach ($object as $elem) {
            array_push($array, $elem);
        }
        return $array;
    }

    static function  merge($rel1, $rel2)
    {
        $rels = [];
        foreach ($rel1 as $rel) {
            array_push($rels, $rel);
        }

        foreach ($rel2 as $rel) {
            array_push($rels, $rel);
        }
        return $rels;
    }

    static function newFirst($p1, $p2)
    {
        if ($p1->created_at == $p2->created_at) return 0;
        return ($p1->created_at > $p2->created_at) ? -1 : 1;
    }
}
