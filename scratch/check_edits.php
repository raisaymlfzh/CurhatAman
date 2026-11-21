<?php
$b = __DIR__ . '/../resources/views/guru-bk/';
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($b));
foreach ($it as $f) {
    if (!$f->isFile() || !str_ends_with($f->getFilename(), '.blade.php')) continue;
    $c = file_get_contents($f->getPathname());
    preg_match_all('/<style>([\s\S]*?)<\/style>/', $c, $m);
    $bad = [];
    foreach ($m[1] as $css) { $d = substr_count($css,'{') - substr_count($css,'}'); if ($d) $bad[] = $d; }
    $lines = substr_count($c, "\n");
    echo str_pad(substr($f->getPathname(), strlen($b)), 42) . " lines=$lines " . ($bad ? 'UNBALANCED ' . implode(',', $bad) : 'ok') . "\n";
}
$d = file_get_contents($b.'dashboard.blade.php');
echo "\ndashboard includes styles: " . (strpos($d, "@include('guru-bk.partials.styles')") !== false ? 'yes' : 'NO') . "\n";
$a = strpos($d, 'notification-bell'); $bb = strpos($d, 'class="date-chip"'); $cc = strpos($d, 'class="account-trigger"');
echo "dashboard order bell<date<profile: " . (($a < $bb && $bb < $cc) ? 'yes' : 'NO') . "\n";
$s = file_get_contents($b.'partials/styles.blade.php');
echo "styles lines: " . substr_count($s, "\n") . "\n";

