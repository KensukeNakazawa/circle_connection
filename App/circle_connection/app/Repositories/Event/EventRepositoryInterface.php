<?php
namespace App\Repositories\Event;

/**
 * Interface EventRepositoryInterface
 * @package App\Repositories\Event
 */
interface EventRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getAllAvailable();

    /**
     * @param int $id
     * @return mixed
     */
    public function findById(int $id);

    /**
     * @param int $circle_id
     * @return mixed
     */
    public function findByUserId(int $circle_id);

    /**
     * @param int $circle_id
     * @param string $title
     * @param string $content
     * @param string $meeting_place
     * @param string $place
     * @param 　 $start_time
     * @param $end_time
     * @param int $number_of_persons
     * @param int $fee
     * @return mixed
     */
    public function create(int $circle_id, string $title, string $content, string $meeting_place, string $place,　$start_time, $end_time, int $number_of_persons, int $fee);


}
