# GemoBackTest
1- Is a web rest api to get popular languages used in last 30 days
2- Technologies used : php 7.3 / symfony 4 + fost resp api bundle
3- Request to get data :
  var settings = {
    "url": "localhost/remotedchallenge/public/public/api/popularLanguages",
    "method": "GET",
    "timeout": 0,
  };

  $.ajax(settings).done(function (response) {
    console.log(response);
  });
  
  4- Response
  "TypeScript": {
        "language": "TypeScript",
        "numbRepos": 5,
        "listRepos": [
            {
                "nameRepo": "cyrildiagne/ar-cutpaste",
                "repoUrl": "https://github.com/cyrildiagne/ar-cutpaste"
            },
            ....
          ]
          ..
        }
