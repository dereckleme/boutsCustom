<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class MyXml{
	var $tab = 1;
	var $xml;
	var $livre;
	
	public function __construct($version = '1.0', $enconde = 'UTF-8'){
		$this->xml .= "<?xml version='$version' encoding='$enconde'?>\n";
	}
	
	public function openTag($name){
		$this->addTab();
		$this->xml .= "<$name>\n";
		$this->tab++;		
	}
		
	public function closeTag($name){
		$this->tab--;
		$this->addTab();
		$this->xml .= "</$name>\n";
	}
	
	public function setValue($value){
		$this->xml .= "$value\n";
	}
	
	public function addTag($name, $value){
		$this->addTab();
		$this->xml .= "<$name>$value</$name>\n";
	}
	
	public function openTagAttr($name, $attribute){
		$this->addTab();
		$this->xml .= "<$name item=\"{$attribute}\">\n";
		$this->tab++;
	}

	public function tagFree($content){
		$this->xml .= $content;
	} 
	
	private function addTab(){
		for ($i = 1; $i <= $this->tab; $i++){
			$this->xml .= "\t";			
		}
	}
		
	public function __toString(){
		return $this->xml;
	}
	
	public function structXml(){
		return $this->xml;
	}
	
}