<?php

namespace App\Presenters;

/**
 * Class ProfilePresenter
 * @package App\Presenters
 */
class ProfilePresenter extends Presenter
{

    /**
     * @param $users
     * @return array
     */
    public function setProfileUsers($users)
    {
        $view_users = [];


        if (!is_null($users) && $users->first()->isUser()) {
            foreach ($users as $user) {
                $setting = $user->setting;
                $view_users[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'user_type_id' => $user->user_type_id,
                    'picture_url' => $user->picture_url,
                    'twitter_id' => $user->twitter_id,
                    'instagram_id' => $user->instagram_id,
                    'grade' => $setting->grade,
                    'faculty' => $setting->faculty,
                    'hometown' => $setting->hometown,
                    'introduce' => $setting->introduce,
                    'gender' => $setting->gender->name,
                ];
            }
        } elseif (!is_null($users) && $users->first()->isCircle()) {
            foreach ($users as $user) {
                $setting = $user->setting;
                $view_users[] = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'user_type_id' => $user->user_type_id,
                    'picture_url' => $user->picture_url,
                    'twitter_id' => $user->twitter_id,
                    'instagram_id' => $user->instagram_id,
                    'circle_category' => $setting->circleCategory->name,
                    'scale' => $setting->scale->name,
                    'introduce' => $setting->introduce,
                    'content' => $setting->content,
                    'place' => $setting->place
                ];
            }
        }

        return $view_users;
    }

    /**
     *
     * @param $user
     * @return array
     */
    public function setProfileShow($user)
    {
        $setting = $user->setting;
        $events = $user->events;

        $view_events = [];
        $view_user = null;
        
        foreach ($events as $event) {
            $circle = $event->circle;
            $view_events[] = [
                'circle_name' => $circle->name,
                'picture_url' => $circle->picture_url,
                'title' => $event->title,
                'start_time' => $event->start_time
            ];
        }

        if ($user->isUser()) {
            $view_user = [
                'name' => $user->name,
                'user_type_id' => $user->user_type_id,
                'picture_url' => $user->picture_url,
                'twitter_id' => $user->twitter_id,
                'instagram_id' => $user->instagram_id,
                'grade' => $setting->grade,
                'faculty' => $setting->faculty,
                'hometown' => $setting->hometown,
                'introduce' => $setting->introduce,
                'gender' => $setting->gender->name,
                'events' => $view_events,
            ];
        } elseif ($user->isCircle()) {
            $view_user = [
                'name' => $user->name,
                'user_type_id' => $user->user_type_id,
                'picture_url' => $user->picture_url,
                'twitter_id' => $user->twitter_id,
                'instagram_id' => $user->instagram_id,
                'circle_category' => $setting->circleCategory->name,
                'scale' => $setting->scale->name,
                'introduce' => $setting->introduce,
                'content' => $setting->content,
                'place' => $setting->place,
            ];
        }

        return $view_user;
    }
}

