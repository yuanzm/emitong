<?php
/**
 * Description: 管理图文消息model
 *
 * Author: Yip
 * Date: 14-3-20 下午4:04
 */


class News {
	var $id;
	var $shopId;
	var $shopType;
	var $shopOnline;
	var $articleOrder;
	var $articleTitle;
	var $articleDescription;
	var $articleImgName;

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

	public function getShopType() {
		return $this->shopType;
	}
	public function setShopType($shopType) {
		$this->shopType = $shopType;
	}

	public function getShopOnline() {
		return $this->ShopOnline;
	}
	public function setShopOnline($ShopOnline) {
		$this->ShopOnline = $ShopOnline;
	}

	public function getArticleOrder() {
		return $this->articleOrder;
	}
	public function setArticleOrder($articleOrder) {
		$this->articleOrder = $articleOrder;
	}

	public function getArticleTitle() {
		return $this->articleTitle;
	}
	public function setArticleTitle($articleTitle) {
		$this->articleTitle = $articleTitle;
	}

	public function getArticleDescription() {
		return null == $this->articleDescription ? "" : $this->articleDescription;
	}
	public function setArticleDescription($articleDescription) {
		$this->articleDescription = $articleDescription;
	}

	public function getArticleImgName() {
		return null == $this->articleImgName ? "" : $this->articleImgName;
	}
	public function setArticleImgName($articleImgName) {
		$this->articleImgName = $articleImgName;
	}

}