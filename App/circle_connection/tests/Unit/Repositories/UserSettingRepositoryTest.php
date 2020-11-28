<?php

namespace Tests\Unit\Repositories;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Repositories\User\UserSettingRepository;

class UserSettingRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected $repository;

    public function setUp(): void
    {
        parent::setUp();
//        factory(User::class, 10)->create(['user_type_id' => 1]);
        factory(UserSetting::class, 10)->create();
        $model = new UserSetting();
        $this->repository = new UserSettingRepository($model);
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function testCreate()
    {
        $user_setting = $this->repository->create(1);
        $this->assertEquals(1, $user_setting->user_id);
    }

    public function testFindByUserId()
    {
        $user_settings = UserSetting::all();
        $user_setting = $user_settings->first();

        $result = $this->repository->findByUserId($user_setting->user_id);
        $this->assertEquals($user_setting->user_id, $result->user_id);
    }
}
