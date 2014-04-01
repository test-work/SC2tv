<?php if(!empty($_GET['tag'])): ?>
<h1>Posts Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
<?php
endif;
?>

<?php
//подпись в навигации
$this->breadcrumbs=array('Твиты',);
?>

<?php

//if(Yii::app()->user->name!='Guest'){echo 'Au';}else{echo 'Na';}
//print_r($_GET);

if((Yii::app()->user->name)=='Guest'){
    echo '<div style="border-bottom:1px solid #999; padding-bottom:10px; margin-bottom:10px;">Войдите или зарегистрируйтесь!</div>';
}


//кошмар для параноиков
if(!isset($_GET['user'])){
	$user = 0;
}else{
	$user = (int)$_GET['user'];
}
//$user = (int)$_GET['user'];//stripslashes//htmlspecialchars//mysql_real_escape_string//echo $user;
if($user==0){
    if(Yii::app()->user->id >0){
        $user = Yii::app()->user->name;        
    }
}


$zapros = "
SELECT
    `o_page`.`id`,
    `o_page`.`user`,
    `o_page`.`title`,
    `o_page`.`text`,
    `o_user`.`username` as `names`
FROM `o_page`
LEFT JOIN `o_user` ON `o_page`.`user`=`o_user`.`id`
WHERE `o_user`.`username`='".$user."' AND `o_page`.`vis`='0'
ORDER BY `id`DESC
LIMIT 0,50
";//echo $zapros;
$arr = Page::model()->findAllBySql($zapros);
/*
*/
if(!empty($arr) AND 1==1){
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
                    <div><b>'.$value->title.'</b></div>
                    <div>'.$value->text.'</div>
                    <div>
                        <a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?r=page/update&id='.$value->id.'">Редактировать</a>,
                        <a href="http://'.$_SERVER['SERVER_NAME'].'/index.php?r=page/update&id='.$value->id.'&del=yes">Удалить</a>
                        ';
                        
                        //echo '<pre>';print_r($_SERVER);echo '</pre>';
                        
                        echo '
                    </div>
                </div>
            </div>
        ';
    }
}else{echo '<div>Нет ни одного твита!</div>';}


?>