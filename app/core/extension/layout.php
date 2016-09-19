<?php

class Core_Extension_Layout
{
    private $_blockEnum;
    private $_config;
    
    public function __construct()
    {
        $this->_blockEnum = '';
    }
    
    public function getBlockEnum()
    {
        return $this->_blockEnum;
    }
    
    public function setBlockEnum($_blockXML)
    {
        $this->_blockEnum = $_blockXML;
    }
    
    public function setConfig($_base, $_package, $_content)
    {
        $this->_config = array();
        $this->_config['base'] = $_base;
        $this->_config['package'] = $_package;
        $this->_config['content'] = $_content;
    }
    
    public function getConfigBase()
    {
        if (!empty($this->_config['base'])) {
            return $this->_config['base'];
        } else {
            return false;
        }
    }
    
    public function getConfigPackage()
    {
        if (!empty($this->_config['package'])) {
            return $this->_config['package'];
        } else {
            return false;
        }
    }

    public function getConfigContent()
    {
        if (!empty($this->_config['content'])) {
            return $this->_config['content'];
        } else {
            return false;
        }
    }
    
    /**
	 * Includes Block by name
	 */
	
	public function includeBlock($_name)
	{
		$blockPath = $this->searchInBlocks($_name);

		if ($blockPath) {

			include_once(Router::$_basePath . $blockPath);
		}
	}
	
	/**
	 * Searches in Block Object for specific block by name
	 */
	
	private function searchInBlocks($_name)
	{
		$fullPath = '';
		$class = '';
		if ($this->_blockEnum != null) {
			foreach($this->_blockEnum->block as $block) {
				if ((string)$block->name == $_name && (string)$block->class != '') {
					$fullPath = (string)$block->class;
					break;
				}
			}
		}
		if ($fullPath != '') {
			$fullPath = explode('_', $fullPath);
			foreach($fullPath as $key => $value) {
				$fullPath[$key] = lcfirst($value);
			}
			$fullPath = implode('/', $fullPath);
			$fullPath = '/' . $fullPath . '.php';
			return $fullPath;
		} else {
			return false;
		}
	}

	public function containsInLayout($_name, $_layoutHandle)
    {
        if (!empty($_layoutHandle)) {
            foreach ($_layoutHandle as $block) {
                if ($block['name'] == $_name) {
                    return true;
                }
            }
        }

        return false;
    }
}