<?php

namespace App\Jobs;

/**
 * Interface Queues
 * Contains ALL queues that used
 * @package App\Jobs
 */
abstract class Queues
{
    const INSPECT_QUEUE = 'inspect';
    const AUDIT_QUEUE = 'audit';
}
