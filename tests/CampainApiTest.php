<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CampainApiTest extends TestCase
{
    use MakeCampainTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCampain()
    {
        $campain = $this->fakeCampainData();
        $this->json('POST', '/api/v1/campains', $campain);

        $this->assertApiResponse($campain);
    }

    /**
     * @test
     */
    public function testReadCampain()
    {
        $campain = $this->makeCampain();
        $this->json('GET', '/api/v1/campains/'.$campain->id);

        $this->assertApiResponse($campain->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCampain()
    {
        $campain = $this->makeCampain();
        $editedCampain = $this->fakeCampainData();

        $this->json('PUT', '/api/v1/campains/'.$campain->id, $editedCampain);

        $this->assertApiResponse($editedCampain);
    }

    /**
     * @test
     */
    public function testDeleteCampain()
    {
        $campain = $this->makeCampain();
        $this->json('DELETE', '/api/v1/campains/'.$campain->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/campains/'.$campain->id);

        $this->assertResponseStatus(404);
    }
}
