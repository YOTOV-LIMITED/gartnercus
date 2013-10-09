<?php

/**
 * This is the model class for table "gartner_userinfo".
 *
 * The followings are the available columns in table 'gartner_userinfo':
 * @property string $Id
 * @property string $FirstName
 * @property string $LastName
 * @property string $Email
 * @property integer $Department
 * @property integer $DietaryRequirements
 * @property string $OtherDietaryRequirements
 * @property string $GuestFirstName
 * @property string $GuestLastName
 * @property integer $GuestDietaryRequirements
 * @property string $GuestOtherDietaryRequirements
 * @property integer $Static
 * @property string $CreateTime
 * @property string $UpdateTime
 */
class Gartner extends CActiveRecord {
	
	const BACKEND_LIST_SIZE = 10;
	
	public $optionsRadios;
	public $countDiet;
	public $countGuestDiet;
	public $countDepartment;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Gartner the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'gartner_three';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FirstName, LastName, Email', 'required'),
			array('Department, DietaryRequirements, GuestDietaryRequirements, Static', 'numerical', 'integerOnly'=>true),
			array('FirstName, LastName, GuestFirstName, GuestLastName', 'length', 'max'=>40),
			array('Department', 'match', 'pattern' => '/^(1[0-9]|[1-9])$/is', 'on' =>'Accepted', 'message' => 'Department cannot be blank.'),
			array('Department', 'required', 'on' => 'Accepted'),
		//	array('Traffic', 'required', 'on' => 'Accepted', 'message' => 'Please indicate how you will be travelling to the Holiday Party'),
		//	array('optionsRadios', 'required', 'on' => 'Accepted', 'message' => 'Please indicate if you are bringing a guest.'),
			array('Email', 'length', 'max'=>100),
			array('Email', 'email'),
			array('Email','unique','message' => 'Your registration is already confirmed. If you have any queries please contact <a href="mailto:corporateevents@gartner.com">corporateevents@gartner.com</a>'),
			array('DeclineReason, OtherDietaryRequirements, GuestOtherDietaryRequirements', 'length', 'max'=>200),
			array('CreateTime, UpdateTime', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, FirstName, LastName, Email, Department, DietaryRequirements, OtherDietaryRequirements, GuestFirstName, GuestLastName, GuestDietaryRequirements, GuestOtherDietaryRequirements, Static, CreateTime, UpdateTime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return array(
			'Id' => 'ID',
			'FirstName' => 'First Name',
			'LastName' => 'Last Name',
			'Email' => 'Email',
			'Department' => 'Department',
			'DietaryRequirements' => 'Dietary Requirements',
			'OtherDietaryRequirements' => 'Other Dietary Requirements',
			'GuestFirstName' => 'Guest First Name',
			'GuestLastName' => 'Guest Last Name',
			'GuestDietaryRequirements' => 'Guest Dietary Requirements',
			'GuestOtherDietaryRequirements' => 'Guest Other Dietary Requirements',
			'Static' => 'Static',
			'DeclineReason' => 'Decline Reason',	
			'CreateTime' => 'Create Time',
			'UpdateTime' => 'Update Time',
			//'Traffic' => 'Please indicate how you will be travelling to the Holiday Party',	
			'optionsRadios' => 'Options Radios'		
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search() {
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id,true);
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Department',$this->Department);
		$criteria->compare('DietaryRequirements',$this->DietaryRequirements);
		$criteria->compare('OtherDietaryRequirements',$this->OtherDietaryRequirements,true);
		$criteria->compare('GuestFirstName',$this->GuestFirstName,true);
		$criteria->compare('GuestLastName',$this->GuestLastName,true);
		$criteria->compare('GuestDietaryRequirements',$this->GuestDietaryRequirements);
		$criteria->compare('GuestOtherDietaryRequirements',$this->GuestOtherDietaryRequirements,true);
		$criteria->compare('Static',$this->Static);
		$criteria->compare('CreateTime',$this->CreateTime,true);
		$criteria->compare('UpdateTime',$this->UpdateTime,true);
		$criteria->compare('optionsRadios',$this->optionsRadios);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getDepartments() {
		$departments = array(
			0 => '',	
			1 => 'CPG',
			2 => 'Events',
			3 => 'Finance',
			4 => 'HR/IT/Compliance',
			5 => 'Sales',
			6 => 'Other'		
		);
		return $departments;
	}
	
	public static function getDietaryRequirements() {
		$requirements = array(
				0 => 'None',
				1 => 'Nut Allergy',
				2 => 'Vegetarian',
				3 => 'Vegan',
				4 => 'Gluten Free',
				5 => 'Halal',
				6 => 'Kosher',
				7 => 'Lactose Intolerant',
				8 => 'Allerigc to sea food',
				9 => 'Other'
		);
		return $requirements;
	}
	
	public static function getTrafficType() {
		$type = array(
			0 => '',	
			1 => 'Driving Independently',
			2 => 'Taking a motor coach from the Fort Myers Office '		
		);
		return $type;
	}
	
	public static function getTrafficNum() {
		$where= new CDbCriteria();
		$where->select = "count(*) as countDiet, Traffic";
		$where->condition = "Static = 1 and Traffic != '' ";
		$where->group = 'Traffic';
		return self::model()->findAll($where);
	}
	
	public static function getDietCount() {
		$where= new CDbCriteria();
		$where->select = "count(*) as countDiet, DietaryRequirements";
		$where->condition = "Static = 1"; 
		$where->group = 'DietaryRequirements';
		return self::model()->findAll($where);
	}
	public static function getGuestDietCount() {
		$where= new CDbCriteria();
		$where->select = "count(*) as countGuestDiet, GuestDietaryRequirements";
		$where->condition = "GuestDietaryRequirements != '' and Static = 1";
		$where->group = 'GuestDietaryRequirements';
		return self::model()->findAll($where);
	}
	
	public static function getDepartmentCount() {
		$where= new CDbCriteria();
		$where->select = "count(*) as countDepartment, Department";
		$where->condition = "Department != 0 and Static = 1";
		$where->group = 'Department';
		return self::model()->findAll($where);
	}
	
	public static function getCountDepartmentForDiet() {
		$where= new CDbCriteria();
		$where->select = "count(*) as countDepartment, Department, DietaryRequirements";
		$where->condition = "Department != 0 and Static = 1 and DietaryRequirements != 0";
		$where->group = 'Department, DietaryRequirements';
		return self::model()->findAll($where);
	}
	
	public static function getCountGuestDepartmentForDiet() {
		$where= new CDbCriteria();
		$where->select = "count(*) as countDepartment, Department, GuestDietaryRequirements";
		$where->condition = "Department != 0 and Static = 1 and GuestDietaryRequirements != 0";
		$where->group = 'Department, GuestDietaryRequirements';
		return self::model()->findAll($where);
	}
	
	public static function getAllCountDepartmentForDiet() {
		$where= new CDbCriteria();
		$where->select = "count(*) as countDepartment, Department";
		$where->condition = "Department != 0 and Static = 1";
		$where->group = 'Department';
		return self::model()->findAll($where);
	}
	
	public static function getAllCountGuestDepartmentForDiet() {
		$where= new CDbCriteria();
		$where->select = "count(*) as countDepartment, Department";
		$where->condition = "Department != 0 and Static = 1 and ((GuestFirstName != '') or (GuestLastName != ''))";
		$where->group = 'Department';
		return self::model()->findAll($where);
	}
	public static function combinationAllDepartmentDiet($sorts, $guestSorts) {
		$count = count($guestSorts);
		if(!empty($guestSorts)) {
			if(!empty($sorts)) {
				foreach($sorts as  $v=>$sort) {
					foreach($guestSorts as  $key=> $guestSort) {
						if((intval($sort['Department']) == intval($guestSort['Department']))){
							$sort['countGuestDiet'] = intval($guestSort['countDepartment']);
							unset($guestSorts[$key]);
						}
	
					}
				}
			}
		}
		$sorts = array_merge($sorts, $guestSorts);
		$sorts = self::sort_objs($sorts, 'Department');
		return $sorts;
	}
	
	public static function combinationDepartmentDiet($sorts, $guestSorts) {
		$count = count($guestSorts);
		if(!empty($guestSorts)) {
			if(!empty($sorts)) {
				foreach($sorts as  $v=>$sort) {
					foreach($guestSorts as  $key=> $guestSort) {				
						if((intval($sort['Department']) == intval($guestSort['Department'])) and (intval($sort['DietaryRequirements']) == intval($guestSort['GuestDietaryRequirements']))){
							$sort['countDepartment'] = intval($sort['countDepartment']) + intval($guestSort['countDepartment']); 
							unset($guestSorts[$key]);
						}
						
					}
				}
			}
		}
		if(!empty($guestSorts)) {
			foreach($guestSorts as $value) {
			$value['DietaryRequirements'] = $value['GuestDietaryRequirements'];
			}
		}
		$sorts = array_merge($sorts, $guestSorts);
		$sorts = self::sort_objs($sorts, 'Department');
		return $sorts;
	}
	public static function  sort_objs($list,$key,$order='asc') {
		if(empty($list) || !isset($list[0]->{$key}))
			return $list;
	
		$alist = array();
		$c = count($list);
		$format0 = "%020s";
		$format1 = "%0".strlen($c)."s";
		for($i=0;$i<$c;$i++)
		{
		$skey = sprintf($format0,$list[$i]->{$key})."_".sprintf($format1,$i);
		$alist[$skey] = $list[$i];
	}
	$order=="asc" ? ksort($alist) : krsort($alist);
	return array_values($alist);
	}
	public static function getAllReports() {
		$reports = '';
		$criteria = new CDbCriteria();
		$criteria->condition = "Static = 1";
		$where = new CDbCriteria();
		$where->condition = "Static = 0";
		$count = self::model()->count($criteria);
		$reports['Accepted'] = $count;
		$counts = self::model()->count($where);
		$reports['Declined'] = $counts;
		$reports['Total'] = $count + $counts;
		return $reports;
	}
	
	public static function sendLocalMail($email) {
		$content = self::emailContent();
		// 当发送 HTML 电子邮件时，请始终设置 content-type
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		// 更多报头
		$headers .= 'From: Corporate Events<'.Yii::app()->params['Email']['address'].'>' . "\r\n";
		//$headers .= 'Cc:'.Yii::app()->params['Email']['fromname'] . "\r\n";
		
//		mail($email, Yii::app()->params['Email']['subject'], $content, $headers);
	}
	
	public static function sendMail($email) {
		$content = self::emailContent();
		$mailer = Yii::createComponent('application.extensions.mailer.EMailer');
		$mailer->Host = Yii::app()->params['Email']['host'];
		$mailer->IsSMTP();
		$mailer->SMTPAuth = true;
		$mailer->From = Yii::app()->params['Email']['address'];
		$mailer->AddReplyTo(Yii::app()->params['Email']['address']);
		$mailer->AddAddress($email);
		$mailer->FromName = Yii::app()->params['Email']['fromname'];
		$mailer->Username = Yii::app()->params['Email']['username'];    //这里输入发件地址的用户名
		$mailer->Password = Yii::app()->params['Email']['password'];    //这里输入发件地址的密码
		$mailer->SMTPDebug = false;   //设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
		$mailer->CharSet = 'UTF-8';
		$mailer->IsHTML(true);
		$mailer->Subject = Yii::t('demo', Yii::app()->params['Email']['subject']);
		$mailer->Body = $content;
		$mailer->Send();
	}
	
	public static function emailContent() {
		$content = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">";
	$content .= '<html xmlns="http://www.w3.org/1999/xhtml">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
	<style type="text/css">
	body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, fieldset, input, textarea, p, blockquote, th, td {
	margin:0;padding:0;
	}
	body{font-size:12px; font-family:Arial,Verdana;}
	</style>
	<body>
	<div style="width:800px;margin:auto;">
	<div style="height:100px;">
	<img src="https://app.magictony-se.com/gartnercus/images/XmasHeader10.jpg">
	</div>
	<br />
	<p>It is our pleasure to confirm your attendance at Gartner\'s Holiday Event for Fort Myers Associates.</p>
	<p>
  <table align="center">
			<tr align="center"><td>The Ritz-Carlton Naples</td>
			</tr>
			<tr align="center"><td>280 Vanderbilt Beach Road</td></tr>
			<tr align="center"><td>Naples,Florida 34108</td></tr>
			<tr align="center"><td>Friday, December 13,2013, 6:30p.m - 10:30p.m</td></tr>
  </table>
	</p>
	<p style="color:#0065a4">How to Get there:</p>
	<p>Specific directions will be provided nearer the event.</p>
	<br />
	<p style="color:#0065a4">Accommodation:</p>
	<p><b>The Ritz-Carlton, Naples</b><br/><b>280 Vanderbilt Beach Road, Naples, FL</b><br/>
	Overnight accommodation is available on a first come, first served basis at your own expense the night of December 13th.  A room block of 30 Coastal view rooms is being held at a rate of $179 + resort fee +  $12/night valet parking + tax.  The group rate will be offered for Saturday night <b>based on availability at time of request.  For individual reservations, call 1-888-856-4380 and reference Gartner, Inc. - Room Block for Holiday Party.</b> In order to ensure you are billed accurately, you MUST reference this group name and rate.  You will be asked to guarantee your reservation with a major credit card.  In order to avoid a penalty fee of the amount of your stay, reservations must be cancelled forty-eight (48) hours prior to the individual arrival date.  The room block expires November 22nd or when the rooms sell out, whichever occurs first. </p>
	<br />
	<p style="color:#0065a4">Dress Code:</p>
	<p>Cocktail Attire</p>
	<br />
	<p style="color:#0065a4">Further Information:</p>
	<p>Please note all attendees must be over 21 years old.   Should you have a need to change your party confirmation, or ask a question, please email <a href="mailto:corporateevents@gartner.com">corporateevents@gartner.com</a></p>
	<br /><br /><br />
	<div style="float:left;width:100%;height:100px;">
	<img src="https://app.magictony-se.com/gartnercus/images/XmasFooter10.jpg">
	</div>
	</div>
	</body>
</html>';
		return $content;
	}
}
