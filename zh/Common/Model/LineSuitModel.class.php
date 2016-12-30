<?php
/**
 * 用户管理模型
 * Class UserModel
 */
class LineSuitModel extends ViewModel {
    public $table = "line_suit";
    
    public function deleteClear($id)
    {
        $lineSuitPriceModel = K('LineSuitPrice');
        $lineSuitPriceModel->where(" suitid={$id} ")->del();
        
        $line_suit_info=$this->find($id);
        $lineid=$line_suit_info['lineid'];
        $lineModel=K('Line');
        $lineModel->updateMinPrice($lineid);
        $this->del($id);
    }
    
    
}
?>