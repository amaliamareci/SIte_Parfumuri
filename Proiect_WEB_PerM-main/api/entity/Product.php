<?php

class Product
{
    private $id;
    private $name;
    private $manufacturer;
    private $new_price;
    private $old_price;
    private $quantity;
    private $category;
    private $gender;
    private $type;
    private $info_url;
    private $release_date;

    public function __construct($id, $name, $manufacturer, $stock, $new_price, $old_price, $quantity, $category, $gender, $type, $info_url, $release_date) {
        $this->id = $id;
        $this->name = $name;
        $this->manufacturer = $manufacturer;
        $this->stock = $stock;
        $this->new_price = $new_price;
        $this->old_price = $old_price;
        $this->quantity = $quantity;
        $this->category = $category;
        $this->gender = $gender;
        $this->type = $type;
        $this->info_url = $info_url;
        $this->release_date = $release_date;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getManufacturer() {
        return $this->manufacturer;
    }

    public function setManufacturer($manufacturer) {
        $this->manufacturer = $manufacturer;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function getNewPrice() {
        return $this->new_price;
    }

    public function setNewPrice($new_price) {
        $this->new_price = $new_price;
    }

    public function getOldPrice() {
        return $this->old_price;
    }

    public function setOldPrice($old_price) {
        $this->old_price = $old_price;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getGender() {
        return $this->gender;
    }

    public function setGender($gender) {
        $this->gender = $gender;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getInfoUrl() {
        return $this->info_url;
    }

    public function setInfoUrl($info_url) {
        $this->info_url = $info_url;
    }

    public function getReleaseDate() {
        return $this->release_date;
    }

    public function setReleaseDate($release_date) {
        $this->release_date = $release_date;
    }
}

?>