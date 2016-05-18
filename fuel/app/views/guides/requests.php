<div class="row">
    <?php if($guide_requests): ?>
	<?php foreach($guide_requests as $req): ?>
	    <div class="col-md-6">
		<table>
		    <tr>
			<td rowspan="5" colspan="2"><img alt="" src="https://placehold.jp/3d4070/ffffff/150x150.png?text=icon"/></td>
		    </tr>
		    <tr>
			<th>名前</th>
		    	<td><?= $req['user_profiles']->name; ?></td>
		    </tr>
		    <tr>
			<th>PR</th>
			<td><?= $req['user_profiles']->pr; ?></td>
		    </tr>
		    <tr>
			<th>ヒトコト</th>
			<td>未実装</td>
		    </tr>
		    <tr>
			<td>
			    <form action="<?php echo Uri::create('guides/'.$req->guides_id.'/requests/'.$req->id); ?>" method="post">
				<button onclick="return confirm('この人でいいの？')" class="btn btn-success">この人に決めた！</button>
			    </form>
			</td>
			<td>
			    <form action="<?php echo Uri::create('guides/'.$req->guides_id.'/requests/'.$req->id.'/delete'); ?>" method="post">
				<button onclick="return confirm('消していいの？')" class="btn btn-danger">やめておく</button>
			    </form>
			</td>
		    </tr>
		    
		</table>
	    </div>
	<?php endforeach; ?>
	
    <?php else: ?>
	<h3>リクエストは存在しません</h3>
    <?php endif; ?>
</div>

<pre>
    <?php echo var_dump($guide_requests); ?>
</pre>
