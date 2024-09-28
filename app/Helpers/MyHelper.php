<?php

function today_date()
{
  date_default_timezone_set('Asia/Tokyo'); // Replace 'your_timezone' with the appropriate timezone identifier
  $currentMonth = date('Y-m-d');
  return $currentMonth;
}
function cur_month()
{
  date_default_timezone_set('Asia/Tokyo'); // Replace 'your_timezone' with the appropriate timezone identifier
  $currentMonth = date('m');
  return $currentMonth;
}
function cur_month_full()
{
  date_default_timezone_set('Asia/Tokyo'); // Replace 'your_timezone' with the appropriate timezone identifier
  $currentMonth = date('M');
  return $currentMonth;
}

if (!function_exists('allocateTable')) {
  function allocateTable($guestCount, $reservationTime)
  {
    $availableTables = App\Models\Table::whereDoesntHave('reservations', function ($query) use ($reservationTime) {
      $query->where('time', $reservationTime);
    })->get();

    $suitableTables = $availableTables->filter(function ($table) use ($guestCount) {
      return $table->seats >= $guestCount;
    })->sortBy('seats');

    if ($suitableTables->isNotEmpty()) {
      $assignedTable = $suitableTables->first();
      App\Models\Reservation::create([
        'table_id' => $assignedTable->id,
        'reservation_time' => $reservationTime
      ]);
      return $assignedTable;
    }

    return null;
  }
}
