<?php

namespace App\Services\User;

/** third party */
use Illuminate\Support\Facades\DB;
/** my library */
/** Service */
use App\Services\Service;
use App\Services\Util\StorageService;
/** Repository */
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\UserSettingRepositoryInterface;
use App\Repositories\User\CircleSettingRepositoryInterface;

/**
 * Class UserService
 * @package App\Services\User
 */
class UserService extends Service
{
    const USER_TYPE_USER = 1;//config('constants.USER_TYPE_USER');
    const USER_TYPE_CIRCLE = 2;//config('constants.USER_TYPE_CIRCLE');
    const USER_TYPE_ADMIN = 3;//config('constants.USER_TYPE_ADMIN');

    private $userRepository;
    private $userSettingRepository;
    private $circleSettingRepository;
    private $storageService;

    /**
     * UserService constructor.
     * @param $userRepository
     * @param $userSettingRepository
     * @param $circleSettingRepository
     * @param $storageService
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserSettingRepositoryInterface $userSettingRepository,
        CircleSettingRepositoryInterface $circleSettingRepository,
        StorageService $storageService
    ) {
        $this->userRepository = $userRepository;
        $this->userSettingRepository = $userSettingRepository;
        $this->circleSettingRepository = $circleSettingRepository;
        $this->storageService = $storageService;
    }

    /**
     * ユーザーを取得する
     * @param int $user_id
     * @return mixed
     */
    public function getUser(int $user_id)
    {
        return $this->userRepository->findById($user_id);
    }

    /**
     * ユーザー登録を行う
     * ユーザー登録時は設定も一緒に作る
     *
     * @param string name
     * @param string email
     * @param string password
     * @param int $user_type_id
     *
     * @return mixed
     */
    public function registerUser(string $name, string $email, string $password, int $user_type_id)
    {
        $user = DB::transaction(function () use ($name, $email, $password, $user_type_id) {
            try {
                $user = $this->userRepository->create($name, $email, $password, $user_type_id);
                if ($user->isUser()) {
                    $this->userSettingRepository->create($user->id);
                } elseif ($user->isCircle()) {
                    $this->circleSettingRepository->create($user->id);
                }

                return $user;
            } catch (\Exception $error) {
                throw $error;
            }
        });

        return $user;
    }

    /**
     *
     * @param int $user_id
     * @param $picture
     * @return mixed
     */
    public function updateProfilePicture(int $user_id, $picture)
    {
        $file_path = 'public/profile_picture';
        $file_name = "profile_${user_id}";

        $path = $this->storageService->setPicture($picture, $file_path, $file_name);
        $result = $this->userRepository->updateProfilePicture($user_id, $path);

        $message = '';
        if ($result) {
            $message = 'OK';
        } else {
            $message = 'NG';
        }
        return $message;
    }

    /**
     * ユーザータイプに則したユーザーを取得する
     *
     * @param int $user_type_id
     * @return mixed
     */
    public function selectAll(int $user_type_id)
    {
        /** ユーザーであればサークル、サークルであればユーザーをターゲットにする */
        if ($user_type_id === self::USER_TYPE_USER) {
            $target_uer_type_id = self::USER_TYPE_CIRCLE;
        } elseif ($user_type_id === self::USER_TYPE_CIRCLE) {
            $target_uer_type_id = self::USER_TYPE_USER;
        } else {
            $target_uer_type_id = 1;
        }

        $users = $this->userRepository->selectAllWithType($target_uer_type_id);

        return $users;
    }

    /**
     * @param int $user_id
     * @param string $twitter_id
     * @param string $instagram_id
     * @return string
     */
    public function updateSnsSetting(int $user_id, string $twitter_id=null, string $instagram_id=null)
    {
        $result = $this->userRepository->updateSnsSetting($user_id, $twitter_id, $instagram_id);

        if ($result) {
            $message = '更新出来ました。';
        } else {
            $message = '更新に失敗しました。';
        }

        return $message;
    }


}
