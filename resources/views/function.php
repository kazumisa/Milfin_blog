<?php

/**
 * テキストの文字数制限
 * @param  string $text
 * @return string $limitdText
 */
public function longText($text) {
  $count = mb_strlen($text);
  $limit = 20;

  if($count > $limit) {
    $limitd = mb_substr($text, 0, $limit);
    $limitdText = $limitd.'...';
    return $limitdText;
  }
}