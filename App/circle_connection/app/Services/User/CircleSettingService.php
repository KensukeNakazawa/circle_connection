<?php

namespace App\Services\User;

use App\Services\Service;

use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\User\CircleSettingRepositoryInterface;

/**
 * サークルの設定を実際に触るサービスクラス
 *
 */
class CircleSettingService extends Service
{
    protected $userRepository;
    protected $circleSettingRepository;

    public function __construct(
        UserRepositoryInterface  $userRepository,
        CircleSettingRepositoryInterface $circleSettingRepository
    ) {
        $this->userRepository = $userRepository;
        $this->circleSettingRepository = $circleSettingRepository;
    }

    /**
     * サークルの設定を取得する
     */
    public function getSetting(int $user_id)
    {
        $circle_setting = $this->circleSettingRepository->findByUserId($user_id);
        $scales = \App\Models\Scale::all();
        $circle_categories = \App\Models\CircleCategory::all();

        $result = [
            'circle_setting' => $circle_setting,
            'circle_categories' => $circle_categories,
            'scales' => $scales
        ];

        return $result;
    }

    /**
     * サークルの設定を更新する
     * @param string|null $circle_name
     * @param int $circle_setting_id
     * @param int|null $category_id
     * @param int|null $scale_id
     * @param string|null $introduce
     * @param string|null $content
     * @param string|null $place
     * @return mixed
     */
    public function updateSetting(string $circle_name=null, int $circle_setting_id, int $category_id=null, int $scale_id=null, string $introduce=null, string $content=null, string $place=null)
    {
        $circle_setting = $this->circleSettingRepository->update(
            $circle_setting_id, $category_id, $scale_id, $introduce, $content, $place
        );

        $user_id = $circle_setting->user_id;
        $this->userRepository->changeUserName($user_id, $circle_name);

        return $circle_setting;
    }
}
