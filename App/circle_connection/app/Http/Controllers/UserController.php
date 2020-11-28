<?php

namespace App\Http\Controllers;

// third party
use Illuminate\Http\Request;

// FormRequests
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserSettingRequest;
use App\Http\Requests\User\CircleSettingRequest;
use App\Http\Requests\User\SnsRequest;

// Services
use App\Services\User\UserService;
use App\Services\User\UserSettingService;
use App\Services\User\CircleSettingService;

/** Presenter */
use App\Presenters\UserPresenter;

class UserController extends Controller
{
    protected $userService;
    protected $userSettingService;
    protected $circleSettingService;
    protected $userPresenter;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param UserSettingService $userSettingService
     * @param CircleSettingService $circleSettingService
     */
    public function __construct(
        UserService $userService,
        UserSettingService $userSettingService,
        CircleSettingService $circleSettingService,
        UserPresenter $userPresenter
    ) {
        $this->userService = $userService;
        $this->userSettingService = $userSettingService;
        $this->circleSettingService = $circleSettingService;
        $this->userPresenter = $userPresenter;

        /** 認証 */
        $this->guard = "api";
    }

    /**
     * ユーザーを新規登録する
     *
     * @param UserRequest $request
     * @return mixed
     */
    public function create(UserRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $user_type_id = $request->user_type;

        $result = $this->userService->registerUser($name, $email, $password, $user_type_id);

        $credentials = request(['email', 'password']);

        if (! $token = auth($this->guard)->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        /** 二箇所に */
        return $this->respondWithToken($token);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function uploadProfilePicture(Request  $request)
    {
        $user_id = auth()->user()->id;
        $picture = $request->file('picture');

        $result = $this->userService->updateProfilePicture($user_id, $picture);

        return $result;
    }

    /**
     * ユーザーの設定を編集するために、現状のユーザー設定を取得する
     *
     * @param int $user_id
     */
    public function editUserSetting($user_id)
    {
        $user_id = (int) $user_id;

        $user_setting = $this->userSettingService->getUserSetting($user_id);

        $genders = \App\Models\Gender::all();
        /**  */
        return $this->userPresenter->setUserSetting($user_setting, $genders);
    }

    /**
     * ユーザーの設定を更新する
     *
     * @param UserSettingRequest $request
     * @return mixed
     */
    public function updateUserSetting(UserSettingRequest $request)
    {
        $user_name = $request->name;
        $user_setting_id = $request->id;
        $grade = $request->grade;
        $faculty = $request->faculty;
        $hometown = $request->hometown;
        $gender_id = $request->gender_id;
        $introduce = $request->introduce;

        $user_setting = $this->userSettingService
            ->updateUserSetting(
                $user_name, $user_setting_id, $grade, $faculty, $hometown, $gender_id, $introduce
            );

        return $user_setting;
    }

    /**
     * ユーザーの設定を編集するために、現状のユーザー設定を取得する
     *
     * @param int $user_id
     */
    public function editCircleSetting($user_id)
    {
        $user_id = (int) $user_id;

        $result = $this->circleSettingService->getSetting($user_id);

        return $this->userPresenter->setCircleSetting($result);
    }

    /**
     * サークルの設定を更新する
     * @param CircleSettingRequest $request
     * @return mixed
     */
    public function updateCircleSetting(CircleSettingRequest $request)
    {
        $circle_name = $request->name;
        $circle_setting_id = $request->id;
        $category_id= (int) $request->circle_category_id;
        $scale_id = (int) $request->scale_id;
        $introduce = $request->introduce;
        $content = $request->content;
        $place = $request->place;

        $user_setting = $this->circleSettingService
            ->updateSetting(
                $circle_name, $circle_setting_id, $category_id, $scale_id, $introduce, $content, $place
            );

        return $user_setting;
    }

    /**
     *
     * SNSの情報を設定する
     *
     * @param SnsRequest $request
     * @param int $user_id
     * @return \Illuminate\Http\JsonResponse|string
     */
    public function updateSnsSetting(SnsRequest $request, int $user_id)
    {
        $login_user_id = auth()->user()->id;

        //ログインユーザーが変更対象のユーザーと一緒かどうかを見る
        if ($login_user_id != $user_id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $twitter_id = $request->twitter_id;
        $instagram_id = $request->instagram_id;

        $message = $this->userService->updateSnsSetting($user_id, $twitter_id, $instagram_id);

        return $message;
    }


}
