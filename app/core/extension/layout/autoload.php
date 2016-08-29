<?php

class Core_Extension_Layout_Autoload  {
	public function __construct()
	{
		$layoutPath = Core_Core::$_path . '/etc/layout.xml';
		if (file_exists($layoutPath)) {
			$xml = new Core_Utils_Xml();
			$layoutXml = $xml->open($layoutPath);
			var_dump($layoutXml);
		}
	}
}