<?php

namespace webshop_v2\ElementParser;

class ElementParser
{
    public static function parseXml(string $xml) : array
    {
        $parsed_xml = simplexml_load_string($xml);
        $results = self::parseNodes($parsed_xml);
        return $results;
    }

    protected static function parseNodes(\SimpleXMLElement $xml) : array
    {
        $results = [];

        if (count($xml->attributs) > 0)
        {
            foreach($xml->attributes as $key => $value)
            {
                self::conditionalInsert($results, $key, $value);
            }
        }
        
        foreach($xml as $key => $value)
        {
            if(count($value->children()) === 0)
            {
                self::conditionalInsert($results, $key, $value);
            }
            else
            {
                $results[$key] = self::parseNodes($value->children());
            }
        }

        return $results;
    }
    //&$results manipuleert de originele array ipv een kopie te maken en die 
    //te manipuleren
    static private function conditionalInsert(array &$results, $key, $value)
    {
        if(isset($results[$key]))
        {
            $results[$key] += $value->__toString();
        }
        else
        {
            $results[$key] = $value->__toString();
        }
    }
}