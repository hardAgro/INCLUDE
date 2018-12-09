<?php 

class ICollaborator
{
	public $arrayFromForm;
	public $arrayFromDatabase;
    
    # Push the Arrays. The array that comes from the form should be passed in the first argument
	public function pushTwoArrays(Array $arrayFromForm, Array $arrayFromDatabase)
	{
		$this->arrayFromForm = $arrayFromForm;
		$this->arrayFromDatabase = $arrayFromDatabase;
	}
    
    # Return the difference beteween two arrays
	public function differenceBetweenTwoArrays()
	{
		return array_diff($this->arrayFromDatabase, $this->arrayFromForm);
	}
    
    # Verifying when the values from Database should be deleted
	public function shouldDelete()
	{
		if (count($this->arrayFromForm) <= count($this->arrayFromDatabase)) {
			return true;
		}

		return false;
	}
    
    # Verifying when the values from form should be stored
	public function shouldStory()
	{
		if (count($this->arrayFromForm) >= count($this->arrayFromDatabase)) {
			return true;
		}

		return false;
	}
    
    # Verifying if some value in array from form is different of the value in the Database
	public function isDifferentFromDatabase($iterator)
	{
		if ( ! in_array($iterator, $this->arrayFromDatabase)) {
			return true;
		}

		return false;
	}
}