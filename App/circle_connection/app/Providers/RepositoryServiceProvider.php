<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // ユーザー関連のリポジトリ
        $this->app->bind(\App\Repositories\User\UserRepositoryInterface::class, \App\Repositories\User\UserRepository::class);
        $this->app->bind(\App\Repositories\User\UserSettingRepositoryInterface::class, \App\Repositories\User\UserSettingRepository::class);
        $this->app->bind(\App\Repositories\User\CircleSettingRepositoryInterface::class, \App\Repositories\User\CircleSettingRepository::class);

        // // イベント関連のリポジトリ
        $this->app->bind(\App\Repositories\Event\EventRepositoryInterface::class, \App\Repositories\Event\EventRepository::class);
        $this->app->bind(\App\Repositories\Event\EventParticipantRepositoryInterface::class, \App\Repositories\Event\EventParticipantRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
