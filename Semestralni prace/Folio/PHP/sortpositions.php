<?php
//sorts positions by the selected sort
function sortPositions(array $positions, string $sort) {
  switch ($sort) {
    case "highest_price":
      usort($positions, function($a, $b) {
        return $b['opening_price'] <=> $a['opening_price'];
      });
      break;
    case "lowest_price":
      usort($positions, function($a, $b) {
        return $a['opening_price'] <=> $b['opening_price'];
      });
      break;
    case "newest":
      usort($positions, function($a, $b) {
        return strtotime($b['date']) <=> strtotime($a['date']);
      });
      break;
    case "oldest":
      usort($positions, function($a, $b) {
        return strtotime($a['date']) <=> strtotime($b['date']);
      });
      break;
    case "highest_profit":
      usort($positions, function($a, $b) {
        return $b['profit'] <=> $a['profit'];
      });
      break;
    case "not_sorted":
      break;
  }
  return $positions;
}
?>
