<?php

namespace App\Services\Common;

/** Service */
use App\Services\Service;
/** Repository */
use App\Repositories\User\UserRepositoryInterface;

/**
 * Class SearchService
 * @package App\Services\Common
 */
class SearchService extends Service
{

    protected $userRepository;

    protected $USER_TYPE_USER;

    /**
     * SearchService constructor.
     * @param $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->USER_TYPE_USER = config('constants.USER_TYPE_USER');
    }

    /**
     * @param int $user_type_id ログインユーザーのユーザータイプID
     * @param string|null $circle_name
     * @param int|null $circle_category_id
     * @param int|null $scale_id
     * @return mixed
     */
    public function searchProfile(
        int $user_type_id, string $name=null, int $circle_category_id=null, int $scale_id=null
    ) {
        $users = $this->userRepository->getBySearchItem(
            $user_type_id, $name, $circle_category_id, $scale_id
        );

        return $users;
    }

}
