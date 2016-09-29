<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Domain\Repositories\AbstractRepository;

class FakeRepository extends AbstractRepository
{
	public function __construct($modelMockery)
	{
		$this->model = $modelMockery;
	}

	// This can implemented in AbstractRepository (?)
	public function findById($id, array $columns = ['*']){
		return $this->model->find($id, $columns);
	}
}

class AbstractRepositoryTest extends TestCase
{
	public function setUp()
	{
		parent::setUp();

		$this->modelMock = Mockery::mock('stdClass');
		$this->repositoryFake = new FakeRepository($this->modelMock);
	}

    public function testLoad()
    {
    	$this->modelMock
    		->shouldReceive('with')
    		->with([1, 2])
    		->once()
    		->andReturnSelf();

    	$this->repositoryFake->load([1, 2]);
        $this->assertEquals($this->modelMock, $this->repositoryFake->make());
    }

    public function testAll()
    {
    	$this->modelMock
    		->shouldReceive('with')
    		->andReturnSelf()

    		->shouldReceive('get')
    		->with(['*'])
    		->andReturn(true);

    	$this->assertTrue($this->repositoryFake->all());
    }

    public function testAllWithOthersColumns()
    {
    	$this->modelMock
    		->shouldReceive('with')
    		->andReturnSelf()

    		->shouldReceive('get')
    		->with(['name'])
    		->andReturn(true);

    	$this->assertTrue($this->repositoryFake->all(['name']));
    }

    public function testFindById()
    {
    	$this->modelMock
    		->shouldReceive('find')
    		->with(Mockery::any(), ['*'])
    		->andReturn(true);

    	$this->assertTrue($this->repositoryFake->findById(1));
    }

    public function testCreate()
    {
    	$this->modelMock
    		->shouldReceive('create')
    		->andReturn(true);

    	$this->assertTrue($this->repositoryFake->create(['name' => 'Name']));
    }

    public function testUpdate()
    {
    	$this->modelMock
    		->shouldReceive('find')
    		->andReturnSelf()

    		->shouldReceive('fill')
    		->andReturnSelf()

    		->shouldReceive('save')
    		->andReturn(true);

    	$this->assertEquals(
    		'Berhasil update data', 
    		$this->repositoryFake->update(1, ['name' => 'Name'])
		);
    }

    public function testUpdateFail()
    {
    	$this->modelMock
    		->shouldReceive('find')
    		->andReturnSelf()

    		->shouldReceive('fill')
    		->andReturnSelf()

    		->shouldReceive('save')
    		->andReturn(false);

    	$this->assertEquals(
    		'Tidak berhasil update data', 
    		$this->repositoryFake->update(1, ['name' => 'Name'])
		);
    }

    public function testDelete()
    {
    	$this->modelMock
    		->shouldReceive('find')
    		->andReturnSelf()

    		->shouldReceive('delete')
    		->andReturn(true);

    	$this->assertEquals(
    		'Berhasil Hapus data',
    		$this->repositoryFake->delete(1)
		);
    }

    public function testDeleteFail()
    {
    	$this->modelMock
    		->shouldReceive('find')
    		->andReturn(null);

    	$this->assertEquals(
    		'Gagal Hapus data',
    		$this->repositoryFake->delete(1)
		);
    }
}
