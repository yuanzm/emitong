<?php
/**
 * Description: 管理员组别表
 *
 * Author: Yip
 * Date: 14-3-23 下午3:39
 */

class AdminGroup {
	var $id;
	var $groupName;
	var $groupPrivilege;
	var $groupDescrition;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}

	public function getGroupName() {
		return $this->groupName;
	}
	public function setGroupName($groupName) {
		$this->groupName = $groupName;
	}

	public function getGroupPrivilege() {
		return $this->groupPrivilege;
	}
	public function setGroupPrivilege($groupPrivilege) {
		$this->groupPrivilege = $groupPrivilege;
	}

	public function getGroupDescription() {
		return null == $this->groupDescrition ? "" : $this->groupDescrition;
	}
	public function setGroupDescription($groupDescription) {
		$this->groupDescrition = $groupDescription;
	}
}