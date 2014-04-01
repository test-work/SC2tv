<?
class MyController extends Controller{
    public function actionOne(){
        echo $this->one();
    }
    public function one(){
        return 'one';
    }
}
?>