<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="<?= $this->view->css ?>/404.css" media="screen" />
	<title>发生错误</title>
</head>
<body>
<div id="da-wrapper" class="fluid">
	<div id="da-content">
		<div class="da-container clearfix">
			<div id="da-error-wrapper">
				<div id="da-error-pin"></div>
				<div id="da-error-code">
					 <span>error</span> </div>
				<h1 class="da-error-heading"><?=isset($_REQUEST['msg']) ? $_REQUEST['msg'] : '404错误。'?></h1>
				<p>
                    <a href="./index.php">点击进入首页</a>
                    <?php if(isset($_REQUEST['callback'])){?>
                        <a href="<?=urldecode($_REQUEST['callback'])?>">返回上一页</a>
                    <?php }?>
                </p>
			</div>
		</div>
	</div>
</div>
<script>
	setTimeout('window.history.back()', 6000);
</script>
</body>
</html>
