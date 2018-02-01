<?php

namespace CapsuleCRM\Core\Entities\Party;

class PrepareDataForParty
{

    /**
     * the body of data
     *
     * @var array
     */
    private $body;

    /**
     * the data from user
     *
     * @var array
     */
    private $data;

    /**
     * prepare tags
     *
     * @param array $data
     */
    public function tags()
    {
        foreach ($this->data['tags'] as $tag) {
            $this->body['party']['tags'][] = [
                'name' => $tag
            ];
        }

        return $this;
    }

    /**
     * Prepare typegetBody
     *
     * @return $this
     */
    public function type()
    {
        $this->body['party']['type'] = valueExist($this->data, 'type', 'person');

        return $this;
    }
    
    /**
     * prepare email
     *
     * @return $this
     */
    public function email()
    {
        if (array_has($this->data, 'email')) {
            $this->body['party']['emailAddresses'] = [
                ['type' => 'Work', 'address' => $this->data['email']]
            ];
        }
        
        return $this;
    }

    /**
     * Prepare name
     *
     * @return $this
     */
    public function name()
    {
        $this->body['party']['firstName'] = valueExist($this->data, 'first_name', valueExist($this->data, 'name', $this->data['email']));
        $this->body['party']['lastName'] = valueExist($this->data, 'last_name', '');

        return $this;
    }
    
    /**
     * Set name
     *
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;
        $this->body = [
            'party' => []
        ];
        
        return $this;
    }

    /**
     * get Body
     *
     * @return type
     */
    public function getBody()
    {
        return $this->body;
    }
}
