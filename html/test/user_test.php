<?php

include_once ("httpful.phar");

function GetAllUsers() {
	$response = \Httpful\Request::get('localhost/users/info')->send();
	var_dump($response);
}
function InsertValidUser() {
	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "test1",
	"email": "teste1@testando.com",
	"password": "naoleia",
	"nickName": "tester1"}')->send();
	var_dump($response);
	if(strcmp($response->body) == 0){
		echo "inserido com sucesso!";
	}
}
	
function InsertUserWithInvalidEmail() {
	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "test1",
	"email": "teste1.testando.com",
	"password": "naoleia",
	"nickName": "tester1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}

function testInsertUserWithVoidEmail() {
	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "test1",
	"email": "",
	"password": "naoleia",
	"nickName": "tester1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	function testInsertUserWithRepeatedEmail(){
	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "",
	"email": "teste@jooj.com",
	"password": "naoleia",
	"nickName": "tester1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
function testInsertUserWithVoidName(){
	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "",
	"email": "teste@jiijj.com",
	"password": "naoleia",
	"nickName": "tester1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInsertUserWithVoidPassword(){
	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "",
	"email": "teste@joojs.com",
	"password": "naoleia",
	"nickName": "tester1"}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
function testInsertUserWithVoidNickName(){
	$uri = 'http://localhost/users/register';
	$response = \Httpful\Request::post($uri)
	->sendsJson()
	->body('{
	"name": "",
	"email": "teste@joojis.com",
	"password": "naoleia",
	"nickName": ""}')->send();
	
	if(strcmp($response->body, '{"code":400,"message":"Invalid email format"}') == 0){
		echo __FUNCTION__. " ". "Passou no Teste";
	}
}
	
