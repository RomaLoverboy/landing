<?php
namespace romaloverboy\partner\find;

use romaloverboy\partner\models\Logo;
use romaloverboy\partner\models\Advantages;
use romaloverboy\partner\models\Contacts;
use romaloverboy\partner\models\Steps;
use romaloverboy\partner\models\PriceList;
use romaloverboy\partner\models\Portfolio;
use romaloverboy\partner\models\Reviews;
use yii\db\ActiveRecord;

class Finder extends ActiveRecord
{
	public function findLogo(){
		
		return Logo::find()->where(['id' => 1])->all();
		
	}
	
	public function findAdvantages(){
		
		return Advantages::find()->all();
		
	}
	
	public function findContacts(){
		
		return Contacts::find()->all();
		
	}
	
	public function findSteps(){
		
		return Steps::find()->all();
		
	}
	
	public function findPriceList(){
		
		return PriceList::find()->all();
		
	}
	public function findPortfolio(){
		
		return Portfolio::find()->all();
		
	}
	
	public function findReviews(){
		
		return Reviews::find()->all();
		
	}
	
}
?>