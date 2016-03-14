<?php

if (isset($data['success']) and isset($data['message'])) {

    if ($data['success']) {
        echo '<div style="border: 1px solid green; padding: 15px; margin: 15px 0;">' . $data['message'] . '</div>';
    } else {
        echo '<div style="border: 1px solid red; padding: 15px; margin: 15px 0;">' . $data['message'] . '</div>';
    }
}
