<?php 
	require('phpQuery/phpQuery.php');

	$url= 'https://ria.ru/society/';
	$html = file_get_contents($url);

	$doc = phpQuery::newDocument($html);

	$newsItems = $doc->find('.b-list__item');

	$news = array();
	$cnt = 0;
	foreach ($newsItems as $newsItem) {
		while($cnt < 5) {
			$newsElem = pq($newsItem)->find('a');
			$newsElemTitle = pq($newsItem)->find('.b-list__item-title span');
			$newsElemDate = pq($newsItem)->find('.b-list__item-date span');
     
    		$title = $newsElemTitle->text();
			$link = $newsElem->attr('href');
			$date = $newsElemDate->text();

    		array_push($news, array(
        		'title' => $title,
				'link' => $link,
				'date' => $date,
			));
			$cnt++;
		}
	}

	var_dump($news);
?>