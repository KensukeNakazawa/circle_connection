<?php

namespace App\Services\User;

use Illuminate\Support\Facades\Log;

use App\Services\Service;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserSettingRepositoryInterface;


/**
 * Class UserSettingService
 * @package App\Services\User
 */
class UserSettingService extends Service
{
    protected $userRepository;
    protected $userSettingRepository;

    /**
     * UserSettingService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserSettingRepositoryInterface $userSettingRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserSettingRepositoryInterface $userSettingRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userSettingRepository = $userSettingRepository;
    }

    /**
     * id に合致するユーザーの設定を取得する
     *
     */
    public function getUserSetting(int $user_id)
    {

        $user_setting = $this->userSettingRepository->findByUserId($user_id);

        return $user_setting;
    }

    /**
     * id に合致するユーザーの設定を変更する
     * @param string|null $user_name
     * @param int $user_setting_id
     * @param string|null $grade
     * @param string|null $faculty
     * @param string|null $hometown
     * @param int|null $gender_id
     * @param string|null $introduce
     * @return mixed
     */
    public function updateUserSetting(
        string $user_name=null,int $user_setting_id, string $grade=null, string $faculty=null, string $hometown=null, int $gender_id=null, string $introduce=null
    ) {

        $user_setting = $this->userSettingRepository->update(
            $user_setting_id, $grade, $faculty, $hometown, $gender_id, $introduce
        );

        $user_id = $user_setting->user_id;
        $this->userRepository->changeUserName($user_id, $user_name);

        return $user_setting;
    }
}
