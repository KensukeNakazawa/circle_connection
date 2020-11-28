<?php
namespace App\Repositories\Event;

/**
 * Interface EventParticipantRepositoryInterface
 * @package App\Repositories\Event
 */
interface EventParticipantRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param int $event_id
     * @param int $user_id
     * @return mixed
     */
    public function create(int $event_id, int $user_id);

    /**
     * @param int $event_id
     * @return mixed
     */
    public function getParticipantsByEventId(int $event_id);
}
