<?php
namespace app\models;

use yii\base\Model;

class GPoints extends Model{
	public $point_id;
	public $point_n;
	public $point_e;
	public $point_name;
	
	public function rules(){
		return [
			[['point_n','point_e','point_name'], 'required'],
			[['point_n'], 'number', 'min'=>-90, 'max'=>90],
			[['point_e'], 'number', 'min'=>-180, 'max'=>180],
			[['point_name'], 'string', 'min'=>1, 'max'=>100]
		];
	}
	
public function attributeLabels()
{
    return array(
        'point_name' => 'Описание координаты'
    );
}	
	
}

?>
