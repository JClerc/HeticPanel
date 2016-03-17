<?php

class Image {

    const UPLOAD_MIN_SIZE = 50;
    const UPLOAD_MAX_SIZE = 5000;
    const UPLOAD_MAX_BYTES = 3 * 1024 * 1024;

    public function upload($file, $saveTo) {
        $filename = strtolower($file['name']);
        $filetype = strtolower($file['type']);

        $file_ext = strpos($filename, '.') !== false ? substr(strrchr($filename, '.'), 1) : '';
        $whitelist = array(
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png'  => 'image/png',
        );

        if (!ctype_alpha($file_ext) or !isset($whitelist[$file_ext]))
            throw new Exception('Le fichier envoyé n\'est pas une image.');

        if ($file['size'] > self::UPLOAD_MAX_BYTES)
            throw new Exception('L\'image est trop volumineuse.');

        if ($whitelist[$file_ext] !== $file['type'])
            throw new Exception('Le fichier envoyé n\'est pas une image.');

        $imageinfo = getimagesize($file['tmp_name']);
        list($width, $height) = $imageinfo;

        if ($whitelist[$file_ext] !== $imageinfo['mime'])
            throw new Exception('Le fichier envoyé n\'est pas une image.');

        if ($width < self::UPLOAD_MIN_SIZE or $height < self::UPLOAD_MIN_SIZE)
            throw new Exception('L\'image envoyée est trop petite.');

        if ($width > self::UPLOAD_MAX_SIZE or $height > self::UPLOAD_MAX_SIZE)
            throw new Exception('L\'image envoyée est trop grande.');

        if ($whitelist[$file_ext] === 'image/jpeg')
            $im = imagecreatefromjpeg($file['tmp_name']);
        elseif ($whitelist[$file_ext] === 'image/png')
            $im = imagecreatefrompng($file['tmp_name']);
        else
            throw new Exception('Le format de l\'image n\'est pas pris en charge.');

        if (!is_resource($im))
            throw new Exception('Le fichier envoyé n\'est pas une image.');

        chmod(dirname($saveTo), 0755);

        if (is_file($saveTo . '.jpg'))
            unlink($saveTo . '.jpg');

        imagejpeg($im, $saveTo . '.jpg', 90);
        imagedestroy($im);

    }

}
