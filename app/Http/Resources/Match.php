<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Match extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
          'id' => $this->id,
          'status' => $this->status,
          'matchday' => $this->matchday,
          'homeTeamName' => $this->homeTeamName,
          'awayTeamName' => $this->awayTeamName,
          'results' => [
              'result_GoalsHomeTeam' => $this->result_GoalsHomeTeam,
              'result_GoalsAwayTeam' => $this->result_GoalsAwayTeam,
              'halftime' => [
                  'halfTime_result_GoalsHomeTeam' => $this->halfTime_result_GoalsHomeTeam,
                  'halfTime_result_GoalsAwayTeam' => $this->halfTime_result_GoalsAwayTeam,
              ],
              'extraTime' => [
                  'extraTime_result_GoalsHomeTeam' => $this->extraTime_result_GoalsHomeTeam,
                  'extraTime_result_GoalsAwayTeam' => $this->extraTime_result_GoalsAwayTeam,
              ],
              'penaltyShootout' => [
                  'penaltyShootout_result_GoalsHomeTeam' => $this->penaltyShootout_result_GoalsHomeTeam,
                  'penaltyShootout_result_GoalsAwayTeam' => $this->penaltyShootout_result_GoalsAwayTeam,
              ]
          ]
        ];
    }

    public function with($request)
    {
        return [
            'version' => '0.0.1',
            'author_url' => url('https://laravel.com/')
        ];
    }
}
