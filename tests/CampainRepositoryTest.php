<?php

use App\Models\Campain;
use App\Repositories\CampainRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CampainRepositoryTest extends TestCase
{
    use MakeCampainTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CampainRepository
     */
    protected $campainRepo;

    public function setUp()
    {
        parent::setUp();
        $this->campainRepo = App::make(CampainRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCampain()
    {
        $campain = $this->fakeCampainData();
        $createdCampain = $this->campainRepo->create($campain);
        $createdCampain = $createdCampain->toArray();
        $this->assertArrayHasKey('id', $createdCampain);
        $this->assertNotNull($createdCampain['id'], 'Created Campain must have id specified');
        $this->assertNotNull(Campain::find($createdCampain['id']), 'Campain with given id must be in DB');
        $this->assertModelData($campain, $createdCampain);
    }

    /**
     * @test read
     */
    public function testReadCampain()
    {
        $campain = $this->makeCampain();
        $dbCampain = $this->campainRepo->find($campain->id);
        $dbCampain = $dbCampain->toArray();
        $this->assertModelData($campain->toArray(), $dbCampain);
    }

    /**
     * @test update
     */
    public function testUpdateCampain()
    {
        $campain = $this->makeCampain();
        $fakeCampain = $this->fakeCampainData();
        $updatedCampain = $this->campainRepo->update($fakeCampain, $campain->id);
        $this->assertModelData($fakeCampain, $updatedCampain->toArray());
        $dbCampain = $this->campainRepo->find($campain->id);
        $this->assertModelData($fakeCampain, $dbCampain->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCampain()
    {
        $campain = $this->makeCampain();
        $resp = $this->campainRepo->delete($campain->id);
        $this->assertTrue($resp);
        $this->assertNull(Campain::find($campain->id), 'Campain should not exist in DB');
    }
}
