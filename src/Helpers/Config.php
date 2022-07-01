<?php
namespace App\Helpers;

class Config {

	public static function get(string $filename, string $key = null) {

		$content = self::getFileContent($filename);

		if ($key === null) {
			return $content;
		}
		return isset($content[$key]) ? $content[$key] : [];
	}

	public static function getFileContent(string $filename): array{

		$fileContent = [];

			$path = realpath(sprintf(__DIR__ . "/../Config/%s.php", $filename));

			if (file_exists($path)) {
				$fileContent = require $path;
			}else{
			 //throw exception
		    }

		return $fileContent;
	}
}

?>
