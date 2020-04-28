<?php
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

$key = "example_key";
$payload = array(
    "data"=>array(
        "name" => "ganesh",
        "email" => "g@dad.com"
    ),
);

/**
 * IMPORTANT:
 * You must specify supported algorithms for your application. See
 * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
 * for a list of spec-compliant algorithms.
 */
$jwt = JWT::encode($payload, $key);
print_r($jwt);
$decoded = JWT::decode($jwt, $key, array('HS256'));

print_r($decoded);

/*
 NOTE: This will now be an object instead of an associative array. To get
 an associative array, you will need to cast it as such:
*/

$decoded_array = (array) $decoded;
print_r($decoded_array["data"]);
/**
 * You can add a leeway to account for when there is a clock skew times between
 * the signing and verifying servers. It is recommended that this leeway should
 * not be bigger than a few minutes.
 *
 * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
 */
JWT::$leeway = 60; // $leeway in seconds
$decoded = JWT::decode($jwt, $key, array('HS256'));

    $mailbox = imap_open("{imap.googlemail.com:993/ssl}INBOX", "gchaudhary1995@gmail.com", "geshi@769664    ");
    $mail = imap_search($mailbox, "ALL");
    rsort($mail);
    $latest_mail = $mail[0];
    print_r(count($mail));
    // print_r($mail[17672]);
    // echo $latest_mail;
    $mail_headers = imap_headerinfo($mailbox, $latest_mail);
    $subject = $mail_headers->subject;
    $from = $mail_headers->fromaddress;
    $msg = imap_fetchbody($mailbox,$latest_mail,2);
    imap_setflag_full($mailbox, $latest_mail, "\\Seen");
    imap_close($mailbox);
    echo $from;
    echo $msg;
?>