<?php

namespace App\Presenters;

/**
 * Class EventPresenter
 * @package App\Presenters
 */
class EventPresenter extends Presenter
{

    /**
     * イベント一覧に表示するため
     * @param $events
     * @return array
     */
    public function setEventIndex($events)
    {
        $view_events = [];

        if (!is_null($events)) {
            foreach ($events as $event) {
                $circle = $event->circle;
                $view_events[] = [
                    'id' => $event->id,
                    'circle_name' => $circle->name,
                    'picture_url' => $circle->picture_url,
                    'title' => $event->title,
                    'content' => $event->content,
                    'place' => $event->place,
                    'start_time' => self::formatDateMDHM($event->start_time),
                ];
            }
        }

        return $view_events;
    }

    /**
     * イベント詳細ページに表示させるデータ
     * @param $event
     * @return array
     */
    public function setEventShow($data)
    {
        $event = $data['event'];
        $circle = $event->circle;
        $participated_users = $data['participated_users'];

        $view_participated_users = [];
        foreach ($participated_users as $user) {
            $view_participated_users[] = [
                'id' => $user->id,
                'name' => $user->name,
                'grade' => $user->grade,
                'picture_url' => $user->picture_url
            ];
        }

        $view_event = [
            'event_id' => $event->id,
            'circle_name' => $circle->name,
            'circle_picture_url' => $circle->picture_url,
            'title' => $event->title,
            'content' => $event->content,
            'meeting_place' => $event->meeting_place,
            'start_time' => self::formatDateMDHM($event->start_time),
            'end_time' => self::formatDateMDHM($event->end_time),
            'number_of_persons' => $event->number_of_persons,
            'fee' => $event->fee,
            'picture_url' => $event->picture_url,
            'users' => $view_participated_users,
        ];

        return $view_event;
    }

}
