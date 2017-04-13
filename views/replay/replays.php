<h1>Replays</h1>
<div><a href="/replays/all">All</a> | <a href="/replays/1">1v1</a> | <a href="/replays/2">2v2</a> | <a href="/replays/3">3v3</a> | <a href="/replays/4">4v4</a></div>
<?php

echo $this->context->renderPartial('replaysWidget', [
    'games' => $games
]);