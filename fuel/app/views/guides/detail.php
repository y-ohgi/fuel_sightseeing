<pre>
    <?php var_dump($guide);  ?>
</pre>

<?php if($reqflg): ?>
    <div class="guide_request" style="text-align:center;">
	<form action="<?php echo Uri::create("guides/".$guide->id."/request"); ?>" method="post">
<button class="btn btn-success" href="">この案内に申し込む！</button>
	</form>
	
    </div>
<?php endif; ?>
