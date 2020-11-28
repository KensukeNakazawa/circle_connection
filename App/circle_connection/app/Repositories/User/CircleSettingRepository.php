<?php
namespace App\Repositories\User;

use App\Models\CircleSetting;

class CircleSettingRepository implements CircleSettingRepositoryInterface
{
    protected $model;

    public function __construct(CircleSetting $model)
    {
        $this->model = $model;
    }

    public function create(int $user_id)
    {
        return $this->model->create(['user_id' => $user_id]);
    }

    /**
     * Idに合致するEventParticipantを取得する
     *
     * @param int $id
     * @return collection
     */
    public function findByUserId(int $user_id)
    {
        return $this->model->where('user_id', $user_id)->get()->first();;
    }

    /**
     * @param int $circle_setting_id
     * @param int|null $category_id
     * @param int|null $scale_id
     * @param string|null $introduce
     * @param string|null $content
     * @param string|null $place
     * @return mixed
     */
    public function update(int $circle_setting_id, int $category_id=null, int $scale_id=null, string $introduce=null, string $content=null, string $place=null)
    {
        $setting = $this->model->find($circle_setting_id);
        $setting->update([
            'category_id' => $category_id,
            'scale_id' => $scale_id,
            'introduce' => $introduce,
            'content' => $content,
            'place' => $place
        ]);

        return $setting;
    }
}
