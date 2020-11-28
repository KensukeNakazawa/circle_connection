<?php
namespace App\Repositories\User;

use App\Models\UserSetting;

class UserSettingRepository implements UserSettingRepositoryInterface
{
    protected $model;

    public function __construct(UserSetting $model)
    {
        $this->model = $model;
    }

    /**
     * ユーザー設定を作成する
     *
     * @param int $user_id
     *
     * @return collection
     */
    public function create(int $user_id)
    {
        return $this->model->create([
            'user_id' => $user_id
        ]);
    }

    /**
     * Idに合致するEventParticipantを取得する
     *
     * @param int $user_id
     * @return collection
     */
    public function findByUserId(int $user_id)
    {
        return $this->model->where('user_id', $user_id)
            ->get()->first();
    }

    /**
     * @param int $user_setting_id
     * @param string|null $grade
     * @param string|null $faculty
     * @param string|null $hometown
     * @param int|null $gender_id
     * @param string|null $introduce
     * @return mixed
     */
    public function update(int $user_setting_id, string $grade=null, string $faculty=null, string $hometown=null, int $gender_id=null, string $introduce=null)
    {
        $user_setting = $this->model->find($user_setting_id);
        $user_setting->update([
            'grade' => $grade,
            'faculty' => $faculty,
            'hometown' => $hometown,
            'gender_id' => $gender_id,
            'introduce' => $introduce
        ]);

        return $user_setting;
    }
}
