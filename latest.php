<?php

$latest = get('posts', $conn, 'title, id', "", 'ORDER BY id DESC', 5);

