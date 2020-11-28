<?php

namespace App\Presenters;

class UserPresenter extends Presenter
{
    public function setUserSetting($user_setting, $genders)
    {
        $view_data = [
            'id' => $user_setting->id,
            'grade' => $user_setting->grade,
            'faculty' => $user_setting->faculty,
            'hometown' => $user_setting->hometown,
            'gender_id' => $user_setting->gender_id,
            'gender' => $user_setting->gender->name,
            'introduce' => $user_setting->introduce,
            'genders' => $genders
        ];

        return $view_data;
    }

    public function setCircleSetting($data)
    {
        $circle_setting = $data['circle_setting'];
        $view_data = [
            'id' => $circle_setting->id,
            'circle_category_id' => $circle_setting->circle_category_id,
            'scale_id' => $circle_setting->scale_id,
            'introduce' => $circle_setting->introduce,
            'content' => $circle_setting->content,
            'place' => $circle_setting->place,
            'circle_categories' => $data['circle_categories'],
            'scales' => $data['scales']
        ];

        return $view_data;
    }
}
