## Api for https://api.douxx.xyz/k : auth api
*[..](https://github.com/douxxu/api.douxx.xyz/tree/main)*  

*If you want more informations abt the code, you can check the comments of the [index.php](https://github.com/douxxu/api.douxx.xyz/blob/main/k/index.php) file

### Documentation

- **Creating a new key**

To create a new key, you have to do a [post request](https://en.wikipedia.org/wiki/POST_(HTTP)) to the php url. Here, the php is at `https://api.douxx.xyz/k/`, so we will do a post request to this url. To get a the code you'll have to get the response text and to show it. 
  
Here is an illustration code in python:
```py
import requests #import the requests module

response = requests.post("https://api.douxx.xyz/k/") #define "response" with a request to the php url

key = response.text #get the response of the php

print(f"Here is your auth url: https://api.douxx.xyz/k/?key={key}") #build the auth url with the key provided into the response

```
  
  
- **Checking if a key is auth or not**

To check if a key is auth, you'll have to directly check into the keys.json file. I'll soon make a php for checking keys. If the key value is on false, the key is unverified, on true, the key is verified.

Here is an illustration code in python:
```py
import requests #import the requests module

auth_key = "de2705fd44e5b6a" #define the auth key

response = requests.get("https://api.douxx.xyz/k/keys.json") #get the json

data = response.json() #--------------------------------------^^^^^^^^^^^^

if data.get(auth_key, False): #check if the auth key is on true, or on false

    print(f"{auth_key} is verified") #true = verified

else:

    print(f"{auth_key} isn't verified") #false = unverified
```
  

- **Generate a key and check while the key isn't auth**
  
It's just the 2 previus steps combined.
  
Here is an illustration code in python:
```py
import requests #import the requests module


key = requests.post("https://api.douxx.xyz/k/").text #get the auth key

print(f"Here is your auth url: https://api.douxx.xyz/k/?key={key}")

while True: #contiune checking again and again

    data = requests.get("https://api.douxx.xyz/k/keys.json").json() #get the json


    if data.get(key, False): #check if the auth key is on true, or on false

        print(f"{key} is verified. stopping.") #true = verified
        exit() #exiting the program
    else:

        print(f"{key} isn't verified") #false = unverified
```

### questions / issues

If you have a question / issue, please make an issue

    
