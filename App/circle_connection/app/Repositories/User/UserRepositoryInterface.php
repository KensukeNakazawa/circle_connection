<?php
namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param int $user_type_id
     * @return mixed
     */
    public function create(string $name, string $email, string $password, int $user_type_id);

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param int $user_type_id
     * @return mixed
     */
    public function selectAllWithType(int $user_type_id);

    /**
     * @param int $user_id
     * @param string $name
     * @return mixed
     */
    public function changeUserName(int $user_id, string $name);
    /**
     * @param string $twitter_id
     * @param string $instagram_id
     * @return mixed
     */
    public function updateSnsSetting(int $user_id, string $twitter_id=null, string $instagram_id=null);

    /**
     * @param int $user_id
     * @param string $path
     * @return mixed
     */
    public function updateProfilePicture(int $user_id, string $path);

    public function getBySearchItem(int $searched_user_type_id, string $name=null, int $circle_category_id=null, int $scale_id=null);

}
