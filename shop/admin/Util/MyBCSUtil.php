<?php
/**
 * BCS API sample
 */
if (! defined ( 'BCS_UTIL_PATH' )) {
	define ( 'BCS_UTIL_PATH', dirname(dirname ( __FILE__ )) );
}
require_once (BCS_UTIL_PATH. '/BCS_SDK/bcs.class.php');

class MyBCSUtil {

	static $host = 'bcs.duapp.com'; //online
	static $ak = 'PuVxl95jdqd80P7ydQ9eGnpm';
	static $sk = 'M9yzNGC7h3p62hwdOGpVuovjwUScGacz';
	static $bucket = 'emi-file';

	static $upload_dir;
	static $object;         // 以 '/' 开头的object名，不超过255字节
	static $fileUpload;     // 待上传的文件的相对路径或绝对路径
	static $fileWriteTo;    //下载目录


	function getMyBCS() {
		$bcs = new BaiduBCS ( self::$ak, self::$sk, self::$host );
		return $bcs;
	}
	function setObject($object) {
		self::$object = $object;
	}
	function setFileUpload($fileUpload) {
		self::$fileUpload = $fileUpload;
	}

	function setFileWriteTo($fileWriteTo) {
		self::$fileWriteTo = $fileWriteTo;
	}
	function setUploadDir($uploadDir) {
		self::$upload_dir =$uploadDir;
	}
	/**
	 * ************************bucket********************************** *
	 * */
	function create_bucket($baidu_bcs) {
		//global $bucket;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_CONTROL;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ_WRITE;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_WRITE;
		$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PRIVATE;
		$response = $baidu_bcs->create_bucket ( self::$bucket, $acl );
		//printResponse ( $response );
	}

	function delete_bucket($baidu_bcs) {
		//global $bucket;
		$response = $baidu_bcs->delete_bucket ( self::$bucket );
		//printResponse ( $response );
	}

	function list_object($baidu_bcs) {
		//global $bucket, $fileWriteTo;
		$opt = array (
			'start' => 0,
			'limit' => 5,
			'prefix' => '/a' );
		$response = $baidu_bcs->list_object ( self::$bucket, $opt );
		//printResponse ( $response );
	}

	function list_bucket($baidu_bcs) {
		$response = $baidu_bcs->list_bucket ();
		//printResponse ( $response );
	}

	function get_bucket_acl($baidu_bcs) {
		//global $bucket;
		$response = $baidu_bcs->get_bucket_acl ( self::$bucket );
		//printResponse ( $response );
	}

	function set_bucket_acl_by_acl_type($baidu_bcs) {
		//global $bucket;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_CONTROL;
		$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ_WRITE;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_WRITE;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PRIVATE;
		$response = $baidu_bcs->set_bucket_acl ( self::$bucket, $acl );
		//printResponse ( $response );
	}

	function set_bucket_acl_by_json_array($baidu_bcs) {
		//global $bucket;
		$acl = array (
			'statements' => array (
				'0' => array (
					'user' => array (
						"*" ),
					'resource' => array (
						self::$bucket . '/' ),
					'action' => array (
						BaiduBCS::BCS_SDK_ACL_ACTION_ALL ),
					'effect' => BaiduBCS::BCS_SDK_ACL_EFFECT_ALLOW ) ) );

		$response = $baidu_bcs->set_bucket_acl ( self::$bucket, $acl );
		//printResponse ( $response );
	}

	function set_bucket_acl_by_json_string($baidu_bcs) {
		//global $bucket;
		$acl = array (
			'statements' => array (
				'0' => array (
					'user' => array (
						"psp:jason_zhengkan" ),
					'resource' => array (
						self::$bucket . '/' ),
					'action' => array (
						BaiduBCS::BCS_SDK_ACL_ACTION_GET_OBJECT,
						BaiduBCS::BCS_SDK_ACL_ACTION_PUT_OBJECT ),
					'effect' => BaiduBCS::BCS_SDK_ACL_EFFECT_ALLOW ) ) );
		$acl = json_encode ( $acl );
		$response = $baidu_bcs->set_bucket_acl ( self::$bucket, $acl );
		//printResponse ( $response );
	}

	/**
	 * ************************object********************************** *
	 * */

	function bs_log($log) {
		trigger_error ( basename ( __FILE__ ) . " [time: " . time () . "][LOG: $log]" );
	}

	function create_object($baidu_bcs) {
		//global $fileUpload, $object, $bucket;
		$opt = array ();
		$opt ['acl'] = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_WRITE;
		$opt [BaiduBCS::IMPORT_BCS_LOG_METHOD] = "bs_log";
		$opt ['curlopts'] = array (
			CURLOPT_CONNECTTIMEOUT => 10,
			CURLOPT_TIMEOUT => 1800 );
		$response = $baidu_bcs->create_object ( self::$bucket, self::$object, self::$fileUpload, $opt );
		//printResponse ( $response );
	}

	function create_object_superfile($baidu_bcs) {
		//global $fileUpload, $object, $bucket;
		$opt = array ();
		$opt ['acl'] = BaiduBCS::BCS_SDK_ACL_TYPE_PRIVATE;
		$opt [BaiduBCS::IMPORT_BCS_LOG_METHOD] = "bs_log";
		$opt ["sub_object_size"] = 1024 * 256;
		$response = $baidu_bcs->create_object_superfile ( self::$bucket, self::$object, self::$fileUpload, $opt );
		//printResponse ( $response );
	}

	function pre_filter($bucket, $object, $file, &$tmp_opt) {
		//举例在上传文件在$opt中加入一个特定串，在post_filter中取出并打印
		$tmp_opt ["something"] = "something about [$object]";
		return true;
	}

	function post_filter($bucket, $object, $file, &$tmp_opt, $response) {
		//配合
		trigger_error ( $tmp_opt ["something"] );
		return;
	}

	function upload_directory($baidu_bcs) {
		//global $upload_dir, $bucket;
		$opt = array (
			"prefix" => "/20110622",
			"has_sub_directory" => true,
			BaiduBCS::IMPORT_BCS_PRE_FILTER => "pre_filter",
			BaiduBCS::IMPORT_BCS_POST_FILTER => "post_filter" );
		$baidu_bcs->upload_directory ( self::$bucket, self::$upload_dir, $opt );
	}

	function copy_object($baidu_bcs) {
		//global $object, $bucket;
		$source = 'bs://' . self::$bucket . self::$object;

		$source = array (
			'bucket' => self::$bucket,
			'object' => self::$object );
		$dest = array (
			'bucket' => self::$bucket,
			'object' => self::$object . 'copy' );
		$response = $baidu_bcs->copy_object ( $source, $dest );
		//printResponse ( $response );
		if ($response->isOK ()) {
			echo "you can download from =" . $baidu_bcs->generate_get_object_url ( self::$bucket, $dest ['object'] );
		}
	}

	function set_object_meta($baidu_bcs) {
		//global $bucket, $object;
		$meta = array (
			"Content-Type" => BCS_MimeTypes::get_mimetype ( "pdf" ) );
		$response = $baidu_bcs->set_object_meta ( self::$bucket, self::$object, $meta );
		//printResponse ( $response );
	}

	function get_object($baidu_bcs) {
		//global $object, $bucket, $fileWriteTo;
		$opt = array (
			'fileWriteTo' => self::$fileWriteTo );
		$response = $baidu_bcs->get_object ( self::$bucket, self::$object, $opt );
		if ($response->isOK ()) {
			//echo "response is OK\n";
			return true;
		} else {
			//printResponse ( $response );
			return false;
		}

	}

	function delete_object($baidu_bcs) {
		//global $object, $bucket;
		$response = $baidu_bcs->delete_object ( self::$bucket, self::$object );
		//printResponse ( $response );
	}

	function get_object_acl($baidu_bcs) {
		//global $bucket, $object;
		$response = $baidu_bcs->get_object_acl ( self::$bucket, self::$object );
		//printResponse ( $response );
	}

	function set_object_acl_by_acl_type($baidu_bcs) {
		//global $bucket, $object;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_CONTROL;
		$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_READ_WRITE;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PUBLIC_WRITE;
		//	$acl = BaiduBCS::BCS_SDK_ACL_TYPE_PRIVATE;
		$response = $baidu_bcs->set_object_acl ( self::$bucket, self::$object, $acl );
		//printResponse ( $response );
	}

	function set_object_acl_by_json_string($baidu_bcs) {
		//global $bucket, $object;
		$acl = array (
			'statements' => array (
				'0' => array (
					'user' => array (
						'psp:jason_zhengkan' ),
					'resource' => array (
						self::$bucket . self::$object ),
					'action' => array (
						BaiduBCS::BCS_SDK_ACL_ACTION_GET_OBJECT,
						BaiduBCS::BCS_SDK_ACL_ACTION_PUT_OBJECT ),
					'effect' => 'allow' ) ) );

		$response = $baidu_bcs->set_object_acl ( self::$bucket, self::$object, json_encode ( $acl ) );
		//printResponse ( $response );
	}

	function set_object_acl_by_json_array($baidu_bcs) {
		//global $bucket, $object;
		$acl = array (
			'statements' => array (
				'0' => array (
					'user' => array (
						"*" ),
					'resource' => array (
						self::$bucket . self::$object ),
					'action' => array (
						BaiduBCS::BCS_SDK_ACL_ACTION_GET_OBJECT,
						BaiduBCS::BCS_SDK_ACL_ACTION_PUT_OBJECT,
						BaiduBCS::BCS_SDK_ACL_ACTION_DELETE_OBJECT ),
					'effect' => 'allow' ) ) );

		$response = $baidu_bcs->set_object_acl ( self::$bucket, self::$object, $acl );
		//printResponse ( $response );
	}

	function is_object_exist($baidu_bcs) {
		//global $bucket, $object;
		$bolRes = $baidu_bcs->is_object_exist ( self::$bucket, self::$object );
		//echo $bolRes == true ? "Object exist" : "Object not exist";
	}

	function get_object_info($baidu_bcs) {
		//global $bucket, $object;
		$response = $baidu_bcs->get_object_info ( self::$bucket, self::$object );
		//printResponse ( $response );
		//var_dump ( $response->header );
	}

	function generate_get_object_url($baidu_bcs) {
		//global $bucket, $object;
		$opt = array ();
		$opt ["time"] = time () + 3600; //可选，链接生效时间为linux时间戳向后一小时
		//$opt ["ip"] = "10.81.42.123"; //可选，限制本链接发起的客户端ip


		return $baidu_bcs->generate_get_object_url ( self::$bucket, self::$object, $opt );
	}

	function generate_put_object_url($baidu_bcs) {
		//global $bucket, $object;
		$opt = array ();
		$opt ["time"] = time () + 3600; //可选，链接生效时间为linux时间戳向后一小时
		$opt ["size"] = 1024 * 1024; //可选，用户上传时，限制上传大小，这里限制1MB
		//"ip" => "192.168.1.1"    //可选，限制本链接发起的客户端ip


		//echo $baidu_bcs->generate_put_object_url ( self::$bucket, self::$object, $opt );
	}

	function generate_post_object_url($baidu_bcs) {
		//global $bucket, $object;
		$opt = array ();
		$opt ["time"] = time () + 3600; //可选，链接生效时间为linux时间戳向后一小时
		$opt ["size"] = 1024 * 1024; //可选，用户上传时，限制上传大小，这里限制1MB
		//"ip" => "192.168.1.1"    //可选，限制本链接发起的客户端ip


		//echo $baidu_bcs->generate_post_object_url ( self::$bucket, self::$object, $opt );
	}

	function printResponse($response) {
		echo $response->isOK () ? "OK\n" : "NOT OK\n";
		echo 'Status:' . $response->status . "\n";
		echo 'Body:' . $response->body . "\n";
		echo "Header:\n";
		var_dump ( $response->header );
	}
}



?>