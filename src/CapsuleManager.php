<?php

namespace CapsuleCRM;

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
            if (studly_case(strtolower($name))== studly_case(strtolower($entity))) {
                return $this->getSingleTon($class);
            }
        }
        throw new Exception("This Entity $name not exist");
    }
    
    private function getSingleTon($class)
    {
        try {
            return resolve($class);
        } catch (ReflectionException $ex) {
            app()->singleton($class);
            return resolve($class);
        }
    }
}
