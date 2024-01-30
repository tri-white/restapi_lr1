<?php

/**
 * @OA\Schema(
 *     schema="Competition",
 *     title="Competition",
 *     required={"name", "event_date", "event_location", "prize_pool", "sports_type"},
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Summer Games 2024",
 *         description="Name of the competition"
 *     ),
 *     @OA\Property(
 *         property="event_date",
 *         type="string",
 *         format="date-time",
 *         example="2024-08-15T10:00:00Z",
 *         description="Date and time of the competition event"
 *     ),
 *     @OA\Property(
 *         property="event_location",
 *         type="string",
 *         example="Olympic Stadium, Los Angeles",
 *         description="Location of the competition event"
 *     ),
 *     @OA\Property(
 *         property="prize_pool",
 *         type="integer",
 *         example=10000,
 *         description="Prize pool amount (optional)"
 *     ),
 *     @OA\Property(
 *         property="sports_type",
 *         type="string",
 *         enum={"100m sprint", "3km run", "spear throwing", "football", "tennis"},
 *         example="football",
 *         description="Type of sports for the competition"
 *     )
 * )
 */

