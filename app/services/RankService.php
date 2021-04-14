<?php


namespace App\Services;


use App\Interfaces\URLLoader;
use Exception;

class RankService
{
    /**
     * @var URLLoader
     */
    private $urlLoader;

    public function __construct(URLLoader $loader)
    {
        $this->urlLoader = $loader;
    }

    /**
     * Loads teams list by URL and performs ranking
     * @param string $url URL of point to get teams list
     * @return array Teams ordered and ranked
     * @throws Exception
     */
    public function getRankedList(string $url): array
    {
        // Load data
        $rawData = $this->urlLoader->loadUrl($url);

        // Check
        if(empty($rawData)) {
            throw new Exception("Target url($url) return empty result");
        }

        // Parse json
        $data = json_decode($rawData, true);

        // Check parsed
        if(!is_array($data)) {
            throw new Exception("Result from point isn't a proper array");
        }

        return $this->setTeamsRanks($data);
    }

    /**
     * Reorders and ranks teams
     * @param array $teams
     * @return array
     */
    protected function setTeamsRanks(array $teams): array
    {
        // Order teams by score
        usort($teams, function($firstTeam, $secondTeam) {
            return $secondTeam['scores'] <=> $firstTeam['scores'];
        });

        $currentRank = $lastRank = 1;
        $lastScore = 0;

        // Go through teams and set ranks
        foreach($teams as &$team) {
            if($team['scores'] < $lastScore)
            {
                $currentRank = $lastRank;
            }

            $lastRank++;
            $team['rank'] = $currentRank;
            $lastScore = $team['scores'];
        }

        return $teams;
    }

}