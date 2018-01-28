<?php

namespace AppBundle\Service;

use GuzzleHttp\Client;

class GithubApi
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function searchUser($username)
    {
        try {

            $results = $this->client->get("search/users?q=$username+in:login");
            $users = json_decode($results->getBody()->getContents(), true);

        } catch (\Exception $e) {

            return "L'API GitHub ne répond pas";

        }

        return $users['items'];

    }

    public function searchRepository($repoName, $username)
    {
        try {

            $results = $this->client->get("/search/repositories?q=$repoName+user:$username");
            $repos = json_decode($results->getBody()->getContents(), true);

        } catch (\Exception $e) {

            return "L'API GitHub ne répond pas";

        }

        return $repos['items'];

    }
}