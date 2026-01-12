<?php

function loadEnv(string $path): void
{
  if (!file_exists($path))
    return;

  $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  foreach ($lines as $line) {
    if (str_starts_with(trim($line), '#'))
      continue;  // skip comment
    list($name, $value) = array_map('trim', explode('=', $line, 2));
    if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
      putenv("$name=$value");
      $_ENV[$name] = $value;
      $_SERVER[$name] = $value;
    }
  }
}
