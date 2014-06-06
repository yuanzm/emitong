<?php
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-3-21 下午7:12
 */

class ShopOne {
	var $id;
	var $shopId;
	var $oneName;
	var $oneEmiPrice;
	var $onePrice;
	var $oneBeginTime;
	var $oneEndTime;
	var $oneDescription;
	var $oneImgName;
	var $oneCreateTime;
	var $oneOrder;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getShopId() {
		return $this->shopId;
	}
	public function setShopId($shopId) {
		$this->shopId = $shopId;
	}

	public function getOneName() {
		return $this->oneName;
	}
	public function setOneName($oneName) {
		$this->oneName = $oneName;
	}

	public function getOneEmiPrice() {
		return $this->oneEmiPrice;
	}
	public function setOneEmiPrice($oneEmiPrice) {
		$this->oneEmiPrice = $oneEmiPrice;
	}

	public function getOnePrice() {
		return $this->onePrice;
	}
	public function setOnePrice($onePrice) {
		$this->onePrice = $onePrice;
	}

	public function getOneBeginTime() {
		return $this->oneBeginTime;
	}
	public function setOneBeginTime($oneBeginTime) {
		$this->oneBeginTime = $oneBeginTime;
	}

	public function getOneEndTime() {
		return $this->oneEndTime;
	}
	public function setOneEndTime($oneEndTime) {
		$this->oneEndTime = $oneEndTime;
	}

	public function getOneDescription() {
		return $this->oneDescription;
	}
	public function setOneDescription($oneDescription) {
		$this->oneDescription = $oneDescription;
	}

	public function getOneImgName() {
		return $this->oneImgName;
	}
	public function setOneImgName($oneImgName) {
		$this->oneImgName = $oneImgName;
	}

	public function getOneCreateTime() {
		return $this->oneCreateTime;
	}
	public function setOneCreateTime($oneCreateTime) {
		$this->oneCreateTime = $oneCreateTime;
	}

	public function getOneOrder() {
		return $this->oneOrder;
	}
	public function setOneOrder($oneOrder) {
		$this->oneOrder = $oneOrder;
	}

}