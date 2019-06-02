<?php
class User extends Model 
{   
    protected $user_Id;
    // protected $session;

    public function __construct() 
    {  
        parent::__construct();
        $this->authenticateUser(); 
    }

    protected function authenticateUser()
    {  
        $this->session->checkSession(USER_ID_TAG) ? $this->setUser() : $this->createUser();
    }

    public function getUser()
    {
        return $this->user_Id;
    }

    private function createUser()
    { 
        if ( $this->session->createSession(USER_ID_TAG, "user_".time()) )
        {
            $this->setUser();
        }
    }

    private function setUser()
    {  
        $this->user_Id =  ($this->session->getSession(USER_ID_TAG)) ? $this->session->getSession(USER_ID_TAG) : NULL;
    }

    public function getUserWalletBalance()
    {
       if (!$this->session->checkUserWalletBalance())
       {
           $this->session->createUserWalletBalance();
       }
       return $this->session->getUserWalletBalance();
    }

    public function updateUserWalletBalance($newBalance)
    {
        return $this->session->updateUserWalletBalance($newBalance);
    }

    public function saveUserRatingActivity($product_Id, $user_Rating)
    {
        $this->session->saveUserRatings($product_Id, $user_Rating);
    }

    public function getUserRatingActivities()
    {
        if ($this->session->getUserRatings()) 
        {
            return $this->session->getUserRatings();
        }
    }
     
}