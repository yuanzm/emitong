<?php
/**
 * Description: 办卡状态model
 * status       description
 * -1           未审核
 * -2           审核不通过
 * 0            通过审核制卡中
 * 1            已发卡
 *
 * Author: Yip
 * Date: 14-3-29 下午4:43
 */

class ApplyStatus {
	var $id;
	var $openId;
	var $userId;
	var $status;
	var $download;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getOpenId() {
		return null == $this->openId ? "" : $this->openId;
	}
	public function setOpenId($openId) {
		$this->openId = $openId;
	}

	public function getUserId() {
		return $this->userId;
	}
	public function setUserId($userId) {
		$this->userId = $userId;
	}

	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
	}

	public function getDownload() {
		return $this->download;
	}
	public function setDownload($download) {
		$this->download = $download;
	}
}