<?php
namespace App\Repositories\User;

interface UserSettingRepositoryInterface
{
  public function create(int $user_id);
  public function findByUserId(int $user_id);

    /**
     * @param int $user_setting_id
     * @param string|null $grade
     * @param string|null $faculty
     * @param string|null $hometown
     * @param int|null $gender_id
     * @param string|null $introduce
     * @return mixed
     */
  public function update(int $user_setting_id, string $grade=null, string $faculty=null, string $hometown=null, int $gender_id=null, string $introduce=null);
}
