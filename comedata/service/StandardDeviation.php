<?php 
class StandardDeviation
{
	private $rawGroup = [];

	public function setRawGroup(Array $rawGroup)
	{
		foreach ($rawGroup as $key => $data) {
			$this->rawGroup[$key] = (int) $data;
		}
	}

	public function getRawGroup()
	{
		return $this->rawGroup;
	}

	protected function groupLength() 
	{
		return count($this->rawGroup);
	}

	protected function sumSomeGroup($someGroup)
	{
		$sum = false;
		foreach ($someGroup as $data) {
			$sum += $data;
		}

		return $sum;
	}

	public function average()
	{
		if ($this->groupLength() <= 1) {
			return 0;
		}

		return $this->sumSomeGroup($this->getRawGroup()) / $this->groupLength();
	}

	protected function subtractOfAverageByDataOfTheGroup()
	{
		$subtractGroup = [];
		foreach ($this->rawGroup as $data) {
			array_push($subtractGroup, $data - $this->average());
		}

		return $subtractGroup;
	}

	protected function potentiationOfTheSubtractedData() 
	{
		$potentiationGroup = [];
		foreach ($this->subtractOfAverageByDataOfTheGroup() as $data) {
			array_push($potentiationGroup, $data**2);
		}

		return $potentiationGroup;
	}

	protected function sumOfTheSquares()
	{
		return $this->sumSomeGroup($this->potentiationOfTheSubtractedData());
	}

	public function getVariance()
	{
		if ($this->groupLength() <= 1) {
			return 0;
		}
        
        $divison = 0;

        try {
        	$division = ($this->sumOfTheSquares() / $this->groupLength()) - 1;
        } catch(\Exception $e) {
        	return 0;
        }

        return $division;
	}

	protected function squareRoot()
	{
		return sqrt(abs($this->getVariance()));
	}

	public function deviation()
	{
		if ($this->groupLength() < 1) {
			return 0;
		}

		return $this->squareRoot();
	}

	public function test()
	{
		var_dump($this->getVariance());
	}
}