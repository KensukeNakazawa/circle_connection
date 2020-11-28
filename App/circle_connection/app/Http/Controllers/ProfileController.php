<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
/** Service */
use App\Services\User\UserService;
/** Presenter */
use App\Presenters\ProfilePresenter;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    protected $profilePresenter;
    protected $userService;
    /**
     * @var string
     */
    private $guard;

    /**
     * ProfileController constructor.
     * @param ProfilePresenter $profilePresenter
     * @param UserService $userService
     */
    public function __construct(
        ProfilePresenter $profilePresenter,
        UserService $userService
    ) {
        $this->profilePresenter = $profilePresenter;
        $this->userService = $userService;
        /** 認証 */
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->guard = "api";
    }

    /**
     * @return array
     */
    public function index()
    {
        /** @var int $user_type_id */
        $user_type_id = auth($this->guard)->user()->user_type_id;

        $users = $this->userService->selectAll($user_type_id);

        return $this->profilePresenter->setProfileUsers($users);
    }

    public function show($user_id)
    {
        $user = $this->userService->getUser($user_id);

        return $this->profilePresenter->setProfileShow($user);
    }

}
