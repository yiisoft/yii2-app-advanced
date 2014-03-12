<?php

function askMagicConchShell()
{
	$r = mt_rand(0, 100);// generate random value between 0 and 100 (inclusive)
	return $r < 50 ? 'She is' : 'She is not';
}
