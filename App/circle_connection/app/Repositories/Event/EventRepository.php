<?php
namespace App\Repositories\Event;

use Illuminate\Support\Facades\DB;

use App\Models\Event;

/**
 * Class EventRepository
 * @package App\Repositories\Event
 */
class EventRepository implements EventRepositoryInterface
{
    protected $model;

    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    /**
     * 開始時間が現在時刻より後のイベントを全て取得する
     *
     */
    public function getAllAvailable()
    {
        $now_time = date("Y-m-d H:i:s");
        return $this->model->where('start_time', '>', $now_time)->get();
    }

    /**
     * id合致するイベントを取得する
     * @param int $id
     * @return mixed
     */
    public function findById(int $id)
    {
        return $this->model->find($id);
    }

    /**
     * @param int $circle_id
     * @return mixed
     */
    public function findByUserId(int $circle_id)
    {
        return $this->model->where('circle_id', $circle_id)->get();
    }

    /**
     * イベントを作成する
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
    public function create(
        int $circle_id, string $title, string $content, string $meeting_place,
        string $place, $start_time, $end_time, int $number_of_persons, int $fee
    ) {
        return $this->model->create([
            'circle_id' => $circle_id,
            'title' => $title,
            'content' => $content,
            'meeting_place' => $meeting_place,
            'place' => $place,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'number_of_persons' => $number_of_persons,
            'fee' => $fee
        ]);
    }



}
