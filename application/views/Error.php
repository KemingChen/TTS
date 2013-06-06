<?
    $ErrorMsg["NoThisAccount"] = "帳號 或 密碼 錯誤!!!";
    $ErrorMsg["NoLogin"] = "您尚未登入!!!";
    
    function getMessage($ErrorID, $ErrorMsg)
    {
        return array_key_exists($ErrorID, $ErrorMsg) ? $ErrorMsg[$ErrorID] : $ErrorID;
    }
?>
<style>
    .red{
        color: #DA1414;
    }
</style>
<div class="modal" style="position: relative; top: auto; left: auto; right: auto; margin: 0 auto 20px; z-index: 1; max-width: 100%;">
    <div class="modal-header">
        <h3>錯誤訊息</h3>
    </div>
    <div class="modal-body">
        <h4 class="red" align="center"><?=getMessage($ErrorID, $ErrorMsg)?><h4>
    </div>
    <div class="modal-footer">
        <a href="<?=base_url()?>" class="btn btn-primary">我知道了</a>
    </div>
</div>