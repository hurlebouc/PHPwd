<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 Leigh
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 */

function hexToBase64($hex)
{
  $base16Chars = array_flip(str_split('0123456789abcdef'));
  $base64Chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+-';
  $hex = strtolower($hex);
  $hexLen = strlen($hex);
  $buffer = 0;
  $bufferedBits = 0;
  $base64 = '';
  for ($i = 0; $i < $hexLen; $i++) {
    $buffer = ($buffer << 4) | $base16Chars[$hex[$i]];
    $bufferedBits += 4;
    if ($bufferedBits >= 6) {
      $bufferedBits -= 6;
      $base64 .= $base64Chars[($buffer >> $bufferedBits) & 63];
      $buffer &= (1 << $bufferedBits) - 1;
    }
  }
  if ($bufferedBits) {
    $base64 .= $base64Chars[$buffer << (6 - $bufferedBits)];
  }
  $base64 .= str_repeat('=', $hexLen % 3);
  return $base64;
}
?>
