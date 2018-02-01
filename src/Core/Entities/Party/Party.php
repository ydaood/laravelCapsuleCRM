<?php

namespace CapsuleCRM\Core\Entities\Party;

use CapsuleCRM\Core\CapsulecrmManager;
use Illuminate\Support\Facades\Validator;

class Party extends CapsulecrmManager
{
    /**
     *
     * @var PrepareDataForParty
     */
    private $prepareDataFactory;
    /**
     * Party constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->url = "parties";
        $this->prepareDataFactory=new PrepareDataForParty();
    }

    /**
     * Register new user(party) on capsule CRM or update existing user
     *
     * @param array $data array of user data
     * @param string $tag
     * @return \App\Services\Capsulecrm\ClientException|\App\Services\Capsulecrm\Response|\App\Services\Capsulecrm\type|int
     */
    public function register(array $data, $tag)
    {
        $data['tags'][] = $tag;
        $this->validation($data);
        $valid = $this->validateUniqueEmail($data['email']);

        if ($valid === true) {
            return $this->store($data);
        } else {
            $body = $this->prepareDataFactory->setData(['tags' => $data['tags']])->tags()->getBody();

            return $this->update($valid, $body);
        }
    }

    /**
     * Store Party
     *
     * @param array $data
     * @return type
     */
    public function store(array $data)
    {
        $body = $this->prepareDataFactory->setData($data)->name()->type()->email()->tags()->getBody();

        return $this->post($body);
    }

    /**
     *
     * @param int $id
     * @param array $data
     * @return int|ClientException|Response
     */
    public function update($id, array $data)
    {
        $url = $this->url."/$id";

        return $this->put($data, $url);
    }

    /**
     * Validate data
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    private function validation(array $data)
    {
        $validation = Validator::make($data, [
            'email' => 'required|email',
            'tags' => 'required|array',
            'tags.*' => 'string',
        ]);

        if ($validation->errors()->isEmpty()) {
            return true;
        } else {
            throw new \Exception(array_first($validation->errors()->getMessages())[0], 406);
        }
    }

    /**
     * Validate if user email exist on Capsule
     *
     * @param $email string
     * @return mix (true if email not exist otherwise return user id)
     */
    public function validateUniqueEmail($email)
    {
        $response= $this->search($email);
        if ($response!=false) {
            return $response[0]->id;
        }

        return true;
    }
    
    /**
     * Search For Party by any $filter on Capsule
     *
     * @param $filter string
     * @return mix (false if email not exist otherwise return user id)
     */
    public function search($filter)
    {
        $query = $this->url.'/search?'."q=$filter";
        $response = $this->get(false, $query);
        checkResponseException($response);
        if (count($response->parties)) {
            return $response->parties;
        }

        return false;
    }
}
