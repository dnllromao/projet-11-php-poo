<?php 

	class Html {

		public function linkCssFile($path) {
			return '<link rel="stylesheet" href="'.$path.'">';
		}

		public function metaTag($name, $content) {
			return '<meta name="'.$name.'" content="'.$content.'">';
		}

		public function image($src, $alt) {
			return '<img src="'.$src.'" alt="'.$alt.'"/>';
		}

		public function link($url, $text) {
			return '<a href="'.$url.'">'.$text.'</a>';
		}

		public function linkJsFile($path) {
			return '<script src="'.$path.'"></script>';
		}
	}

	$html = new Html();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Php POO - etape 2</title>
	<?php echo $html->linkCssFile('style.css'); ?>
	<?php echo $html->metaTag('description', 'Fee Web tutorials'); ?>
</head>
<body>
	<?php 
		echo $html->image('img.jpg', 'rien');
		echo $html->link('#', 'rien');
		echo $html->linkJsFile('script.php');
	?>
</body>
</html>