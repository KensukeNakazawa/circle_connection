<?php

namespace Tests\Unit\Repositories;

/** third party */
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/** mine */
use App\Models\User;
use App\Repositories\User\UserRepository;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');
        factory(User::class, 10)->create(['user_type_id' => 1]);
        factory(User::class, 10)->create(['user_type_id' => 2]);
        $model = new User();
        $this->repository = new UserRepository($model);

    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCreateUser()
    {

        $result = $this->repository->create('test', 'testmail@gmail.com', 'test1234', 1);
        $this->assertEquals('test', $result->name);
        $this->assertEquals('testmail@gmail.com', $result->email);
        $this->assertEquals(1, $result->user_type_id);

        $result = $this->repository->create('test2', 'test2mail@gmail.com', 'test1234', 2);
        $this->assertEquals('test2', $result->name);
        $this->assertEquals('test2mail@gmail.com', $result->email);
        $this->assertEquals(2, $result->user_type_id);
    }

    public function testGetUser()
    {
        $users = User::all();
        $user = $users->first();
        $result = $this->repository->findById($user->id);
        if (!is_null($result)) {
            $this->assertEquals($user, $result);
        }
    }

    public function testSelectAllWithType()
    {
        $users = $this->repository->selectAllWithType(1);
        foreach ($users as $user) {
            $this->assertEquals(1, $user->user_type_id);
        }

        $circles = $this->repository->selectAllWithType(2);
        foreach ($circles as $circle) {
            $this->assertEquals(2, $circle->user_type_id);
        }
    }


}
