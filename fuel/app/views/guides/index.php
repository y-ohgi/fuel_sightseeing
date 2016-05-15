
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

<?php foreach($guides as $guide): ?>



<?php endforeach; ?>

