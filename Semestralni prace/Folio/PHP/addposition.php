<?php
class AddPosition{
    private $name;
    private $ticker;
    private $longShort;
    private $private_public;
    private $date;
    private $currency;
    private $amount;
    private $opening_price;
    private $closing_price;
    private $type_select;
    private $storage = "JSON/positions.json";
    private $stored_positions; //array of positions already made
    private $new_position;
    public $error;
    public $success;
    public $uid;

    //constructor for the class and htmlspecialchars to prevent XSS
    public function __construct($name, $ticker, $longShort, $private_public, $date, $currency, $amount, $opening_price, $closing_price, $type_select){
        $this->name = htmlspecialchars(trim($name));
        $this->ticker = htmlspecialchars(trim($ticker));
        $this->longShort = $longShort;
        $this->private_public = $private_public;
        $this->date = $date;
        $this->currency = $currency;
        $this->amount = trim($amount);
        $this->opening_price = trim($opening_price);
        $this->closing_price = trim($closing_price);
        $this->type_select = $type_select;
        $this->private_public = $private_public;
        $this->stored_positions = json_decode(file_get_contents($this->storage), true);
        $this->new_position = [
            "position_id" => uniqid(),
            "name" => $this->name,
            "ticker" => $this->ticker,
            "longShort" => $this->longShort,
            "private_public" => $this->private_public,
            "date" => $this->date,
            "currency" => $this->currency,
            "amount" => $this->amount,
            "opening_price" => $this->opening_price,
            "closing_price" => $this->closing_price,
            "profit" => ($this->closing_price - $this->opening_price) / $this->opening_price * 100,
            "type_select" => $this->type_select,
            "uid" => $_SESSION["uid"]
        ];
        if ($this->checkPosition()){
            $this->addPosition();
        }
    }

    //validating functions
    function validateName() {
        if ((strlen($this -> name) >= 3) && (strlen($this ->name) <= 15)){
            return true;
        } else {
            $this->error = "Please enter a valid name";
            return false;
        };
    }

    function validateTicker() {
            if((strlen($this->ticker) >= 2) && (strlen($this->ticker) <= 10)){
            return true;
        } else {
            $this->error = "Please enter a valid ticker";
            return false;
            };

    }

    function validateLongShort() {
        if ($this->longShort != '0' && $this->longShort != '---------' && $this -> longShort != '' && $this -> longShort != 'not_selected'){
            return true;
        } else {
            $this->error = "Please select long or short for the position";
            return false;
        };
    }

    function validateDate() {
        $maxTime = time() + (60*60*24); //24 hours in the future
        if((strlen($this->date) > 0) && (strtotime($this->date) < $maxTime)){
            return true;
        } else {
            $this->error = "Please enter a valid date";
            return false;
        }
    }

    function validateCurrency() {
        if ($this->currency != '0' && $this->currency != '---------' && $this->currency != '' && $this->currency != 'not_selected'){
            return true;
        } else {
            $this->error = "Please select a currency";
            return false;
        }
    }

    function validateAmount() {
        if (strlen($this->amount) > 0){
            return true;
        } else {
            $this->error = "Please enter an amount larger than 0";
            return false;
        }
    }

    function validateOpeningPrice() {
        if ($this->opening_price > 0 && strlen($this->opening_price) > 0){
            return true;
        } else {
            $this->error = "Please enter an opening price larger than 0";
            return false;
        }
    }

    //if closing price exist check it, user can leave it blank
    function validateClosingPrice() {
        if ($this->closing_price != null ){
            if ($this->closing_price > 0 && strlen($this->closing_price) > 0){
                return true;
            } else {
                $this->error = "Please enter a closing price larger than 0";
                return false;
            }
        }
    }

    function validatePrivatePublic() {
        if ($this->private_public != '0' && $this->private_public != '---------' && $this->private_public != '' && $this->private_public != 'not_selected'){
            return true;
        } else {
            $this->error = "Please select if the position is private or public";
            return false;
        }

    }
    
    function validateType() {
        if ($this->type_select != '0' && $this->type_select != '---------' && $this->type_select != '' && $this->type_select != 'not_selected'){
            return true;
        } else {
            $this->error = "Please select a type";
            return false;
        }
    }

    //checks if all values were entered correctly
    public function checkPosition(){
        if($this->validateName() && $this->validateTicker() && $this->validateLongShort() && $this->validateDate() && $this->validateCurrency() && $this->validateAmount() && $this->validateOpeningPrice() && $this->validatePrivatePublic() && $this->validateType()){
            return true;
        }
        return false;
    }
    //adds new position to json file
    public function addPosition(){
        //puts position to the beginning of the array, so new positions appear on top for the user
        array_unshift($this->stored_positions, $this->new_position);
        if(file_put_contents($this->storage, json_encode($this->stored_positions))){
            $this->success = "Position added successfully";
            return true;
        }else{
            $this->error = "Something went wrong, try again later";
            return false;
        }
    }
}
?>