<?php

class backAccount {
    private $balance = 0;

    public function deposit($amount){
        $this->balance += $amount;
    }

    public function withdraw($amount){
        if($amount > 0 && $this->balance >= $amount){
            $this->balance -= $amount;
        }
    }

    public function checkBalance(){
        return $this->balance;
    }
}

$ac = new backAccount();
$ac->deposit(10000);
$ac->withdraw(999);
echo "Current balance :" . $ac->checkBalance();

?>
