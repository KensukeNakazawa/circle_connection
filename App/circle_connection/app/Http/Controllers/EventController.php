<?php

namespace App\Http\Controllers;

/** FormRequests */
use App\Http\Requests\Event\EventRequest;
use App\Http\Requests\Event\EventParticipantRequest;
/** Presenters */
use App\Presenters\EventPresenter;
/** Services */
use App\Services\Common\EventService;

/**
 * Class EventController
 * @package App\Http\Controllers
 */
class EventController extends Controller
{
    protected $eventPresenter;
    protected $eventService;

    /**
     * EventController constructor.
     * @param EventPresenter $eventPresenter
     * @param EventService $eventService
     */
    public function __construct(
        EventPresenter $eventPresenter,
        EventService $eventService
    ) {
        $this->eventPresenter = $eventPresenter;
        $this->eventService = $eventService;
    }


    public function index()
    {
        $events = $this->eventService->getAvailableEvent();

        return $this->eventPresenter->setEventIndex($events);
    }


    public function show($event_id)
    {
        $event_id = (int) $event_id;
        $result = $this->eventService->getEvent($event_id);

        return $this->eventPresenter->setEventShow($result);
    }

    /**
     * 新しいイベントを作りたいコントローラ
     * @param EventRequest $request
     * @return mixed
     */
    public function store(EventRequest $request)
    {
        $circle_id = $request->circle_id;
        $title = $request->title;
        $content = $request->content;
        $meeting_place = $request->meeting_place;
        $place = $request->place;
        $start_time = $request->start_time;
        $end_time = $request->end_time;
        $number_of_persons = $request->number_of_persons;
        $fee = $request->fee;

        $event = $this->eventService->createEvent(
            $circle_id, $title, $content, $meeting_place, $place,
            $start_time, $end_time, $number_of_persons, $fee
        );

        return $event;
    }

    /**
     * イベント参加者を追加する
     *
     * @param EventParticipantRequest $request
     * @return mixed
     */
    public function addParticipant(EventParticipantRequest $request)
    {

        $event_id = $request->event_id;
        $user_id = $request->user_id;

        $result = $this->eventService->addParticipant($event_id, $user_id);

        /** 失敗していたらエラーとして返す */
        if ($result['result']) {
            return $result;
        } else {
            /** TODO: status codeってこれでいいのか...？ */
            return response()->json(['errors' => ['message' => $result['message']]], 422);
        }
    }

    /**
     * ログインしているサークルのイベントを取得する
     *
     * @param int $user_id
     * @return mixed
     */
    public function getMyEvent(string $user_id)
    {
        $user_id = (int) $user_id;
        $events = $this->eventService->getCircleEvent($user_id);

        return $events;
    }

    /**
     * 参加しているイベントを取得する
     *
     * @param string $user_id
     * @return mixed
     */
    public function getParticipateEvent(string $user_id)
    {
        $user_id = (int) $user_id;
        $events = $this->eventService->getParticipateEvent($user_id);

        return $events;
    }
}
