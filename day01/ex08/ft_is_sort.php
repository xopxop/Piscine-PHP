<?php

function ft_is_sort($tab) {
	$sorted_tab = $tab;
	sort($sorted_tab);
	return ($tab === $sorted_tab);
}

?>