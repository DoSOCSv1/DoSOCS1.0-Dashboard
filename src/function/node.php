<?php
	class Node{
		 
		private $value;
		private $parentNode;
		private $path='';
		private $childNodes = array();
	
	
		public function __construct( ) {
	
		}
	
		public function getValue(){
			return $this->value;
		}
		 
		public function setValue($value){
			$this->value = $value;
			if($this->parentNode != null){
				$path = $this->parentNode->path.'/'.$value;
			}
		}
		 
		public function getParent(){
			return $this->parentNode;
		}
		 
		public function setParent($parent){
			$this->parentNode = $parent;
			$parent->addChild($this);
			if($this->value != null){
				$this->path = $this->parentNode->path.'/'.$this->value;
			}
		}
		 
		public function getPath(){
			return $this->path;
		}
		 
		public function setPath($path){
			$this->path = $path;
		}
		public function getChildNodes(){
			return $this->childNodes;
		}
		 
		public function hasChildNodes(){
			if($this->childNodes != null && count($this->childNodes) > 0)
				return true;
			return false;
		}
		 
		public function addChild($childNode){
			array_push($this->childNodes,$childNode);
		}
		 
		public  function getChildWithvalue($value){
			if(count($this->childNodes) == 0)
				return null;
			foreach($this->childNodes as $childNode){
				if($childNode->value == $value){
					return $childNode;
				}
			}
		}
	}
?>