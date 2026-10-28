--TEST--
Duplicate array keys release the overwritten value
--FILE--
<?php
$inputs = [
    // [0 => 'AB', 0 => null]
    "\x00\x00\x00\x02\x14\x02\x06\x00\x11\x02AB\x06\x00\x00",
    // ['k' => [1], 'k' => 2]
    "\x00\x00\x00\x02\x14\x02\x11\x01k\x14\x01\x06\x00\x06\x01\x0e\x00\x06\x02",
];
foreach ($inputs as $data) {
    var_dump(igbinary_unserialize($data));
    $before = memory_get_usage();
    for ($i = 0; $i < 1000; $i++) {
        igbinary_unserialize($data);
    }
    var_dump(memory_get_usage() - $before);
}
?>
--EXPECT--
array(1) {
  [0]=>
  NULL
}
int(0)
array(1) {
  ["k"]=>
  int(2)
}
int(0)
