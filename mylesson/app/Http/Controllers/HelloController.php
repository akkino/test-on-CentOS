<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

global $head, $style, $body, $end;
$head = '<html><head>';
$style = <<<EOF
<style>
body {font-size:16px; color:#999; }
h1 { font-size:100px; text-align:right; color:#eee;
  margin:-40px; 0px -50px 0px; }
</style>
EOF;
$body = '</head><body>';
$end = '</body></head>';

function tag($tag,$txt) {
    return "<{$tag}>" . $txt . "</{$tag}>";
}

class HelloController extends Controller
{

    public function __invoke() {

      return <<<EOF
<html>
<head>
<title>Hello</title>
<style>
body {font-size:16px; color:#999; }
h1 { font-size:100px; text-align:right; color:#eee;
  margin:-40px; 0px -50px 0px; }
</style>
</head>
<body>
  <h1>Single</h1>
  <p>これは、シングルアクションコントローラのアクションです。</p>
</body>
</html>
EOF;
    }
}
