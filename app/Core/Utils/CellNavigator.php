<?php

namespace App\Core\Utils;

class CellNavigator
{
	protected $row = 1;
	protected $start = 65; //A

	public function currentCell (): string
	{
		return $this->makeCell();
	}

	public function nextCell (): string
	{
		$this->start++;
		return $this->makeCell();
	}

	public function previousCell (): string
	{
		$this->start--;
		return $this->makeCell();
	}

	public function advanceNextRow (): int
	{
		$this->row++;
		return $this->row;
	}

	public function retreatPreviousRow (): int
	{
		$this->row--;
		return $this->row;
	}

	public function setCurrentRow (int $row): int
	{
		$this->row = $row;
		return $this->row;
	}

	public function moveToFirstRow ()
	{
		$this->setCurrentRow(1);
	}

	protected function makeCell (): string
	{
		if ($this->start >= 65 && $this->start < 91) {
			return sprintf('%c%d', $this->start, $this->row);
		} elseif ($this->start >= 91 && $this->start < 117) {
			$current = $this->start - 91;
			$current += 65;
			return sprintf('A%c%d', $current, $this->row);
		} elseif ($this->start >= 117 && $this->start < 142) {
			$current = $this->start - 117;
			$current += 65;
			return sprintf('B%c%d', $current, $this->row);
		} else {
			return sprintf('%c%d', $this->start, $this->row);
		}
	}
}