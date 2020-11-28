<?php
namespace App\Repositories\User;

interface CircleSettingRepositoryInterface
{
    public function create(int $user_id);
    public function findByUserId(int $id);

    /**
     * @param int $circle_setting_id
     * @param int|null $category_id
     * @param int|null $scale_id
     * @param string|null $introduce
     * @param string|null $content
     * @param string|null $place
     * @return mixed
     */
    public function update(int $circle_setting_id, int $category_id=null, int $scale_id=null, string $introduce=null, string $content=null, string $place=null);
}
