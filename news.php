<?php 

	$url= 'https://ria.ru/society/';
	$html = file_get_contents($url);

	$news_name = array();
	$news_date = array();
	$news_href = array();
	$href_b_list = array();
	
	//название статьи
	preg_match_all('#<span[^>]+?itemprop\s*?=\s*?"name"[^>]*?>(.+?)</span>#su', $html, $news_name);
	preg_match_all('#<div[^>]+?class\s*?=\s*?"b-list__item-date"[^>]*?>(.+?)</div>#su', $html, $news_date);
	preg_match_all('#<div[^>]+?class\s*?=\s*?"b-list__item.*"[^>]*?>(.+?)</div>+<a.*?href=["\'](.*?)["\'].*?>#su', $html, $news_href);
		
	$news_five = array_slice($news_name[1], 0, 5);
	$date_five = array_slice($news_date[1], 0, 5);
	$href_five = array_slice($news_href[1], 0, 5);
	echo'<pre>',var_dump($news_five),'</pre>';
	echo'<pre>',var_dump($date_five),'</pre>';
	echo'<pre>',var_dump($href_five),'</pre>';
?>