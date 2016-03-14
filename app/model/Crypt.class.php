<?php

class Crypt extends Model {

    const DEPENDENCIES = [];

    public function createHash($data, $algo = 'sha256') {
        $salt = base64_encode(mcrypt_create_iv(24, MCRYPT_RAND));
        $hash = hash($algo, $salt.$data);
        return $algo . ':' . $salt . ':' . $hash;
    }

    public function compareHash($hash, $data) {
        list($algo, $salt, $a) = explode(':', $hash, 3);
        $b = hash($algo, $salt.$data);

        return $this->equals($a, $b);
    }
    
    public function equals($a, $b) {
        if (!is_string($a) or !is_string($b))
            return false;

        $diff = strlen($a) ^ strlen($b);
        for ($i = 0; $i < strlen($a) && $i < strlen($b); $i++)
            $diff |= ord($a[$i]) ^ ord($b[$i]);

        return $diff === 0;
    }

}
