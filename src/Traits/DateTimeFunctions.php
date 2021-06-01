<?php


namespace ShippingAppointments\Traits;


use DateTime;

Trait DateTimeFunctions {

	public function createTimeRange($start, $end, $interval = '30 mins'): array {
		$startTime = strtotime($start);
		$endTime = strtotime($end);
		$returnTimeFormat = 'H:i';

		$current = time();
		$addTime = strtotime('+'.$interval, $current);
		$diff = $addTime - $current;

		$times = array();
		while ($startTime < $endTime) {
			$times[] = date($returnTimeFormat, $startTime);
			$startTime += $diff;
		}
		$times[] = date($returnTimeFormat, $startTime);
		return $times;
	}


	public function calculateAllTimeRanges( $timeAvailability ): array {

		$finalRanges = array();

		$startRangeTime = $timeAvailability[0];

		for ( $x = 1; $x <= count( $timeAvailability ); $x++) {

			if( isset( $timeAvailability[$x] ) ){

				$start_date = new DateTime( $timeAvailability[$x] );
				$since_start = $start_date->diff(new DateTime( $timeAvailability[$x - 1] ) );

				$totalMinDiff = $since_start->h * 60 + $since_start->i;

				if( $totalMinDiff !== 15 ){

					$finalRanges[] = array(
						'from' => $startRangeTime,
						'to' => $timeAvailability[$x-1]
					);

					$startRangeTime = $timeAvailability[$x];

				}

			}

		}

		$finalRanges[] = array(
			'from' => $startRangeTime,
			'to' => $timeAvailability[count($timeAvailability)-1]
		);

		return $finalRanges;

	}


	public function timeRangesToString( $timeRanges ): string {

		$displayRanges = array();

		if( !empty( $timeRanges ) ) {

			foreach( $timeRanges as $timeRange ){

				if( $timeRange['from'] !==  $timeRange['to'] ){
					$displayRanges[] = $timeRange['from'] . ' - ' . $timeRange['to'];
				}

			}

			return implode( ' & ', $displayRanges );

		}

		return '';

	}


	public function getWeekdaysDisable($weekDays): string {


		$weekDaysReturnArray = array();

		if (!stristr($weekDays, "mon")) {
			array_push($weekDaysReturnArray, "1");
		}
		if (!stristr($weekDays, "tue")) {
			array_push($weekDaysReturnArray, "2");
		}
		if (!stristr($weekDays, "wed")) {
			array_push($weekDaysReturnArray, "3");
		}
		if (!stristr($weekDays, "thu")) {
			array_push($weekDaysReturnArray, "4");
		}
		if (!stristr($weekDays, "fri")) {
			array_push($weekDaysReturnArray, "5");
		}
		if (!stristr($weekDays, "sat")) {
			array_push($weekDaysReturnArray, "6");
		}
		if (!stristr($weekDays, "sun")) {
			array_push($weekDaysReturnArray, "0");
		}

		return implode(",", $weekDaysReturnArray);

	}

}
