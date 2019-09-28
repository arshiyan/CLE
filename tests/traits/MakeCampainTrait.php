<?php

use Faker\Factory as Faker;
use App\Models\Campain;
use App\Repositories\CampainRepository;

trait MakeCampainTrait
{
    /**
     * Create fake instance of Campain and save it in database
     *
     * @param array $campainFields
     * @return Campain
     */
    public function makeCampain($campainFields = [])
    {
        /** @var CampainRepository $campainRepo */
        $campainRepo = App::make(CampainRepository::class);
        $theme = $this->fakeCampainData($campainFields);
        return $campainRepo->create($theme);
    }

    /**
     * Get fake instance of Campain
     *
     * @param array $campainFields
     * @return Campain
     */
    public function fakeCampain($campainFields = [])
    {
        return new Campain($this->fakeCampainData($campainFields));
    }

    /**
     * Get fake data of Campain
     *
     * @param array $postFields
     * @return array
     */
    public function fakeCampainData($campainFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'name' => $fake->word,
            'post_url' => $fake->word,
            'post_id' => $fake->randomDigitNotNull,
            'total_winner' => $fake->randomDigitNotNull,
            'status' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $campainFields);
    }
}
