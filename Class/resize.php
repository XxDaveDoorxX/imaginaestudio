<?php

Class resize
{
	// *** Class variables
	private $image;
	private $width;
	private $height;
	private $imageResized;
	private $imgt;

	## --------------------------------------------------------

	public function __construct($file)
	{
		if(!$image_data = getimagesize($file)) {
			$this->image = false;
			$this->width = 0;
			$this->height = 0;
		} else {
			switch($image_data['mime']) {
				
				case 'image/jpeg';
					$this->image = @imagecreatefromjpeg($file);
					$this->imgt = 0;
					break;
				case 'image/bmp';
					$this->image = @imagecreatefromwbmp($file);
					$this->imgt = 0;
					break;
				case 'image/gif':
					$this->image = @imagecreatefromgif($file);
					$this->imgt = 1;
					break;
				case 'image/png':
					$this->image = @imagecreatefrompng($file);
					$this->imgt = 1;
					break;
				default:
					$this->image = false;
					break;
			}
			
			$this->width = $image_data[0];
			$this->height = $image_data[1];
		}
		//return $img;
	}

	## --------------------------------------------------------

	public function resizeImage($newWidth, $newHeight, $option="auto")
	{
		// *** Get optimal width and height - based on $option
		$optionArray = $this->getDimensions($newWidth, $newHeight, $option);

		$optimalWidth  = $optionArray['optimalWidth'];
		$optimalHeight = $optionArray['optimalHeight'];

		// *** Resample - create image canvas of x, y size
		$this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
		imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);

		// *** if option is 'crop', then crop too
		if ($option == 'crop') {
			$this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
		}
	}

	## --------------------------------------------------------
	
	private function getDimensions($newWidth, $newHeight, $option)
	{
	   switch ($option) {
			case 'exact':
				$optimalWidth = $newWidth;
				$optimalHeight= $newHeight;
				break;
			case 'portrait':
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
				break;
			case 'landscape':
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
				break;
			case 'auto':
				$optionArray = $this->getSizeByAuto($newWidth, $newHeight);
				$optimalWidth = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
			case 'crop':
				$optionArray = $this->getOptimalCrop($newWidth, $newHeight);
				$optimalWidth = $optionArray['optimalWidth'];
				$optimalHeight = $optionArray['optimalHeight'];
				break;
		}
		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	## --------------------------------------------------------

	private function getSizeByFixedHeight($newHeight)
	{
		$ratio = $this->width / $this->height;
		$newWidth = $newHeight * $ratio;
		return $newWidth;
	}

	private function getSizeByFixedWidth($newWidth)
	{
		$ratio = $this->height / $this->width;
		$newHeight = $newWidth * $ratio;
		return $newHeight;
	}

	private function getSizeByAuto($newWidth, $newHeight)
	{
		if ($this->width > $newWidth || $this->height > $newHeight) {
			if ($this->height < $this->width) {
			// *** Image to be resized is wider (landscape)
				$optimalWidth = $newWidth;
				$optimalHeight= $this->getSizeByFixedWidth($newWidth);
			}
			elseif ($this->height > $this->width) {
			// *** Image to be resized is taller (portrait)
				$optimalWidth = $this->getSizeByFixedHeight($newHeight);
				$optimalHeight= $newHeight;
			} else {
			// *** Image to be resizerd is a square
				if ($newHeight < $newWidth) {
					$optimalWidth = $this->getSizeByFixedHeight($newHeight);
					$optimalHeight= $newHeight;
				} else if ($newHeight > $newWidth) {
					$optimalWidth = $newWidth;
					$optimalHeight= $this->getSizeByFixedWidth($newWidth);
				} else {
					// *** Sqaure being resized to a square
					$optimalWidth = $newWidth;
					$optimalHeight= $newHeight;
				}
			}
		} else {
			$optimalWidth = $this->width;
			$optimalHeight= $this->height;
		}

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	## --------------------------------------------------------

	private function getOptimalCrop($newWidth, $newHeight)
	{
		$heightRatio = $this->height / $newHeight;
		$widthRatio  = $this->width /  $newWidth;

		if ($heightRatio < $widthRatio) {
			$optimalRatio = $heightRatio;
		} else {
			$optimalRatio = $widthRatio;
		}

		$optimalHeight = $this->height / $optimalRatio;
		$optimalWidth  = $this->width  / $optimalRatio;

		return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
	}

	## --------------------------------------------------------

	private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
	{
		// *** Find center - this will be used for the crop
		$cropStartX = ($optimalWidth - $newWidth) / 2;
		$cropStartY = ($optimalHeight - $newHeight) / 2;

		$crop = $this->imageResized;
		//imagedestroy($this->imageResized);

		// *** Now crop from center to exact requested size
		$this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
		imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
	}

	## --------------------------------------------------------

	public function saveImage($savePath, $imageQuality="100")
	{

		switch($this->imgt)
		{
			case 0:
				$filename = preg_replace('"\.[.]+$"', '.jpg', $savePath);
				if (imagetypes() & IMG_JPG) {
					imagejpeg($this->imageResized, $savePath, $imageQuality);
				}
				break;
			case 1:
				$filename = preg_replace('"\.[.]+$"', '.gif', $savePath);
				if (imagetypes() & IMG_GIF) {
					imagegif($this->imageResized, $savePath);
				}
				break;
		}

		imagedestroy($this->imageResized);
	}

	## --------------------------------------------------------

}
?>
