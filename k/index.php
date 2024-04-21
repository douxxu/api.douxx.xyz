<?php

//Check if it's a post request to generate a key
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Get the data from keys.json
    $existing_data = json_decode(file_get_contents('./keys.json'), true);

    //Generate a random 15 caracters key
    $key = substr(md5(uniqid(rand(), true)), 0, 15);

    //add the key to the existing data
    $existing_data[$key] = false;

    //rewrite the data to the json
    file_put_contents('./keys.json', json_encode($existing_data, JSON_PRETTY_PRINT));

    //Return the key to the requester
    echo $key;
    exit;
}

//Check if the key is provided in the get parameters ({your url}?key={key here}
$key = $_GET['key'] ?? '';

//Check into the user agent if the requester is not a bot (maybe renforce this)
$is_bot = strpos($_SERVER['HTTP_USER_AGENT'], 'bot') !== false;

//If there is a key and the user is not a bot
if ($key && !$is_bot) {
    //Get the data of the json
    $data = json_decode(file_get_contents('./keys.json'), true);

    //check if the key exist into the json
    if (array_key_exists($key, $data)) {
        //Set the key value to true
        $data[$key] = true;

        //Rewrite the json with the new content (value of the key updated)
        file_put_contents('./keys.json', json_encode($data, JSON_PRETTY_PRINT));

        //Show the content of success.html 
        echo file_get_contents('./success.html');
        exit;
    }
}

//If the key don't exists / the user is a bot show the content of error.html
echo file_get_contents('./error.html');
?>
