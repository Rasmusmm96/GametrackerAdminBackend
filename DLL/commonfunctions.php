<?php
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;

class CommonFunctions {

    public $tokenId = '8Tn^*G$v56E$SAe1';

    public function validate($token) {
        global $tokenId;

        try {
            $token = (new Parser())->parse((string) $token);
        } catch (InvalidArgumentException $iax) {
            return false;
        }

        $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer('GameTracker');
        $data->setId($tokenId);

        return $token->validate($data);
    }
}