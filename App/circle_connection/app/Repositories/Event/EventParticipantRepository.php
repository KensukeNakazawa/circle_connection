<?php
namespace App\Repositories\Event;

use Illuminate\Support\Facades\DB;

use App\Models\EventParticipant;

/**
 * Class EventParticipantRepository
 * @package App\Repositories\Event
 */
class EventParticipantRepository implements EventParticipantRepositoryInterface
{
    protected $model;

    public function __construct(EventParticipant $model)
    {
        $this->model = $model;
    }

    /**
     * Idに合致するEventParticipantを取得する
     *
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->model->find($id)->get();
    }


    /**
     * @param int $event_id
     * @param int $user_id
     *
     * @return mixed
     */
    public function create(int $event_id, int $user_id)
    {
        $event_participant = $this->model->create([
            'event_id' => $event_id,
            'user_id' => $user_id
        ]);

        return $event_participant;
    }


    /**
     * @param int $event_id
     * @return mixed
     */
    public function getParticipantsByEventId(int $event_id)
    {
        $participant_ids = $this->model->where('event_id', $event_id)->pluck('user_id');

        return $participant_ids->toArray();
    }
}
