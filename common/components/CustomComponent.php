<?php

namespace common\components;
use common\models\Statistic;
use yii\base\Component;

class CustomComponent extends Component{
	const EVENT_TRIGGER = "event_trigger";
	public function actionRecord(){
	$param = \Yii::$app->request;
		$stats = new Statistic();
        $stats->access_time = date('Y-m-d H:i:s');
        $stats->user_ip = $param->userIP;
        // var_dump($stats->user_ip); die();
        $stats->user_host = $param->hostInfo;
        $stats->path_info = $param->pathInfo;
        $stats->query_string = $param->queryString;
        $stats->save();
	}
}

?>