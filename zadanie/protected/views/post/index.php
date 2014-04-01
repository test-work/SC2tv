<?php
/* @var $this PageController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Твитнуть!',
);

$this->menu=array(
	array('label'=>'Create Page', 'url'=>array('create')),
	array('label'=>'Manage Page', 'url'=>array('admin')),
);
?>

<?php
$zapros = "
SELECT
    `o_page`.`id`,
    `o_page`.`user`,
    `o_page`.`title`,
    `o_page`.`text`,
    `o_user`.`username` as `name`
FROM `o_page`
LEFT JOIN `o_user` ON `o_page`.`user`=`o_user`.`id`
WHERE `o_page`.`vis`='0'
ORDER BY `id`DESC
LIMIT 0,50
";//echo $zapros;
$arr = Page::model()->findAllBySql($zapros);

foreach($arr as $key => $value){
        echo '
            <div style="border-bottom:1px solid #999; vertical-align:top; padding-bottom:10px; margin-bottom:10px;">
                <div style="display:inline-block; vertical-align:top;">
                    ';
                    
                    //определяем картинку
                    $pic_arr = array(
                        'http://chat.sc2tv.ru/img/bm.png?4',
                        'http://chat.sc2tv.ru/img/cap.png?1',
                        'http://chat.sc2tv.ru/img/crab.png?1',
                        'http://chat.sc2tv.ru/img/sunl.png?1',
                        'http://chat.sc2tv.ru/img/cougar.png?2',
                        
                        'http://chat.sc2tv.ru/img/omsk.png?2',
                        'http://chat.sc2tv.ru/img/yeah.png?1',
                        'http://chat.sc2tv.ru/img/ling.png?1',
                        'http://chat.sc2tv.ru/img/bin.png?1',
                        'http://chat.sc2tv.ru/img/kot.png?1',
                        
                        'http://chat.sc2tv.ru/img/daaa.png?1',
                        'http://chat.sc2tv.ru/img/bear.png?1',
                        'http://chat.sc2tv.ru/img/no.png?1',
                        'http://chat.sc2tv.ru/img/mother-of-the-god.png?v=1',
                        'http://chat.sc2tv.ru/img/ilied.png?1',
                        
                        'http://chat.sc2tv.ru/img/zeal.png?1',
                        'http://chat.sc2tv.ru/img/kid.png?1',
                        'http://chat.sc2tv.ru/img/poker.png?1',
                        'http://chat.sc2tv.ru/img/povar.png?1',
                        'http://chat.sc2tv.ru/img/angryling.png?1',
                        
                        'http://chat.sc2tv.ru/img/awesome.png?1',
                        'http://chat.sc2tv.ru/img/mad.png?1',
                        'http://chat.sc2tv.ru/img/slowpoke.png?1',
                        'http://chat.sc2tv.ru/img/ra.png?1',
                        'http://chat.sc2tv.ru/img/facepalm.png?1',
                        
                        'http://chat.sc2tv.ru/img/trollface.png?2',
                        'http://chat.sc2tv.ru/img/yao.png?1',
                        'http://chat.sc2tv.ru/img/fyeah.png?1',
                        'http://chat.sc2tv.ru/img/alone.png?2',
                        'http://chat.sc2tv.ru/img/megusta.png?1',
                    );
                    $pic_ava = (55+(Yii::app()->user->id))%20;
                    
                    echo '
                    <img src="'.$pic_arr[$value['user']].'" style="width:48px; height:48px;">
                </div>
                <div style="display:inline-block; vertical-align:top;">
                    ';

//$zapros = "SELECT `username` FROM `o_user` WHERE `id`='".(Yii::app()->user->id)."'";
//echo $zapros;
//$arrs = Page::model()->findAllBySql($zapros);
//foreach($arrs as $key1 => $value1){//echo $value1->id;//print_r($value1);}

                    echo '
                    <div><b>'.$value['user'].' - '.$value->title.'</b></div>
                    <div>'.$value->text.'</div>
                    <div>
                        ';
                        
                        if(Yii::app()->user->id==$value['user']){
                        echo '
                        <a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?r=page/update&id='.$value->id.'">Редактировать</a>,
                        <a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?r=page/update&id='.$value->id.'&del=yes">Удалить</a>
                        ';
                        }
                        
                        //echo '<pre>';print_r($_SERVER);echo '</pre>';
                        
                        echo '
                    </div>
                </div>
            </div>
        ';
}
?>

<?php
//$arr = Page::model()->findByPk(2);echo $arr->title;
?>