<?php
	class Duration{

		public static function fromString($string) {
			$parts = explode(':', $string);
			$object = new self();
			if (count($parts) === 2) {
				$object->minutes = $parts[0];
				$object->seconds = $parts[1];
			} elseif (count($parts) === 3) {
				$object->hours = $parts[0];
				$object->minutes = $parts[1];
				$object->seconds = $parts[2];
			} else {
				// handle error
			}
			return $object;
		}

		private $hours;
		private $minutes;
		private $seconds;

		public function getHours() {
			return $this->hours;
		}

		public function getMinutes() {
			return $this->minutes;
		}

		public function getSeconds() {
			return $this->seconds;
		}

		public function add(Duration $d) {
			$this->hours += $d->hours;
			$this->minutes += $d->minutes;
			$this->seconds += $d->seconds;
			while ($this->seconds >= 60) {
				$this->seconds -= 60;
				$this->minutes++;
			}
			while ($this->minutes >= 60) {
				$this->minutes -= 60;
				$this->hours++;
			}
		}

		public function __toString() {
		//	if($this->minutes<10) 
			return implode(':', array(str_pad($this->hours,  2, "0", STR_PAD_LEFT), str_pad($this->minutes,  2, "0", STR_PAD_LEFT), str_pad($this->seconds,  2, "0", STR_PAD_LEFT)));
		}

	}
?>