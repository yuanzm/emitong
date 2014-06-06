<?php
/**
 * Description: 
 *
 * Author: Yip
 * Date: 14-4-14 下午6:41
 */

class ShopHome {
	var $id;
	var $shopId;
	var $homeImgName;

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

	public function getHomeImgName() {
		return $this->homeImgName;
	}
	public function setHomeImgName($homeImgName) {
		$this->homeImgName = $homeImgName;
	}
}