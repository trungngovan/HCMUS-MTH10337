<?php
class Customer {
    private $name;
    private $phone;
    private $country;
    private $orderNumber;
    private $quantity;
    private $orderDate;
    private $discount;

    public function __construct($name, $phone, $country, $orderNumber, $quantity, $orderDate) {
        $this->name = $name;
        $this->phone = $phone;
        $this->country = $country;
        $this->orderNumber = $orderNumber;
        $this->quantity = $quantity;
        $this->orderDate = $orderDate;
        $this->discount = $quantity > 100 ? 0.1 : 0;
    }

    // Getters
    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getOrderNumber() {
        return $this->orderNumber;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function getOrderDate() {
        return $this->orderDate;
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function getFormattedDiscount() {
        return number_format($this->discount * 100, 0) . '%';
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function setOrderNumber($orderNumber) {
        $this->orderNumber = $orderNumber;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        $this->discount = $quantity > 100 ? 0.1 : 0; // Recalculate discount
    }

    public function setOrderDate($orderDate) {
        $this->orderDate = $orderDate;
    }
}
?>
