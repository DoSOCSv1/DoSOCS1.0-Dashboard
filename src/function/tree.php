<?php
	require_once('node.php');
	class Tree {
		private $root;
		private $mAllPaths = array();
		private $mAllPathsFileIds = array();
		private $spdxId;

		public function __constructor(){
		
		}
		
		public function getRoot(){
			return $this->root;
	    }
		
		public function hasPath($path){
	       if($this->mAllPaths != null && array_key_exists($path,$this->mAllPaths)){
		     return true;
		   }
		   
		   return false;
	    }
	
	    public function setSpdxId($spdxId){
	       $this->spdxId = $spdxId;
	    }	
		
		public function addFileToPath($path,$file,$file_id){
			$this->createNode($file,$this->mAllPaths[$path]);
			$this->mAllPathsFileIds[$path.'/'.$file]=$file_id;
		}
		
		public function addFieldId($path,$file_id){
		   $this->mAllPathsFileIds[$path]=$file_id;
		}
		
		public function createPath($path){
			$tempNode = $this->getRoot();
			$parentNode = $this->getRoot();
			
			
			$directories = split('/',$path);
			
			if($tempNode == null){
				$tempNode = $this->createNode($directories[0],null);
			}
			
			$i = 1;
			while($tempNode != null && $i < count($directories)){
				   $parentNode = $tempNode;
				   $tempNode = $parentNode->getChildWithValue($directories[$i]);
					if($tempNode == null)
						$tempNode = $this->createNode($directories[$i],$parentNode);					
					$i++;	
			}
		} 	
		public function createNode($value,$parentNode){
			$tempNode = new Node();
			$tempNode->setValue($value);
			if($parentNode != null){
				$tempNode->setParent($parentNode);
			}
			
			if($this->root == null){
				$tempNode->setPath($value);
				$this->root = $tempNode;
			}
			
			$this->mAllPaths[$tempNode->getPath()] =$tempNode;
			return $tempNode;
		}
		
		public function printTree($n,$space){
	        	
			$html = '';
		    if($n != null){
			    $html = $html.'<tr> <td><div  class="treeStruct" style="position:relative;left:0px;"><span style="position:relative;left:'.$space.'px">';
				$html = $html.$n->getValue();
				$html = $html.'</span></div></td>';
				$space = $space + 20;
				if($n->hasChildNodes()){
				   $html = $html.'<td></td>';
				   $html = $html.'</tr>';
				   foreach($n->getChildNodes() as $childNode){
				     $html = $html.$this->printTree($childNode,$space);
				   }
				}else{
					$html = $html.'<td><a href="file.php?file_id=' . $this->mAllPathsFileIds[$n->getPath()] . '&doc_id=' . $this->spdxId . '">View File Details</a></td>';
				    $html = $html.'</tr>';
				}
			}
			
			return $html;
		}
		
		public function printTreeNew($n){
	        	
			//$html = '<li><a>'.$n->getValue().'</a>';
		    //if($n != null){
			    if($n->hasChildNodes()){
					$html = '<li><a>'.$n->getValue().'</a>';
					$html = $html.'<ul>';
				   foreach($n->getChildNodes() as $childNode){
				     if(!$childNode->hasChildNodes()){
						$html = $html.'<li>'.$childNode->getValue().'</li>';
					 }else{
						$html = $html.$this->printTreeNew($childNode);
						
					 }
				   }//end foreach
				   $html = $html.'</ul></li>';
				}else{
					//$html = $html.'</li>';
					$html = '<li>'.$n->getValue().'</li>';
				}
			//}
			
			return $html;
		}
		
	}
?>