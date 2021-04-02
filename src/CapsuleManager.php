<?php

namespace CapsuleCRM;

use Illuminate\Support\Str;

class CapsuleManager
{
    /**
     * Entities of capsule CRM
     *
     * @var array
     */
    private $entities=[];
    
    /**
     *  Set entities Name
     */
    public function __construct()
    {
        $this->entities=[
            'Party'=>'\\CapsuleCRM\Core\Entities\Party\Party'
        ];
    }
    
    
    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            return $this->getInstance($name);
        }
    }
    
    /**
     *
     * @param string $name
     * @return \CapsuleCRM\Core\Entity\{entity}
     * @throws Exception
     */
    private function getInstance($name)
    {
        foreach ($this->entities as $entity=>$class) {
            if (Str::studly(strtolower($name))== Str::studly(strtolower($entity))) {
                return $this->getSingleTon($class);
            }
        }
        throw new Exception("This Entity $name not exist");
    }
    
    private function getSingleTon($class)
    {
        if (array_key_exists($class, app()->getBindings())) {
            return resolve($class);
        }
        app()->singleton($class);
        return resolve($class);
    }
}
