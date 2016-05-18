
<form action="guides" method="get">
    <h3>案内してもらいたい言語を選ぶ</h3>
    <select id="" name="language">
	<option value="ja">日本語</option>
	<option value="ja_osaka">大阪弁</option>
	<option value="ja_kyoto">京都弁</option>
	<option value="fi">フィンランド語</option>
	<option value="tw">台湾語</option>
	<option value="cn">中国語</option>
	<option value="kr">韓国語</option>
	<option value="en">英語</option>
    </select>

    <input class="btn btn-info" name="" type="submit" value="検索"/>
</form>

<div class="row">
    <?php foreach($guides as $guide): ?>
	<div class="col-md-6">
	    <div class="guide"  style="background:aliceblue;border:1px solid black; border-radius:5px;margin:5px;">
		<table class="table">
		    <tr>
			<td rowspan="5"><img style="width:100%;" alt="" src="https://placehold.jp/3d4070/ffffff/150x150.png?text=icon"/></td>
			<th><?php echo "[".$guide->id."] ". $guide["user_profiles"]->name; ?>さん</th>
		    </tr>
		    <tr>
			<td><?php echo $guide->start_datetime; ?> 〜 <?php echo $guide->end_datetime; ?></td>
		    </tr>
		    <tr>
			<td><?php echo $guide->place; ?></td>
		    </tr>
		    <tr>
			<td><?php echo $guide->price; ?>円</td>
		    </tr>
		    <tr>
			<td style="text-align:right;"><a class="btn btn-success" href="<?php echo Uri::create('guides/'.$guide->id); ?>">みてみる！</a></td>
		    </tr>
		</table>
	    </div>
	</div>
	

    <?php endforeach; ?>
</div>     
