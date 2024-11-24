---
title: REST API
description: The Lighty REST API allows you to render code blocks without installing any packages.
breadcrumbs: [Documentation, REST API]
---

Lighty offers a REST API that allows you to render code blocks remotely. You can get an API token by signing up on [uselighty.com](https://uselighty.com/register).

## Gotchas

### Updating Resources

In order to ensure that previously created documents are always rendered with the same contents, language and theme, you cannot update any of those resources. If you need to update a document, you will need to create a new one. The same applies to languages and themes. If you need to update a language or theme, you will need to create a new one.

### Deleting Resources

We do allow you to delete documents, languages and themes. However, deleting languages or themes will not affect any documents that are using them. If you delete a language or theme, the documents that are using them will continue to use them. If you want to change the language or theme of a document, you will need to create a new one.

## Endpoints

### List Documents

```shell
curl --request GET \
    --url https://uselighty.com/api/teams/{team}/documents \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```

### Create Document

-   The `body` field is required and must be a base64 string.
-   The `language` field is optional and must be a string.
-   The `theme` field is optional and must be a string.

```http
curl --request POST \
    --url https://uselighty.com/api/teams/{team}/documents \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN' \
    --data '{
        "body": "...",
	    "language": "...",
	    "theme": "..."
    }'
```

### Show Document

```shell
curl --request GET \
    --url https://uselighty.com/api/teams/{team}/documents/{document} \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```

### Delete Document

```shell
curl --request DELETE \
    --url https://uselighty.com/api/teams/{team}/documents/{document} \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```

### List Languages

```shell
curl --request GET \
    --url https://uselighty.com/api/teams/{team}/languages \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```

### Create Language

```shell
curl --request POST \
    --url https://uselighty.com/api/teams/{team}/documents \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN' \
    --data '{
        "body": "CODE_BASE64_ENCODED",
	    "language": "CODE_LANGUAGE",
	    "theme": "CODE_THEME"
    }'
```

### Show Language

```shell
curl --request GET \
    --url https://uselighty.com/api/teams/{team}/languages/{language} \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```

### Delete Language

```shell
curl --request DELETE \
    --url https://uselighty.com/api/teams/{team}/languages/{language} \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```

### List Themes

```shell
curl --request GET \
    --url https://uselighty.com/api/teams/{team}/themes \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```

### Create Theme

```shell
curl --request POST \
    --url https://uselighty.com/api/teams/{team}/themes \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN' \
    --data '{
	    "name": "...",
	    "data": "[...]"
    }'
```

### Show Theme

```shell
curl --request GET \
    --url https://uselighty.com/api/teams/{team}/themes/{theme} \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```

### Delete Theme

```shell
curl --request DELETE \
    --url https://uselighty.com/api/teams/{team}/themes/{theme} \
    --header 'Content-Type: application/json' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer YOUR_API_TOKEN'
```
