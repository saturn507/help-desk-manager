<?php

namespace App\Http\Helpers;
 
use Illuminate\Support\Facades\DB;
 
class GenUserData {
    /**
     * Генерирует название компании
     *
     * @return string
     */
    public static function genName()
    {
		return "Компания ".self::randChar(3);
	}
	
	/**
     * Генерирует email
     *
     * @return string
     */
	public static function genEmail()
	{
		return "8".self::randNum(10)."@mail.ru";
	}
	
	/**
     * Генерирует номер телефона
     *
     * @return string
     */
	public static function genPhone()
	{
		return "+7".self::randNum(10);
	}
	
	/**
     * Генерация случайной последовательности символов
     *
     * @param  $j int
     * @return string
     */
	private static function randChar($j)
	{
		$arr = ['A','B','C','D','E','F','G','H','I','J'];
		$str = '';
		for($i = 0; $i < $j; $i++){
			$str .= $arr[rand(0, count($arr) - 1)];
		}
		return $str;
	}
	
	/**
     * Генерация случайной последовательности цифр
     *
     * @param  $j int
     * @return string
     */
	private static function randNum($j)
	{
		$str = '';
		for($i = 0; $i < $j; $i++){
			($i == 0)? $str .= rand(1, 9) : $str .= rand(0, 9);
		}
		return $str;
	}
}