<?php
namespace App\Repositories\User;

use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * User を作成する
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param int $user_type_id
     *
     * @return mixed
     */
    public function create(string $name, string $email, string $password, int $user_type_id)
    {
        return $this->model->newQuery()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'user_type_id' => $user_type_id
        ]);
    }

    /**
     * Idに合致するUserを取得する
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->model->newQuery()->find($id);
    }

    /**
     * 指定ユーザータイプのユーザーを取得する
     * @param int $user_type_id
     * @return mixed
     */
    public function selectAllWithType(int $user_type_id)
    {
        return $this->model->newQuery()->where('user_type_id', $user_type_id)
            ->select('id', 'name', 'user_type_id', 'picture_url', 'twitter_id', 'instagram_id')
            ->get();
    }

    /**
     * @param int $user_id
     * @param string $name
     * @return mixed
     */
    public function changeUserName(int $user_id, string $name)
    {
        $user = $this->model->newQuery()->find($user_id);
        return $user->update(['name' => $name]);
    }

    /**
     * @param int $user_id
     * @param string $twitter_id
     * @param string $instagram_id
     * @return bool|mixed
     */
    public function updateSnsSetting(int $user_id, string $twitter_id=null, string $instagram_id=null)
    {
        $user = $this->model->newQuery()->find($user_id);

        $result = $user->update([
            'twitter_id' => $twitter_id,
            'instagram_id' => $instagram_id
        ]);

        return $result;
    }

    /**
     * プロフィール画像を変更する
     * @param int $user_id
     * @param string $path
     * @return mixed|void
     */
    public function updateProfilePicture(int $user_id, string $path)
    {
        $user = $this->model->newQuery()->find($user_id);

        $result = $user->update(['picture_url' => $path]);

        return $result;
    }

    /**
     * @param int $searched_user_type_id 検索したユーザー
     * @param string|null $name
     * @param int|null $circle_category_id
     * @param int|null $scale_id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getBySearchItem(int $searched_user_type_id, string $name=null, int $circle_category_id=null, int $scale_id=null)
    {
        $user_type_user = config('constants.USER_TYPE_USER');
        $user_type_circle = config('constants.USER_TYPE_CIRCLE');

        $users = $this->model->newQuery();

        if ($name) {
            $users = $users->where('name', 'LIKE', "%$name%");
        }

        if ($searched_user_type_id === $user_type_circle) {
            $users = $users->where('user_type_id', $user_type_user)
                ->join('circle_settings', 'users.id', '=', 'circle_settings.user_id');

            if ($circle_category_id) {
                $users = $users->where('circle_category_id', $circle_category_id);
            }

            if ($scale_id) {
                $users = $users->where('scale_id', $scale_id);
            }
        } elseif ($searched_user_type_id === $user_type_user) {
            $users = $users->where('user_type_id', $user_type_circle);
            if ($name) {
                $users = $users->where('name', 'LIKE', "%$name%");
            }
        }

        $users = $users->get();
        return $users;
    }
}
