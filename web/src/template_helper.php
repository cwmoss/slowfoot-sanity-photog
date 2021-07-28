<?php

return [
	'sanity_link' => function ($sl, $opts=[]) use ($ds) {
		//print_r($sl);
      return sanity_link($sl, $opts, $ds);
   },
   'sanity_text' => function ($text, $opts=[]) use ($ds, $config) {
		//print_r($sl);
      return sanity_text($text, $ds, $config);
   },
];