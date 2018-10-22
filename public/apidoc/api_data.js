define({ "api": [
  {
    "type": "post",
    "url": "cms/users/create",
    "title": "",
    "name": "create",
    "group": "Users",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>create.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n\"success\": true,\n\"errorCode\": 0,\n\"message\": \"success\",\n\"data\": {\n\"_id\": \"5bcb4546bb2c8e00075e8e32\",\n\"email\": \"boykioyb96@gmail.com\",\n\"status\": 1,\n\"group_id\": \"1\",\n\"updated_at\": \"2018-10-20 15:09:58\",\n\"created_at\": \"2018-10-20 15:09:58\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "status",
            "description": ""
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserEmpty",
            "description": "<p>data empty.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "batdongsan_api/app/Http/Controllers/v1/cms/UserController.php",
    "groupTitle": "Users"
  },
  {
    "type": "get",
    "url": "cms/users/getAll",
    "title": "",
    "name": "getAll",
    "group": "Users",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "all",
            "description": "<p>data users.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"content\": [\n            {\n                \"_id\": \"5bcb4546bb2c8e00075e8e32\",\n                \"email\": \"boykioyb96@gmail.com\",\n                \"status\": 1,\n                \"group_id\": \"1\",\n                \"updated_at\": \"2018-10-20 15:09:58\",\n                \"created_at\": \"2018-10-20 15:09:58\"\n            }\n        ],\n        \"limit\": 10,\n        \"page\": 1,\n        \"total\": 1\n    },\n    \"success\": true,\n    \"errorCode\": 0,\n    \"message\": \"success\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserEmpty",
            "description": "<p>data empty.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "batdongsan_api/app/Http/Controllers/v1/cms/UserController.php",
    "groupTitle": "Users"
  },
  {
    "type": "post",
    "url": "cms/users/getById",
    "title": "",
    "name": "getId",
    "group": "Users",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "all",
            "description": "<p>data users.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>by Id</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n         \"success\": true,\n         \"errorCode\": 0,\n         \"message\": \"success\",\n         \"data\": {\n            \"_id\": \"5bcb4546bb2c8e00075e8e32\",\n            \"email\": \"boykioyb96@gmail.com\",\n            \"status\": 1,\n            \"group_id\": \"1\",\n            \"updated_at\": \"2018-10-20 15:09:58\",\n            \"created_at\": \"2018-10-20 15:09:58\"\n         }\n }",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "id",
            "description": "<p>Users unique ID</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserEmpty",
            "description": "<p>data empty.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "batdongsan_api/app/Http/Controllers/v1/cms/UserController.php",
    "groupTitle": "Users"
  },
  {
    "type": "post",
    "url": "cms/users/resetPassword",
    "title": "",
    "name": "resetPassword",
    "group": "Users",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "update",
            "description": "<p>password success.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n\"success\": true,\n\"errorCode\": 0,\n\"message\": \"success\",\n\"data\": {\n\"_id\": \"5bcb4546bb2c8e00075e8e32\",\n\"email\": \"boykioyb96@gmail.com\",\n\"status\": 1,\n\"group_id\": \"1\",\n\"updated_at\": \"2018-10-20 15:09:58\",\n\"created_at\": \"2018-10-20 15:09:58\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "password",
            "description": ""
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserEmpty",
            "description": "<p>data empty.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "batdongsan_api/app/Http/Controllers/v1/cms/UserController.php",
    "groupTitle": "Users"
  },
  {
    "type": "post",
    "url": "cms/users/search",
    "title": "",
    "name": "search",
    "group": "Users",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "all",
            "description": "<p>data users.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n    \"data\": {\n        \"content\": [\n                {\n                    \"_id\": \"5bcb4546bb2c8e00075e8e32\",\n                    \"email\": \"boykioyb96@gmail.com\",\n                    \"status\": 1,\n                    \"group_id\": \"1\",\n                    \"updated_at\": \"2018-10-20 15:09:58\",\n                    \"created_at\": \"2018-10-20 15:09:58\"\n                }\n        ],\n        \"limit\": 10,\n        \"page\": 1,\n        \"total\": 1\n    },\n    \"success\": true,\n    \"errorCode\": 0,\n    \"message\": \"success\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserEmpty",
            "description": "<p>data empty.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "batdongsan_api/app/Http/Controllers/v1/cms/UserController.php",
    "groupTitle": "Users"
  },
  {
    "type": "post",
    "url": "cms/users/update",
    "title": "",
    "name": "update",
    "group": "Users",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "id",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "username",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "string",
            "optional": false,
            "field": "email",
            "description": ""
          },
          {
            "group": "Parameter",
            "type": "int",
            "optional": false,
            "field": "status",
            "description": ""
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "data",
            "description": "<p>update</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "    HTTP/1.1 200 OK\n{\n\"success\": true,\n\"errorCode\": 0,\n\"message\": \"success\",\n\"data\": {\n\"_id\": \"5bcb4546bb2c8e00075e8e32\",\n\"email\": \"boykioyb96@gmail.com\",\n\"status\": 1,\n\"group_id\": \"1\",\n\"updated_at\": \"2018-10-20 15:09:58\",\n\"created_at\": \"2018-10-20 15:09:58\"\n}\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "UserEmpty",
            "description": "<p>data empty.</p>"
          }
        ]
      }
    },
    "version": "0.0.0",
    "filename": "batdongsan_api/app/Http/Controllers/v1/cms/UserController.php",
    "groupTitle": "Users"
  }
] });
