<?php

namespace romaloverboy\partner;

/**
 * Module module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
	 
    public $controllerNamespace = 'romaloverboy\partner\controllers';
    
	public $dbConnection = 'db2';
    /**
     * @inheritdoc
     */

	public function getDb()
    {
        return \Yii::$app->get($this->dbConnection);
    }
	
	
}
