<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Map';
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCagn1W2_FQjNFAzaWAlmMb0O3UVk6bQoE&language=ru&region=ua"></script>
<script>
function initialize() {
	var mapProp = {
		center:new google.maps.LatLng(50.459171, 30.419694),
		mapTypeId:google.maps.MapTypeId.ROADMAP,
		zoom:10,
		scaleControl: true 
	};
 	var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
  
	//создаем маркеры
	var markers =[
<?php	
$i = 0;
foreach($points as $point){
if ($i != 0) echo ",";
$i = $i+1;
echo "[{$point["point_n"]}, {$point["point_e"]}, '{$point["point_name"]}']";
}
?>	
	];
	var LatLng; var marker = [];
	for (i=0; i<markers.length; i++){
		LatLng = {lat: markers[i][0], lng: markers[i][1]};
		marker[i] = new google.maps.Marker({
			position: LatLng,
			map: map,
			title: markers[i][2]
		});
		
	}
}
</script>
<div class="site-contact">
<div id="googleMap" style="width:500px;height:350px; position: absolute; left: 0; right: 0;  margin: auto;"></div>
<script type="text/javascript">initialize();</script>   
</div>
