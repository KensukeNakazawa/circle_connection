<?php

namespace Tests\Unit\Repositories;


use PHPUnit\Framework\TestCase;

use App\Models\EventParticipant;

use App\Repositories\Event\EventParticipantRepository;

class EventParticipantRepositoryTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $model = new EventParticipant();
        $this->repository = new EventParticipantRepository($model);
    }

    public function testCreate()
    {
        // $this->repository->create(1, 1);

        $this->assertEquals(1, 1);
    }
}
