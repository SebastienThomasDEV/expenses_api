# expenses_api
Pour générer les clés privés et publiques jwt
```
// dans le terminal de git 
mkdir config/jwt
openssl genrsa -out config/jwt/private.pem 4096
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
```

