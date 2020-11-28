<?php

namespace App\Services\Common;

use Illuminate\Support\Facades\Log;

use App\Services\Service;

use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Event\EventParticipantRepositoryInterface;

use App\Services\User\UserService;

/**
 * Class EventService
 * @package App\Services\Common
 */
class EventService extends Service
{
    protected $eventRepository;
    protected $eventParticipantRepository;
    protected $userService;

    /**
     * EventService constructor.
     * @param EventRepositoryInterface $eventRepository
     * @param EventParticipantRepositoryInterface $eventParticipantRepository
     * @param UserService $userService
     */
    public function __construct(
        EventRepositoryInterface $eventRepository,
        EventParticipantRepositoryInterface $eventParticipantRepository,
        UserService $userService
    )
    {
        $this->eventRepository = $eventRepository;
        $this->eventParticipantRepository = $eventParticipantRepository;
        $this->userService = $userService;
    }

    /**
     * 現在時刻より予定時間が遅いイベントを取得する
     */
    public function getAvailableEvent()
    {
        $events = $this->eventRepository->getAllAvailable();

        return $events;
    }

    /**
     * @param int $event_id
     * @return mixed
     */
    public function getEvent(int $event_id)
    {
        $event = $this->eventRepository->findById($event_id);
        $participated_users = $event->participated_users;

        $result = [
            'event' => $event,
            'participated_users' => $participated_users
        ];
        return $result;
    }

    public function getEventParticipant(int $event_id)
    {
        /** TODO: このイベントに参加しているユーザーを */
    }

    /**
     * 新しいイベントを作成する
     *
     * @param int $circle_id
     * @param string $title
     * @param string $content
     * @param string $meeting_place
     * @param string $place
     * @param $start_time
     * @param $end_time
     * @param int $number_of_persons
     * @param int $fee
     *
     */
    public function createEvent(
        int $circle_id, string $title, string $content, string $meeting_place,
        string $place, $start_time, $end_time, int $number_of_persons, int $fee
    )
    {

        $event = $this->eventRepository->create(
            $circle_id, $title, $content, $meeting_place, $place, $start_time,
            $end_time, $number_of_persons, $fee
        );

        return $event;
    }


    /**
     * イベント参加者を追加する
     *
     * @param int $event_id
     * @param int $user_id
     * @return mixed
     */
    public function addParticipant(int $event_id, int $user_id)
    {
        $event_participant_ids = $this->eventParticipantRepository->getParticipantsByEventId($event_id);

        /** 既にこのイベントに参加済みかを確認する */
        if (in_array($user_id, $event_participant_ids, true)) {
            $result = [
                'result' => false,
                'message' => 'すでに参加しています'
            ];
        } else {
            $event_participant = $this->eventParticipantRepository->create($event_id, $user_id);

            $result = [
                'result' => true,
                'message' => '参加しました',
                'event_participant' => $event_participant
            ];
        }


        return $result;
    }

    /**
     * @param int $circle_id
     * @return mixed
     */
    public function getCircleEvent(int $circle_id)
    {
        $events = $this->eventRepository->findByUserId($circle_id);

        return $events;
    }

    /**
     * @param int $user_id
     * @return mixed
     */
    public function getParticipateEvent(int $user_id)
    {
        $user = $this->userService->getUser($user_id);

        $events = $user->events;

        return $events;
    }
}
