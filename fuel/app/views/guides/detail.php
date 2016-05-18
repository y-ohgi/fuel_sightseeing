<div class="row">
    <table class="table">
	<tr>
	    <td colspan="2"><img alt="" src="https://placehold.jp/3d4070/ffffff/250x250.png?text=icon"/></td>
	</tr>
	<tr>
	    <th>お名前</th>
	    <td><?= $guide['user_profiles']->name; ?></td>
	</tr>
	<tr>
	    <th>値段</th>
	    <td><?= $guide->price; ?> 円</td>
	</tr>
	<tr>
	    <th>時間帯</th>
	    <td><?php echo $guide->start_datetime; ?> 〜 <?php echo $guide->end_datetime; ?></td>
	</tr>
	<tr>
	    <th>場所</th>
	    <td><?= $guide->place; ?></td>
	</tr>
	<tr>
	    <th>説明</th>
	    <td><?= $guide->desc; ?></td>
	</tr>
    </table>
</div>


<?php if($reqflg): ?>
    <div class="guide_request" style="text-align:center;">
	<form action="<?php echo Uri::create("guides/".$guide->id."/request"); ?>" method="post">
<button class="btn btn-success" href="">この案内に申し込む！</button>
	</form>
	
    </div>
<?php endif; ?>

<style>
 td {
     text-align:center;
 }
</style>
